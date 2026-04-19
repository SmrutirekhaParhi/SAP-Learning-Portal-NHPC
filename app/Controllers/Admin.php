<?php

namespace App\Controllers;

use App\Models\ModuleModel;
use App\Models\TopicModel;
use App\Models\MaterialModel;

class Admin extends BaseController
{
    public function index()
    {
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->findAll();
        return view('admin', ['modules' => $modules]);
    }

    public function save()
    {
        $data = $this->request->getPost('modules');


        if (!is_array($data) || empty($data)) {
            return redirect()->to('/admin')->with('error', 'Please upload module(s) before saving.');
    }

        $moduleModel = new ModuleModel();
        $topicModel = new TopicModel();
        $materialModel = new MaterialModel();

        foreach ($data as $module) {
            $moduleName = trim($module['name']);
            if (!$moduleName) continue;

            $moduleRow = $moduleModel->where('name', $moduleName)->first();
            $moduleId = $moduleRow ? $moduleRow['id'] : $moduleModel->insert([
                'name' => $moduleName,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!isset($module['topics'])) continue;

            foreach ($module['topics'] as $topic) {
                $topicName = trim($topic['name']);
                if (!$topicName) continue;

                $topicRow = $topicModel->where(['module_id' => $moduleId, 'name' => $topicName])->first();
                if ($topicRow) {
                    $topicId = $topicRow['id'];
                } else {
                    try {
                        $topicId = $topicModel->insert([
                            'module_id' => $moduleId,
                            'name'      => $topicName,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
                        return redirect()->to('/admin')->with('error', "Topic '$topicName' already exists in module '$moduleName'.");
                    }
                }


                    
                if (!isset($topic['materials'])) continue;

                foreach ($topic['materials'] as $file) {
                    $title = trim($file['title'] ?? '');
                    $absolutePath = trim($file['file_path'] ?? '');
                    if (!$absolutePath || !$title) continue;

                    // Convert absolute to relative path
                    if (str_starts_with($absolutePath, FCPATH . 'writable/uploads/')) {
                        $filePath = str_replace(FCPATH . 'writable/uploads/', '', $absolutePath);
                    } elseif (str_starts_with($absolutePath, WRITEPATH)) {
                        $filePath = str_replace(WRITEPATH, '', $absolutePath);
                    } else {
                        $filePath = $absolutePath;
                    }

                    // Allow both absolute and relative paths
                    $fileType = $this->detectFileType($filePath);
                    $materialModel->insert([
                        'topic_id'         => $topicId,
                        'title'            => $title,
                        'file_path'        => $filePath,
                        'file_type'        => $fileType,
                        'status'           => 'active',
                        'uploaded_at'      => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        return redirect()->to('/admin')->with('success', 'Upload successful');
    }

    public function view($moduleName)
    {
        $moduleModel = new ModuleModel();
        $module = $moduleModel->where('name', urldecode($moduleName))->first();

        if (!$module) {
            return redirect()->to('/admin')->with('error', 'Module not found');
        }

        return view('admin_view_module', [
            'moduleName' => $module['name'],
            'groupedMaterials' => $this->getGroupedMaterials($module['id'])
        ]);
    }

    public function edit($moduleName)
    {
        $moduleModel = new ModuleModel();
        $module = $moduleModel->where('name', urldecode($moduleName))->first();

        if (!$module) {
            return redirect()->to('/admin')->with('error', 'Module not found');
        }

        return view('admin_edit_module', [
            'moduleName' => $module['name'],
            'groupedMaterials' => $this->getGroupedMaterials($module['id'])
        ]);
    }

    public function delete($moduleId)
    {
        $moduleModel = new ModuleModel();
        $topicModel = new TopicModel();
        $materialModel = new MaterialModel();

        $module = $moduleModel->find($moduleId);
        if (!$module) {
            return redirect()->to('/admin')->with('error', 'Module not found');
        }
        if (isset($module['deleted_at']) && $module['deleted_at']) {
            return redirect()->to('/admin')->with('error', 'Module already deleted');
        }

        $topics = $topicModel->where('module_id', $moduleId)->findAll();

        foreach ($topics as $topic) {
            if (isset($topic['deleted_at']) && $topic['deleted_at']) continue;
            $materialModel->where('topic_id', $topic['id'])->set(['status' => 'deleted'])->update();
            $materialModel->where('topic_id', $topic['id'])->delete();
            $topicModel->update($topic['id'], ['status' => 'deleted']);
            $topicModel->delete($topic['id']);
        }
        
        $moduleModel->update($moduleId, ['status' => 'deleted']);
        $moduleModel->delete($moduleId);


        return redirect()->to('/admin')->with('success', 'Module deleted');
    }

    public function update($moduleName)
    {
        $moduleModel = new ModuleModel();
        $topicModel = new TopicModel();
        $materialModel = new MaterialModel();

        $newName = trim($this->request->getPost('module_name'));
        $existingModule = $moduleModel->where('name', urldecode($moduleName))->first();
        if (!$existingModule) {
            return redirect()->to('/admin')->with('error', 'Module not found');
        }
        if (isset($existingModule['deleted_at']) && $existingModule['deleted_at']) {
            return redirect()->to('/admin')->with('error', 'Module already deleted');
        }

        if ($newName !== $existingModule['name']) {
            $moduleModel->update($existingModule['id'], [
                'name' => $newName,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $topics = $this->request->getPost('topics') ?? [];
        foreach ($topics as $topicKey => $topicData) {
            $topic = $topicModel->where('module_id', $existingModule['id'])->where('name', $topicKey)->first();
            if (!$topic) continue;

            if (isset($topicData['delete']) && $topicData['delete'] == 1) {
                $materialModel->where('topic_id', $topic['id'])->set(['status' => 'deleted'])->update();
                $topicModel->update($topic['id'], ['status' => 'deleted']);
                $materialModel->where('topic_id', $topic['id'])->delete();
                $topicModel->delete($topic['id']);
                continue;
            }

            $updatedTopicName = trim($topicData['name']);
            if ($updatedTopicName !== $topic['name']) {
                // Check if new name already exists in same module
                $duplicate = $topicModel->where('module_id', $existingModule['id'])
                                        ->where('name', $updatedTopicName)
                                        ->where('id !=', $topic['id'])
                                        ->first();
                if ($duplicate) {
                    return redirect()->to('/admin')->with('error', "Topic name '{$updatedTopicName}' already exists in this module.");
                }

                $topicModel->update($topic['id'], [
                    'name' => $updatedTopicName,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $moduleModel->update($existingModule['id'], ['updated_at' => date('Y-m-d H:i:s')]);
            }


            foreach ($topicData['materials'] ?? [] as $matId => $matData) {
                if (isset($matData['delete']) && $matData['delete'] == 1) {
                    $materialModel->update($matId, ['status' => 'deleted']);
                    $materialModel->delete($matId);
                    continue;
                }
                $existingFile = $materialModel->find($matId);
                $title = trim($matData['title']);
                $filePath = trim($matData['file_path']);
                $fileType = $this->detectFileType($filePath);
                $changed = (
                    $title !== $existingFile['title'] ||
                    $filePath !== $existingFile['file_path'] ||
                    $fileType !== $existingFile['file_type']
                );
                if ($changed) {
                    $materialModel->update($matId, [
                        'title'            => $title,
                        'file_path'        => $filePath,
                        'file_type'        => $fileType,
                        'updated_at'       => date('Y-m-d H:i:s')
                    ]);
                    $topicModel->update($topic['id'], ['updated_at' => date('Y-m-d H:i:s')]);
                    $moduleModel->update($existingModule['id'], ['updated_at' => date('Y-m-d H:i:s')]);
                }
            }
        }

        // Handle new topics
        $newTopics = $this->request->getPost('new_topics') ?? [];
        foreach ($newTopics as $newTopic) {
            $topicName = trim($newTopic['name']);
            // Check for duplicate topic in this module
            $existing = $topicModel->where(['module_id' => $existingModule['id'], 'name' => $topicName])->first();
            if ($existing) {
                return redirect()->back()->with('error', "Topic '" . esc($topicName) . "' already exists in this module.");
            }
            $topicId = $topicModel->insert([
                'module_id'  => $existingModule['id'],
                'name'       => $topicName,
                'created_at' => date('Y-m-d H:i:s')
            ]);

        $moduleModel->update($existingModule['id'], ['updated_at' => date('Y-m-d H:i:s')]);

            foreach ($newTopic['files'] ?? [] as $file) {
                $filePath = trim($file['file_path']);
                $fileType = $this->detectFileType($filePath);
                $materialModel->insert([
                    'topic_id'         => $topicId,
                    'title'            => trim($file['title']),
                    'file_path'        => $filePath,
                    'file_type'        => $fileType,
                    'status'           => 'active',
                    'uploaded_at'      => date('Y-m-d H:i:s')
                ]);
                $topicModel->update($topicId, ['updated_at' => date('Y-m-d H:i:s')]);
                $moduleModel->update($existingModule['id'], ['updated_at' => date('Y-m-d H:i:s')]);
            }
        }

        // Handle new files for existing topics
        $newFiles = $this->request->getPost('new_files') ?? [];
        foreach ($newFiles as $topicName => $files) {
            $topic = $topicModel->where('module_id', $existingModule['id'])->where('name', $topicName)->first();
            if (!$topic) continue;

            foreach ($files as $file) {
                $absolutePath = trim($file['file_path']);
                if (str_starts_with($absolutePath, FCPATH . 'writable/uploads/')) {
                    $filePath = str_replace(FCPATH . 'writable/uploads/', '', $absolutePath);
                } elseif (str_starts_with($absolutePath, WRITEPATH)) {
                    $filePath = str_replace(WRITEPATH, '', $absolutePath);
                } else {
                    $filePath = $absolutePath;
                }

                $fileType = $this->detectFileType($filePath);
                $materialModel->insert([
                    'topic_id'         => $topic['id'],
                    'title'            => trim($file['title']),
                    'file_path'        => $filePath,
                    'file_type'        => $fileType,
                    'status'           => 'active',
                    'uploaded_at'      => date('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect()->to('/admin')->with('success', 'Module updated successfully');
    }

    /**
     * Helper to fetch only active, non-deleted materials for a topic
     */
    private function getActiveMaterials($topicId)
    {
        $materialModel = new MaterialModel();
        $topicModel = new TopicModel();

        $topic = $topicModel->find($topicId);
        if (!$topic) return [];

        $materials = $materialModel
            ->where('topic_id', $topicId)
            ->where('status', 'active')
            ->where('(deleted_at IS NULL OR deleted_at = "")')
            ->findAll();

        foreach ($materials as &$material) {
            $material['topic_name'] = $topic['name']; // Add this line
        }

        return $materials;
    }


    private function getGroupedMaterials($moduleId)
    {
        $topicModel = new TopicModel();
        $grouped = [];

        $topics = $topicModel->where('module_id', $moduleId)->findAll();

        foreach ($topics as $topic) {
            $materials = $this->getActiveMaterials($topic['id']);
            if ($materials) {
                $grouped[$topic['name']] = $materials;
            }
        }

        return $grouped;
    }

    // Helper to detect file type from extension
    private function detectFileType($filePath) {
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return match($ext) {
            'pdf' => 'pdf',
            'mp4' => 'mp4',
            'xlsx', 'xls' => 'excel',
            'zip' => 'zip',
            'ppt', 'pptx' => 'ppt',
            'doc', 'docx' => 'word',
            default => 'other',
        };
    }
}

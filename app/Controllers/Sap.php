<?php

namespace App\Controllers;

use App\Models\ModuleModel;
use App\Models\TopicModel;
use App\Models\MaterialModel;

class Sap extends BaseController
{
    public function index()
    {
        $moduleModel = new ModuleModel();
        $topicModel = new TopicModel();
        $materialModel = new MaterialModel();

        $modules = $moduleModel->findAll();
        $result = [];

        foreach ($modules as $mod) {
            $topics = $topicModel->where('module_id', $mod['id'])->findAll();

            $topicList = [];

            foreach ($topics as $t) {
                $materials = $materialModel->where('topic_id', $t['id'])
                                        ->where('status', 'active')
                                        ->findAll();

                $topicList[] = [
                    'name' => $t['name'],
                    'materials' => array_map(function ($mat) {
                        return [
                            'title' => $mat['title'],
                            'type'  => $mat['file_type'],
                            'path'  => $mat['file_path']
                        ];
                    }, $materials)
                ];
            }

            $result[] = [
                'name' => $mod['name'],
                'topics' => $topicList
            ];
        }

        return view('sap_learning', ['modules' => $result]);
    }


    

    public function fetchModules()
    {
        $term = trim($this->request->getGet('term'));

        if (!$term) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing search term']);
        }

        $moduleModel = new ModuleModel();

        $query = $moduleModel->like('name', $term)->findAll();

        if (!$query) {
            return $this->response->setStatusCode(404)->setJSON([]);
        }

         $modules = array_map(fn($m) => $m['name'], $query);
        return $this->response->setStatusCode(200)->setJSON($modules);
    }


    public function fetchTopics()
    {
        $term = trim($this->request->getGet('term'));

        if (!$term) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing search term']);
        }

        $topicModel = new TopicModel();

        $query = $topicModel->like('name', $term)->findAll();

        if (!$query) {
            return $this->response->setStatusCode(404)->setJSON([]);
        }

        $topics = array_map(fn($t) => $t['name'], $query);
        return $this->response->setStatusCode(200)->setJSON($modules);
    }

    public function search()
    {
        $module = trim($this->request->getGet('module'));
        $topic = trim($this->request->getGet('topic'));

        $moduleModel = new ModuleModel();
        $topicModel = new TopicModel();
        $materialModel = new MaterialModel();

        // If both are empty, error
        if (!$module && !$topic) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Module or topic is required']);
        }

        $materials = [];

        if ($module && $topic) {
            // Both module and topic provided
            $mod = $moduleModel->where('name', $module)->first();
            if (!$mod) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Module not found']);
            }
            $top = $topicModel->where('module_id', $mod['id'])->where('name', $topic)->first();
            if (!$top) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Topic not found in module']);
            }
            $materials = $materialModel->where('topic_id', $top['id'])->where('status', 'active')->findAll();
        } elseif ($module) {
            // Module only: get all topics for module, then all materials for those topics
            $mod = $moduleModel->where('name', $module)->first();
            if (!$mod) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Module not found']);
            }
            $topics = $topicModel->where('module_id', $mod['id'])->findAll();
            $topicIds = array_column($topics, 'id');
            if (empty($topicIds)) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'No topics found for module']);
            }
            $materials = $materialModel->whereIn('topic_id', $topicIds)->where('status', 'active')->findAll();
        } elseif ($topic) {
            // Topic only: get all topics with that name, then all materials for those topics
            $topics = $topicModel->where('name', $topic)->findAll();
            $topicIds = array_column($topics, 'id');
            if (empty($topicIds)) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Topic not found']);
            }
            $materials = $materialModel->whereIn('topic_id', $topicIds)->where('status', 'active')->findAll();
        }

        $result = array_map(function ($mat) {
            return [
                'title' => $mat['title'],
                'type'  => $mat['file_type'],
                'path'  => $mat['file_path']
            ];
        }, $materials);

        return $this->response->setStatusCode(200)->setJSON($result);
    }

    public function fetchModulesWithTopics()
    {
        $moduleModel = new ModuleModel();
        $topicModel = new TopicModel();
        $materialModel = new MaterialModel();

        $modules = $moduleModel->findAll();
        $result = [];

        foreach ($modules as $mod) {
            $topics = $topicModel->where('module_id', $mod['id'])->findAll();

            $topicList = [];

            foreach ($topics as $t) {
                $materials = $materialModel->where('topic_id', $t['id'])
                                        ->where('status', 'active')
                                        ->findAll();

                $topicList[] = [
                    'name' => $t['name'],
                    'materials' => array_map(function($mat) {
                        return [
                            'title' => $mat['title'],
                            'type'  => $mat['file_type'],
                            'path'  => $mat['file_path']
                        ];
                    }, $materials)
                ];
            }

            $result[] = [
                'name' => $mod['name'],
                'topics' => $topicList
            ];
        }

        return $this->response->setJSON($result);
    }




}

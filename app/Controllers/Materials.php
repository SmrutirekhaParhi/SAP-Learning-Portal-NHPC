<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Materials extends Controller
{
    // Serve files from writable/uploads/materials securely
    public function serve()
    {
        $encodedPath = $this->request->getGet('path');
        $path = urldecode($encodedPath);

        if (!$path || strpos($path, '..') !== false) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        // Normalize slashes to backslashes for Windows file system
        $normalizedPath = str_replace('/', '\\', $path);

        // If absolute Windows path, use as is. If relative, resolve from WRITEPATH
        if (preg_match('/^[a-zA-Z]:\\\\/', $normalizedPath)) {
            $fullPath = $normalizedPath;
        } else {
            $fullPath = WRITEPATH . $normalizedPath;
        }

        // Debug: log and show the resolved path if file not found
        if (!is_file($fullPath)) {
            error_log('MATERIAL SERVE DEBUG: File not found at: ' . $fullPath);
            return $this->response->setStatusCode(404)->setBody('File not found. Checked: ' . $fullPath);
        }

        $mime = mime_content_type($fullPath);
        return $this->response->setHeader('Content-Type', $mime)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($fullPath) . '"')
            ->setBody(file_get_contents($fullPath));
    }
}

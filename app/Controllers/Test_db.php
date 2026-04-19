<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Test_db extends Controller  // Class name matches file (underscore preserved)
{
    public function index()
    {
        // Test database connection
        $db = \Config\Database::connect();
        
        try {
            $db->query('SELECT 1');
            echo "✅ Database connected successfully!"; 
        } catch (\Exception $e) {
            echo "❌ Connection failed: " . $e->getMessage();
        }
    }
}

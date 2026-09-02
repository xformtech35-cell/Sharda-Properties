<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Categories extends BaseController
{
    protected function ensureTableExists($db)
    {
        try {
            $driver = strtolower($db->getPlatform());
            $pkSyntax = str_contains($driver, 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY';
            $tableName = $db->prefixTable('sp_categories');

            $db->query("CREATE TABLE IF NOT EXISTS {$tableName} (
                id {$pkSyntax},
                name VARCHAR(100) NOT NULL,
                slug VARCHAR(100) NOT NULL,
                type VARCHAR(50) NOT NULL DEFAULT 'property',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
        } catch (\Throwable $e) {}
    }

    public function index(): ResponseInterface
    {
        $type = $this->request->getGet('type');
        try {
            $db = \Config\Database::connect();
            $this->ensureTableExists($db);

            $builder = $db->table('sp_categories');
            if ($type) {
                $builder->where('type', $type);
            }
            $sp_categories = $builder->orderBy('id', 'ASC')->get()->getResultArray();
        } catch (\Throwable $e) {
            $sp_categories = [];
        }

        return $this->response->setJSON($sp_categories);
    }

    public function create(): ResponseInterface
    {
        $json = null;
        try {
            $json = $this->request->getJSON();
        } catch (\Throwable $e) {
            $json = null;
        }

        $name = ($json && isset($json->name)) ? $json->name : $this->request->getPost('name');
        $type = ($json && isset($json->type)) ? $json->type : ($this->request->getPost('type') ?: 'property');

        if (empty($name)) {
            return $this->response->setJSON(['error' => 'Category name is required'])->setStatusCode(400);
        }

        $slug = url_title(strtolower($name), '_', true);

        $data = [
            'name'       => $name,
            'slug'       => $slug,
            'type'       => $type,
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            $db = \Config\Database::connect();
            $this->ensureTableExists($db);
            $db->table('sp_categories')->insert($data);
            $data['id'] = $db->insertID();
        } catch (\Throwable $e) {
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'message' => 'Category created successfully',
            'data'    => $data
        ])->setStatusCode(201);
    }

    public function delete($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Category ID is required'])->setStatusCode(400);
        }

        try {
            $db = \Config\Database::connect();
            $this->ensureTableExists($db);
            $db->table('sp_categories')->where('id', $id)->delete();
        } catch (\Throwable $e) {}

        return $this->response->setJSON(['message' => 'Category deleted successfully']);
    }
}

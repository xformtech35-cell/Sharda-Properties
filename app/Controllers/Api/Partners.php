<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Partners extends BaseController
{
    protected function ensureTableExists($db)
    {
        try {
            $driver = strtolower($db->getPlatform());
            $pkSyntax = str_contains($driver, 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY';
            $tableName = $db->prefixTable('sp_partners');

            $db->query("CREATE TABLE IF NOT EXISTS {$tableName} (
                id {$pkSyntax},
                name VARCHAR(255) NOT NULL,
                logo_url VARCHAR(255) NULL,
                category VARCHAR(100) DEFAULT 'Builder',
                description TEXT NULL,
                website_url VARCHAR(255) NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
        } catch (\Throwable $e) {}
    }

    public function index(): ResponseInterface
    {
        try {
            $db = \Config\Database::connect();
            $this->ensureTableExists($db);
            $sp_partners = $db->table('sp_partners')->orderBy('id', 'DESC')->get()->getResultArray();
        } catch (\Throwable $e) {
            $sp_partners = [];
        }

        return $this->response->setJSON($sp_partners);
    }

    public function create(): ResponseInterface
    {
        $json = null;
        try {
            $json = $this->request->getJSON();
        } catch (\Throwable $e) {
            $json = null;
        }

        $id = ($json && isset($json->id)) ? $json->id : $this->request->getPost('id');
        if ($id) {
            return $this->update($id);
        }

        $name        = ($json && isset($json->name)) ? $json->name : $this->request->getPost('name');
        $category    = ($json && isset($json->category)) ? $json->category : $this->request->getPost('category');
        $description = ($json && isset($json->description)) ? $json->description : $this->request->getPost('description');
        $website_url = ($json && isset($json->website_url)) ? $json->website_url : $this->request->getPost('website_url');
        $logo_url    = ($json && isset($json->logo_url)) ? $json->logo_url : $this->request->getPost('logo_url');

        // Handle image file upload if provided
        $file = $this->request->getFile('logo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $uploadPath = ROOTPATH . 'public/uploads/sp_partners';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $file->move($uploadPath, $newName);
            $logo_url = '/uploads/sp_partners/' . $newName;
        }

        if (empty($name)) {
            return $this->response->setJSON([
                'error' => 'Partner / Client name is required.'
            ])->setStatusCode(400);
        }

        $data = [
            'name'        => $name,
            'category'    => $category ?: 'Builder',
            'description' => $description ?: '',
            'website_url' => $website_url ?: '',
            'logo_url'    => $logo_url ?: '',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $db = \Config\Database::connect();
        $this->ensureTableExists($db);
        $db->table('sp_partners')->insert($data);
        $data['id'] = $db->insertID();

        return $this->response->setJSON([
            'message' => 'Partner / Client added successfully',
            'data'    => $data
        ])->setStatusCode(201);
    }

    public function update($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Partner ID is required'])->setStatusCode(400);
        }

        $json = null;
        try {
            $json = $this->request->getJSON();
        } catch (\Throwable $e) {
            $json = null;
        }

        $name        = ($json && isset($json->name)) ? $json->name : $this->request->getPost('name');
        $category    = ($json && isset($json->category)) ? $json->category : $this->request->getPost('category');
        $description = ($json && isset($json->description)) ? $json->description : $this->request->getPost('description');
        $website_url = ($json && isset($json->website_url)) ? $json->website_url : $this->request->getPost('website_url');
        $logo_url    = ($json && isset($json->logo_url)) ? $json->logo_url : $this->request->getPost('logo_url');

        $file = $this->request->getFile('logo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $uploadPath = ROOTPATH . 'public/uploads/sp_partners';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $file->move($uploadPath, $newName);
            $logo_url = '/uploads/sp_partners/' . $newName;
        }

        $data = [];
        if ($name !== null) $data['name'] = $name;
        if ($category !== null) $data['category'] = $category;
        if ($description !== null) $data['description'] = $description;
        if ($website_url !== null) $data['website_url'] = $website_url;
        if ($logo_url !== null) $data['logo_url'] = $logo_url;

        if (empty($data)) {
            return $this->response->setJSON(['message' => 'No fields to update']);
        }

        try {
            $db = \Config\Database::connect();
            $this->ensureTableExists($db);
            $db->table('sp_partners')->where('id', $id)->update($data);
        } catch (\Throwable $e) {
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'message' => 'Partner updated successfully',
            'id'      => $id,
            'data'    => $data
        ]);
    }

    public function delete($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Partner ID is required'])->setStatusCode(400);
        }

        try {
            $db = \Config\Database::connect();
            $this->ensureTableExists($db);
            $db->table('sp_partners')->where('id', $id)->delete();
        } catch (\Throwable $e) {}

        return $this->response->setJSON([
            'message' => 'Partner deleted successfully'
        ]);
    }
}

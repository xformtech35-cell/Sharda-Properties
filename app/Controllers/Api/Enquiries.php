<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Enquiries extends BaseController
{
    /**
     * Public endpoint to submit a contact or property enquiry
     */
    public function create(): ResponseInterface
    {
        $json = null;
        try {
            $json = $this->request->getJSON();
        } catch (\Throwable $e) {
            $json = null;
        }

        $name       = ($json && isset($json->name)) ? $json->name : $this->request->getPost('name');
        $email      = ($json && isset($json->email)) ? $json->email : $this->request->getPost('email');
        $phone      = ($json && isset($json->phone)) ? $json->phone : $this->request->getPost('phone');
        $message    = ($json && isset($json->message)) ? $json->message : $this->request->getPost('message');
        $propertyId = ($json && isset($json->property_id)) ? $json->property_id : $this->request->getPost('property_id');

        if (empty($name) || empty($email) || empty($phone) || empty($message)) {
            return $this->response->setJSON([
                'error' => 'Name, email, phone, and message are required fields.'
            ])->setStatusCode(400);
        }

        $data = [
            'name'        => $name,
            'email'       => $email,
            'phone'       => $phone,
            'message'     => $message,
            'property_id' => !empty($propertyId) ? (int)$propertyId : null,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        try {
            $db = \Config\Database::connect();
            $db->query("CREATE TABLE IF NOT EXISTS enquiries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                message TEXT NOT NULL,
                property_id INT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            $db->table('enquiries')->insert($data);
        } catch (\Throwable $e) {}

        return $this->response->setJSON([
            'message' => 'Enquiry submitted successfully'
        ])->setStatusCode(201);
    }

    /**
     * Admin-only endpoint to list enquiries with type filtering
     */
    public function index(): ResponseInterface
    {
        $type = $this->request->getGet('type');

        try {
            $db = \Config\Database::connect();
            $db->query("CREATE TABLE IF NOT EXISTS enquiries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                message TEXT NOT NULL,
                property_id INT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            $builder = $db->table('enquiries')
                ->select('enquiries.*, properties.title as property_title')
                ->join('properties', 'properties.id = enquiries.property_id', 'left');

            if ($type === 'property') {
                $builder->where('enquiries.property_id IS NOT NULL');
            } elseif ($type === 'contact') {
                $builder->where('enquiries.property_id IS NULL');
            }

            $enquiries = $builder->orderBy('enquiries.id', 'DESC')->get()->getResultArray();
        } catch (\Throwable $e) {
            $enquiries = [];
        }

        return $this->response->setJSON($enquiries);
    }

    /**
     * Admin-only endpoint to delete an enquiry
     */
    public function delete($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Enquiry ID is required'])->setStatusCode(400);
        }

        try {
            $db = \Config\Database::connect();
            $db->table('enquiries')->where('id', $id)->delete();
        } catch (\Throwable $e) {}

        return $this->response->setJSON([
            'message' => 'Enquiry deleted successfully'
        ]);
    }
}

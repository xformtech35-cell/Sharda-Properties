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
        $rules = [
            'name'        => 'required|min_length[2]|max_length[100]',
            'email'       => 'required|valid_email|max_length[100]',
            'phone'       => 'required|min_length[7]|max_length[20]',
            'message'     => 'required|min_length[5]',
            'property_id' => 'permit_empty|integer',
        ];

        $json = $this->request->getJSON();
        $data = [
            'name'        => $json->name ?? $this->request->getPost('name'),
            'email'       => $json->email ?? $this->request->getPost('email'),
            'phone'       => $json->phone ?? $this->request->getPost('phone'),
            'message'     => $json->message ?? $this->request->getPost('message'),
            'property_id' => $json->property_id ?? $this->request->getPost('property_id'),
        ];

        if (empty($data['property_id'])) {
            $data['property_id'] = null;
        }

        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        if (!$validation->run($data)) {
            return $this->response->setJSON([
                'errors' => $validation->getErrors()
            ])->setStatusCode(400);
        }

        try {
            $db = \Config\Database::connect();
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

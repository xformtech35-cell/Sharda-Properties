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

        // Sanitize property_id: set to null if empty or 0
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

        $db = \Config\Database::connect();
        $db->table('enquiries')->insert($data);

        return $this->response->setJSON([
            'message' => 'Enquiry submitted successfully'
        ])->setStatusCode(201);
    }

    /**
     * Admin-only endpoint to list enquiries with type filtering
     * type=property => Property enquiries (property_id IS NOT NULL)
     * type=contact  => Contact Us enquiries (property_id IS NULL)
     */
    public function index(): ResponseInterface
    {
        $db = \Config\Database::connect();
        $type = $this->request->getGet('type');
        
        $builder = $db->table('enquiries')
            ->select('enquiries.*, properties.title as property_title')
            ->join('properties', 'properties.id = enquiries.property_id', 'left');

        if ($type === 'property') {
            $builder->where('enquiries.property_id IS NOT NULL');
        } elseif ($type === 'contact') {
            $builder->where('enquiries.property_id IS NULL');
        }

        $enquiries = $builder->orderBy('enquiries.id', 'DESC')->get()->getResultArray();

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

        $db = \Config\Database::connect();
        $enquiry = $db->table('enquiries')->where('id', $id)->get()->getRowArray();

        if (!$enquiry) {
            return $this->response->setJSON(['error' => 'Enquiry not found'])->setStatusCode(404);
        }

        $db->table('enquiries')->where('id', $id)->delete();

        return $this->response->setJSON([
            'message' => 'Enquiry deleted successfully'
        ]);
    }
}

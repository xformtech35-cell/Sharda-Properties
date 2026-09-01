<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Properties extends BaseController
{
    /**
     * Get list of all properties
     */
    public function index(): ResponseInterface
    {
        $db = \Config\Database::connect();
        
        $category = $this->request->getGet('category');
        $purpose = $this->request->getGet('purpose');
        $propertyType = $this->request->getGet('property_type');
        $search = $this->request->getGet('search');
        $flatType = $this->request->getGet('flat_type');

        $builder = $db->table('properties');

        if (!empty($flatType)) {
            $builder->where('category', 'flat');
            if ($flatType === 'resale') {
                $builder->groupStart()
                        ->like('title', 'resale')
                        ->orLike('description', 'resale')
                        ->orWhere('purpose', 'sell')
                        ->groupEnd();
            } elseif ($flatType === 'new') {
                $builder->groupStart()
                        ->like('title', 'new')
                        ->orLike('description', 'new')
                        ->orWhere('purpose', 'sell')
                        ->groupEnd();
            }
        } elseif (!empty($category)) {
            $builder->where('category', $category);
        }

        if (!empty($purpose) && empty($flatType)) {
            $builder->where('purpose', $purpose);
        }

        if (!empty($propertyType)) {
            $builder->where('property_type', $propertyType);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('location', $search)
                    ->orLike('description', $search)
                    ->groupEnd();
        }

        $properties = $builder->orderBy('id', 'DESC')->get()->getResultArray();

        return $this->response->setJSON($properties);
    }

    /**
     * Get a single property details
     */
    public function show($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Property ID is required'])->setStatusCode(400);
        }

        $db = \Config\Database::connect();
        $property = $db->table('properties')->where('id', $id)->get()->getRowArray();

        if (!$property) {
            return $this->response->setJSON(['error' => 'Property not found'])->setStatusCode(404);
        }

        return $this->response->setJSON($property);
    }

    /**
     * Create a new property (Admin only)
     */
    public function create(): ResponseInterface
    {
        // Field validation rules
        $rules = [
            'title'         => 'required|min_length[3]|max_length[255]',
            'price'         => 'required|numeric',
            'location'      => 'required|min_length[3]|max_length[255]',
            'category'      => 'required|in_list[na_plot,flat,office]',
            'purpose'       => 'required|in_list[sell,rent]',
            'property_type' => 'required|in_list[residential,commercial]',
            'bedrooms'      => 'required|integer',
            'bathrooms'     => 'required|integer',
            'area'          => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        // Get post data
        $data = [
            'title'         => $this->request->getPost('title'),
            'description'   => $this->request->getPost('description'),
            'price'         => $this->request->getPost('price'),
            'location'      => $this->request->getPost('location'),
            'category'      => $this->request->getPost('category'),
            'purpose'       => $this->request->getPost('purpose'),
            'property_type' => $this->request->getPost('property_type'),
            'bedrooms'      => $this->request->getPost('bedrooms'),
            'bathrooms'     => $this->request->getPost('bathrooms'),
            'area'          => $this->request->getPost('area'),
        ];

        // Handle image upload
        $imageFile = $this->request->getFile('image');
        $imageUrl = null;

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imgRule = [
                'image' => 'uploaded[image]|max_size[image,10240]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp,image/gif]'
            ];
            if (!$this->validate($imgRule)) {
                return $this->response->setJSON([
                    'errors' => $this->validator->getErrors()
                ])->setStatusCode(400);
            }

            // Create uploads directory if it doesn't exist
            $uploadPath = FCPATH . 'uploads/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $newName = $imageFile->getRandomName();
            $imageFile->move($uploadPath, $newName);
            $imageUrl = '/uploads/' . $newName;
        }

        $data['image_url'] = $imageUrl;

        $db = \Config\Database::connect();
        $db->table('properties')->insert($data);
        $insertId = $db->insertID();

        $data['id'] = $insertId;

        return $this->response->setJSON([
            'message' => 'Property created successfully',
            'property' => $data
        ])->setStatusCode(201);
    }

    /**
     * Update an existing property (Admin only)
     */
    public function update($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Property ID is required'])->setStatusCode(400);
        }

        $db = \Config\Database::connect();
        $property = $db->table('properties')->where('id', $id)->get()->getRowArray();

        if (!$property) {
            return $this->response->setJSON(['error' => 'Property not found'])->setStatusCode(404);
        }

        // Validate basic fields
        $rules = [
            'title'         => 'required|min_length[3]|max_length[255]',
            'price'         => 'required|numeric',
            'location'      => 'required|min_length[3]|max_length[255]',
            'category'      => 'required|in_list[na_plot,flat,office]',
            'purpose'       => 'required|in_list[sell,rent]',
            'property_type' => 'required|in_list[residential,commercial]',
            'bedrooms'      => 'required|integer',
            'bathrooms'     => 'required|integer',
            'area'          => 'required|integer',
        ];

        $method = $this->request->getMethod();
        if ($method === 'put') {
            $input = $this->request->getRawInput();
            $data = [
                'title'         => !empty($input['title']) ? $input['title'] : $property['title'],
                'description'   => isset($input['description']) ? $input['description'] : $property['description'],
                'price'         => !empty($input['price']) ? $input['price'] : $property['price'],
                'location'      => !empty($input['location']) ? $input['location'] : $property['location'],
                'category'      => !empty($input['category']) ? $input['category'] : $property['category'],
                'purpose'       => !empty($input['purpose']) ? $input['purpose'] : $property['purpose'],
                'property_type' => !empty($input['property_type']) ? $input['property_type'] : $property['property_type'],
                'bedrooms'      => isset($input['bedrooms']) ? $input['bedrooms'] : $property['bedrooms'],
                'bathrooms'     => isset($input['bathrooms']) ? $input['bathrooms'] : $property['bathrooms'],
                'area'          => isset($input['area']) ? $input['area'] : $property['area'],
            ];
        } else {
            // POST request
            $postTitle = $this->request->getPost('title');
            $postPrice = $this->request->getPost('price');
            $postLoc   = $this->request->getPost('location');
            $postCat   = $this->request->getPost('category');
            $postPurp  = $this->request->getPost('purpose');
            $postPropT = $this->request->getPost('property_type');
            $postBeds  = $this->request->getPost('bedrooms');
            $postBaths = $this->request->getPost('bathrooms');
            $postArea  = $this->request->getPost('area');
            $postDesc  = $this->request->getPost('description');

            $data = [
                'title'         => !empty($postTitle) ? $postTitle : $property['title'],
                'description'   => $postDesc !== null ? $postDesc : $property['description'],
                'price'         => !empty($postPrice) ? $postPrice : $property['price'],
                'location'      => !empty($postLoc) ? $postLoc : $property['location'],
                'category'      => !empty($postCat) ? $postCat : $property['category'],
                'purpose'       => !empty($postPurp) ? $postPurp : $property['purpose'],
                'property_type' => !empty($postPropT) ? $postPropT : $property['property_type'],
                'bedrooms'      => $postBeds !== null ? $postBeds : $property['bedrooms'],
                'bathrooms'     => $postBaths !== null ? $postBaths : $property['bathrooms'],
                'area'          => $postArea !== null ? $postArea : $property['area'],
            ];
        }

        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        if (!$validation->run($data)) {
            return $this->response->setJSON([
                'errors' => $validation->getErrors()
            ])->setStatusCode(400);
        }

        // Handle image upload if a new image was uploaded
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imgRule = [
                'image' => 'uploaded[image]|max_size[image,10240]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp,image/gif]'
            ];
            
            if ($this->validate($imgRule)) {
                // Delete old image if it exists
                if (!empty($property['image_url'])) {
                    $oldFilePath = FCPATH . ltrim($property['image_url'], '/');
                    if (is_file($oldFilePath)) {
                        @unlink($oldFilePath);
                    }
                }

                // Upload new image
                $uploadPath = FCPATH . 'uploads/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $newName = $imageFile->getRandomName();
                $imageFile->move($uploadPath, $newName);
                $data['image_url'] = '/uploads/' . $newName;
            } else {
                return $this->response->setJSON([
                    'errors' => $this->validator->getErrors()
                ])->setStatusCode(400);
            }
        }

        $db->table('properties')->where('id', $id)->update($data);

        // Fetch and return the updated property
        $updatedProperty = $db->table('properties')->where('id', $id)->get()->getRowArray();

        return $this->response->setJSON([
            'message' => 'Property updated successfully',
            'property' => $updatedProperty
        ]);
    }

    /**
     * Delete property (Admin only)
     */
    public function delete($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->response->setJSON(['error' => 'Property ID is required'])->setStatusCode(400);
        }

        $db = \Config\Database::connect();
        $property = $db->table('properties')->where('id', $id)->get()->getRowArray();

        if (!$property) {
            return $this->response->setJSON(['error' => 'Property not found'])->setStatusCode(404);
        }

        // Delete image file if it exists
        if (!empty($property['image_url'])) {
            $filePath = FCPATH . ltrim($property['image_url'], '/');
            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }

        $db->table('properties')->where('id', $id)->delete();

        return $this->response->setJSON([
            'message' => 'Property deleted successfully'
        ]);
    }
}

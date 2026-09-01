<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Testimonials extends ResourceController
{
    protected $format = 'json';

    protected function getDb()
    {
        $db = \Config\Database::connect();
        // Ensure testimonials table exists
        $db->query("CREATE TABLE IF NOT EXISTS testimonials (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            role VARCHAR(255) NOT NULL,
            rating INT DEFAULT 5,
            content TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Insert default seed if empty
        $builder = $db->table('testimonials');
        if ($builder->countAllResults(false) === 0) {
            $builder->insertBatch([
                [
                    'name' => 'Rajesh Kulkarni',
                    'role' => 'Homeowner, City Center',
                    'rating' => 5,
                    'content' => 'Sharda Properties made our dream of owning a 3BHK flat completely seamless. Their documentation process was transparent and stress-free!'
                ],
                [
                    'name' => 'Priya Sharma',
                    'role' => 'Investor, NA Plot Owner',
                    'rating' => 5,
                    'content' => 'Finding an authentic NA plot with legal clearance can be tough. Sharda Properties provided clear title verification and smooth registration.'
                ],
                [
                    'name' => 'Amit Mehta',
                    'role' => 'Commercial Tenant',
                    'rating' => 5,
                    'content' => 'We leased a prime commercial office through Sharda Properties. Professional support and excellent negotiation!'
                ],
                [
                    'name' => 'Sunil Joshi',
                    'role' => 'NA Plot Buyer, Green Valley',
                    'rating' => 5,
                    'content' => 'Exceptional legal verification and plot layout planning. Highly recommended real estate consultancy!'
                ]
            ]);
        }

        return $db;
    }

    public function index()
    {
        $db = $this->getDb();
        $testimonials = $db->table('testimonials')
                           ->orderBy('created_at', 'DESC')
                           ->get()
                           ->getResultArray();

        return $this->respond($testimonials);
    }

    public function create()
    {
        $rules = [
            'name'    => 'required|min_length[2]',
            'role'    => 'required|min_length[2]',
            'rating'  => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
            'content' => 'required|min_length[5]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'role'       => $this->request->getPost('role'),
            'rating'     => (int)$this->request->getPost('rating'),
            'content'    => $this->request->getPost('content'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $db = $this->getDb();
        $db->table('testimonials')->insert($data);
        $insertId = $db->insertID();

        $data['id'] = $insertId;
        return $this->respondCreated(['message' => 'Testimonial added successfully', 'data' => $data]);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail('Testimonial ID is required.');
        }

        $db = $this->getDb();
        $existing = $db->table('testimonials')->where('id', $id)->get()->getRowArray();
        if (!$existing) {
            return $this->failNotFound('Testimonial not found.');
        }

        $db->table('testimonials')->where('id', $id)->delete();
        return $this->respondDeleted(['message' => 'Testimonial deleted successfully']);
    }
}

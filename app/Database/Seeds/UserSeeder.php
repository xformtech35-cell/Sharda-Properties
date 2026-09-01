<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Admin User',
            'email'    => 'admin@sharda.com',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'role'     => 'admin',
        ];

        // Simple Query
        $this->db->table('users')->insert($data);
    }
}

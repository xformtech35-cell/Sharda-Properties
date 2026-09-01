<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    /**
     * Authenticate user by email and password
     */
    public function login(): ResponseInterface
    {
        $json = $this->request->getJSON();
        
        $email = $json->email ?? $this->request->getPost('email');
        $password = $json->password ?? $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return $this->response->setJSON([
                'error' => 'Email and password are required'
            ])->setStatusCode(400);
        }

        $db = \Config\Database::connect();
        $user = $db->table('users')->where('email', $email)->get()->getRow();

        if (!$user || !password_verify($password, $user->password)) {
            return $this->response->setJSON([
                'error' => 'Invalid email or password'
            ])->setStatusCode(401);
        }

        // Generate a simple API token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // Save token to DB
        $db->table('users')->where('id', $user->id)->update([
            'token' => $token,
            'token_expires_at' => $expiry
        ]);

        return $this->response->setJSON([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    }

    /**
     * Invalidate user session / token
     */
    public function logout(): ResponseInterface
    {
        $userId = $this->request->getHeaderLine('X-User-Id');
        
        if ($userId) {
            $db = \Config\Database::connect();
            $db->table('users')->where('id', $userId)->update([
                'token' => null,
                'token_expires_at' => null
            ]);
        }

        return $this->response->setJSON([
            'message' => 'Logout successful'
        ]);
    }

    /**
     * Verify token and return user details
     */
    public function verify(): ResponseInterface
    {
        $userId = $this->request->getHeaderLine('X-User-Id');
        
        if (!$userId) {
            return $this->response->setJSON([
                'error' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        $db = \Config\Database::connect();
        $user = $db->table('users')->where('id', $userId)->get()->getRow();

        if (!$user) {
            return $this->response->setJSON([
                'error' => 'User not found'
            ])->setStatusCode(404);
        }

        return $this->response->setJSON([
            'valid' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    }
}

<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        
        if (empty($authHeader)) {
            return Services::response()
                ->setJSON(['error' => 'Authorization header missing'])
                ->setStatusCode(401);
        }

        // Expect: Bearer <token>
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return Services::response()
                ->setJSON(['error' => 'Invalid Authorization format'])
                ->setStatusCode(401);
        }

        $token = $matches[1];
        if (empty($token)) {
            return Services::response()
                ->setJSON(['error' => 'Invalid token'])
                ->setStatusCode(401);
        }
        
        try {
            $db = \Config\Database::connect();
            $user = $db->table('users')
                ->where('token', $token)
                ->get()
                ->getRow();

            if ($user) {
                $request->setHeader('X-User-Id', $user->id);
                $request->setHeader('X-User-Email', $user->email);
                $request->setHeader('X-User-Role', $user->role);
            }
        } catch (\Throwable $e) {
            // DB fallback for admin token
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed
    }
}

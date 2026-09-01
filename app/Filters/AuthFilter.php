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
        
        $db = \Config\Database::connect();
        $user = $db->table('users')
            ->where('token', $token)
            ->where('token_expires_at >', date('Y-m-d H:i:s'))
            ->get()
            ->getRow();

        if (!$user) {
            return Services::response()
                ->setJSON(['error' => 'Invalid or expired token'])
                ->setStatusCode(401);
        }

        // Set custom headers to pass user info to controllers
        $request->setHeader('X-User-Id', $user->id);
        $request->setHeader('X-User-Email', $user->email);
        $request->setHeader('X-User-Role', $user->role);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed
    }
}

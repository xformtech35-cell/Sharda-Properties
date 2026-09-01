<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function login()
    {
        $data = [
            'meta_title' => 'Admin Login - Sharda Properties',
            'meta_description' => 'Admin portal sign-in for managing property listings and inquiries.',
        ];

        return view('pages/login', $data);
    }

    public function dashboard()
    {
        $data = [
            'meta_title' => 'Admin Dashboard - Sharda Properties',
            'meta_description' => 'Manage listings, property details, images, and visitor enquiries.',
        ];

        return view('pages/admin_dashboard', $data);
    }
}

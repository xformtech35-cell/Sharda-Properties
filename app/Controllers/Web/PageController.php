<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class PageController extends BaseController
{
    public function about()
    {
        $data = [
            'meta_title' => 'About Us - Sharda Properties | Leading Real Estate Consultancy',
            'meta_description' => 'Learn about Sharda Properties, our vision, mission, and core values in providing trusted real estate consulting, NA plots, flats, and commercial offices.',
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'meta_title' => 'Contact Us - Sharda Properties | Get In Touch',
            'meta_description' => 'Contact Sharda Properties today. Call us, send an email, or visit our office to inquire about real estate buying, selling, or leasing solutions.',
        ];

        return view('pages/contact', $data);
    }

    public function clients()
    {
        $data = [
            'meta_title' => 'Our Clients & Testimonials - Sharda Properties',
            'meta_description' => 'Discover our valued clients, successful real estate transactions, and testimonials from property buyers, sellers, and investors.',
        ];

        return view('pages/clients', $data);
    }

    public function partners()
    {
        $data = [
            'meta_title' => 'Our Partners & Developers - Sharda Properties',
            'meta_description' => 'Explore our network of trusted real estate developers, financial institution partners, banking partners, and channel partners.',
        ];

        return view('pages/partners', $data);
    }
}

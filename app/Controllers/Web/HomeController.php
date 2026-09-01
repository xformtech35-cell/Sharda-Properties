<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $category = $this->request->getGet('category');
        $purpose = $this->request->getGet('purpose');
        $propertyType = $this->request->getGet('property_type');
        $search = $this->request->getGet('search');
        $flatType = $this->request->getGet('flat_type');

        $properties = [];

        try {
            $db = \Config\Database::connect();
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
        } catch (\Throwable $e) {
            // Graceful fallback if remote DB is not yet initialized
            $properties = [
                [
                    'id' => 1,
                    'title' => 'Luxury 3BHK Apartment in Prime Location',
                    'price' => 12500000,
                    'location' => 'City Center, Main Road',
                    'category' => 'flat',
                    'purpose' => 'sell',
                    'property_type' => 'residential',
                    'bedrooms' => 3,
                    'bathrooms' => 3,
                    'area' => 1850,
                    'image_url' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Spacious 3BHK flat with modern amenities, 24/7 power backup, and dedicated parking.'
                ],
                [
                    'id' => 2,
                    'title' => 'Premium NA Plot - Clear Title',
                    'price' => 4500000,
                    'location' => 'Green Valley, Phase 2',
                    'category' => 'na_plot',
                    'purpose' => 'sell',
                    'property_type' => 'residential',
                    'bedrooms' => 0,
                    'bathrooms' => 0,
                    'area' => 2400,
                    'image_url' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Collector approved NA plot ready for immediate construction with electricity and water connection.'
                ],
                [
                    'id' => 3,
                    'title' => 'Modern Commercial Office Space',
                    'price' => 65000,
                    'location' => 'Business Park, IT Hub',
                    'category' => 'office',
                    'purpose' => 'rent',
                    'property_type' => 'commercial',
                    'bedrooms' => 0,
                    'bathrooms' => 2,
                    'area' => 1200,
                    'image_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Fully furnished office space suitable for IT companies, consultancies, or corporate branch.'
                ]
            ];
        }

        $pageTitle = 'Sharda Properties - Premium NA Plots, Flats, Offices & Real Estate Solutions';
        if ($flatType === 'resale') {
            $pageTitle = 'Resale Flats for Sale - Sharda Properties';
        } elseif ($flatType === 'new') {
            $pageTitle = 'New Flats for Sale - Sharda Properties';
        } elseif ($category === 'na_plot') {
            $pageTitle = 'NA Plots for Sale - Sharda Properties';
        } elseif ($propertyType === 'commercial') {
            $pageTitle = 'Commercial Properties - Sharda Properties';
        }

        $data = [
            'meta_title' => $pageTitle,
            'meta_description' => 'Explore premium NA plots, modern flats, offices, residential & commercial properties for sale and rent with Sharda Properties.',
            'meta_keywords' => 'Sharda Properties, NA plots, resale flats, new flats, commercial, real estate',
            'properties' => $properties,
            'search' => $search ?? '',
            'category' => $category ?? '',
            'purpose' => $purpose ?? '',
            'property_type' => $propertyType ?? '',
            'flat_type' => $flatType ?? '',
        ];

        return view('pages/home', $data);
    }
}

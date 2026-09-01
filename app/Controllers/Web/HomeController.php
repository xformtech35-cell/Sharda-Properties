<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
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

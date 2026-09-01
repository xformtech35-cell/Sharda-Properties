<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class PropertyController extends BaseController
{
    public function index()
    {
        $data = [
            'meta_title' => 'All Property Listings - Sharda Properties',
            'meta_description' => 'Explore all verified NA plots, residential flats, luxury villas, and commercial offices for sale and rent.',
        ];

        return view('pages/properties', $data);
    }

    public function show($id = null)
    {
        if (!$id) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();
        $property = $db->table('properties')->where('id', $id)->get()->getRowArray();

        if (!$property) {
            return view('pages/404', [
                'meta_title' => 'Property Not Found - Sharda Properties',
                'meta_description' => 'The requested property could not be found.',
            ]);
        }

        // Generate dynamic SEO metadata
        $title = esc($property['title']);
        $location = esc($property['location']);
        $purpose = $property['purpose'] === 'sell' ? 'For Sale' : 'For Rent';
        $formattedPrice = '$' . number_format((float)$property['price']);
        
        $metaTitle = "{$title} in {$location} - {$purpose} ({$formattedPrice}) | Sharda Properties";
        $metaDesc = esc(substr(strip_tags($property['description'] ?? ''), 0, 160));
        if (empty($metaDesc)) {
            $metaDesc = "{$title} located at {$location}. {$property['bedrooms']} Beds, {$property['bathrooms']} Baths, {$property['area']} sqft. Contact Sharda Properties for inquiries.";
        }

        $data = [
            'meta_title' => $metaTitle,
            'meta_description' => $metaDesc,
            'meta_image' => $property['image_url'] ? base_url(ltrim($property['image_url'], '/')) : '',
            'property' => $property,
        ];

        return view('pages/property_details', $data);
    }
}

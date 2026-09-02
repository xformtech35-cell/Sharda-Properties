<?php
// Configuration & Helper functions for CodeIgniter Views

if (!defined('API_BASE_URL')) {
    define('API_BASE_URL', base_url('api'));
}

if (!function_exists('fetch_api_data')) {
    function fetch_api_data($endpoint, $params = []) {
        try {
            $db = \Config\Database::connect();
            if ($endpoint === 'properties' || str_starts_with($endpoint, 'properties')) {
                // If single property request: properties/{id}
                if (preg_match('/properties\/([0-9]+)/', $endpoint, $m)) {
                    return $db->table('properties')->where('id', $m[1])->get()->getRowArray();
                }

                $builder = $db->table('properties');
                if (!empty($params['category'])) $builder->where('category', $params['category']);
                if (!empty($params['purpose'])) $builder->where('purpose', $params['purpose']);
                if (!empty($params['property_type'])) $builder->where('property_type', $params['property_type']);
                if (!empty($params['flat_type'])) {
                    $builder->where('category', 'flat');
                    if ($params['flat_type'] === 'resale') {
                        $builder->groupStart()
                                ->like('title', 'resale')
                                ->orLike('description', 'resale')
                                ->orWhere('purpose', 'sell')
                                ->groupEnd();
                    } elseif ($params['flat_type'] === 'new') {
                        $builder->groupStart()
                                ->like('title', 'new')
                                ->orLike('description', 'new')
                                ->orWhere('purpose', 'sell')
                                ->groupEnd();
                    }
                }
                if (!empty($params['search'])) {
                    $builder->groupStart()
                            ->like('title', $params['search'])
                            ->orLike('location', $params['search'])
                            ->orLike('description', $params['search'])
                            ->groupEnd();
                }
                return $builder->orderBy('id', 'DESC')->get()->getResultArray();
            }

            if ($endpoint === 'testimonials') {
                return $db->table('testimonials')->orderBy('id', 'DESC')->get()->getResultArray();
            }

            if ($endpoint === 'partners') {
                return $db->table('partners')->orderBy('id', 'DESC')->get()->getResultArray();
            }

            if ($endpoint === 'categories') {
                $builder = $db->table('categories');
                if (!empty($params['type'])) {
                    $builder->where('type', $params['type']);
                }
                return $builder->orderBy('id', 'ASC')->get()->getResultArray();
            }
        } catch (\Throwable $e) {}

        // HTTP API fetch fallback
        $url = base_url('api/' . ltrim($endpoint, '/'));
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 && $response) {
            return json_decode($response, true);
        }

        return [];
    }
}

<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Web Frontend Routes (Server-Side Rendered for SEO)
$routes->get('/', 'Web\HomeController::index');
$routes->get('index.php', 'Web\HomeController::index');

$routes->get('about', 'Web\PageController::about');
$routes->get('about.php', 'Web\PageController::about');

$routes->get('clients', 'Web\PageController::clients');
$routes->get('clients.php', 'Web\PageController::clients');

$routes->get('partners', 'Web\PageController::partners');
$routes->get('partners.php', 'Web\PageController::partners');

$routes->get('contact', 'Web\PageController::contact');
$routes->get('contact.php', 'Web\PageController::contact');

// All Properties Listings Routes
$routes->get('properties', 'Web\PropertyController::index');
$routes->get('properties.php', 'Web\PropertyController::index');

// Single Property Details Route
$routes->get('properties/(:num)', 'Web\PropertyController::show/$1');
$routes->get('property-details.php', function() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $controller = new \App\Controllers\Web\PropertyController();
        return $controller->show($id);
    }
    return redirect()->to('/');
});

$routes->get('login', 'Web\AdminController::login');
$routes->get('login.php', 'Web\AdminController::login');

$routes->get('admin', 'Web\AdminController::dashboard');
$routes->get('admin.php', 'Web\AdminController::dashboard');

// REST API Routes
$routes->group('api', function($routes) {
    // Auth routes
    $routes->post('login', 'Api\Auth::login');
    $routes->post('logout', 'Api\Auth::logout', ['filter' => 'auth']);
    $routes->get('verify', 'Api\Auth::verify', ['filter' => 'auth']);

    // Public property routes
    $routes->get('properties', 'Api\Properties::index');
    $routes->get('properties/(:num)', 'Api\Properties::show/$1');

    // Admin property routes
    $routes->post('properties', 'Api\Properties::create', ['filter' => 'auth']);
    $routes->put('properties/(:num)', 'Api\Properties::update/$1', ['filter' => 'auth']);
    $routes->post('properties/(:num)', 'Api\Properties::update/$1', ['filter' => 'auth']); // fallback for multipart/form-data update
    $routes->delete('properties/(:num)', 'Api\Properties::delete/$1', ['filter' => 'auth']);

    // Enquiries routes
    $routes->post('enquiries', 'Api\Enquiries::create');
    $routes->get('enquiries', 'Api\Enquiries::index', ['filter' => 'auth']);
    $routes->delete('enquiries/(:num)', 'Api\Enquiries::delete/$1', ['filter' => 'auth']);

    // Testimonials routes
    $routes->get('testimonials', 'Api\Testimonials::index');
    $routes->post('testimonials', 'Api\Testimonials::create', ['filter' => 'auth']);
    $routes->delete('testimonials/(:num)', 'Api\Testimonials::delete/$1', ['filter' => 'auth']);
});

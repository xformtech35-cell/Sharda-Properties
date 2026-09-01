<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sharda Properties · Redefined</title>
  <!-- Tailwind + Inter font + Lucide icons (same as before) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" />
  <style>
    * { font-family: 'Inter', sans-serif; }
    .bg-grid-pattern { background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 28px 28px; }
    .glass-card { backdrop-filter: blur(4px); background: rgba(255,255,255,0.5); }
    .shadow-soft { box-shadow: 0 20px 40px -12px rgba(0,0,0,0.08); }
    .transition-smooth { transition: all 0.25s cubic-bezier(0.2, 0, 0, 1); }
    .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 24px 48px -12px rgba(79, 70, 229, 0.25); }
    .gradient-text { background: linear-gradient(135deg, #818cf8, #c7d2fe, #f0f4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .btn-primary { background: #4f46e5; transition: all 0.2s; }
    .btn-primary:hover { background: #4338ca; transform: scale(1.02); box-shadow: 0 8px 24px rgba(79,70,229,0.4); }
    .property-card { border-radius: 28px; overflow: hidden; border: 1px solid rgba(229, 231, 235, 0.5); background: white; transition: all 0.3s; }
    .property-card:hover { border-color: #a5b4fc; box-shadow: 0 24px 48px -12px rgba(79,70,229,0.2); }
    .input-modern { background: rgba(255,255,255,0.9); backdrop-filter: blur(2px); border: 1px solid #e5e7eb; transition: all 0.2s; }
    .input-modern:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99,102,241,0.1); }
    .testimonial-slide { transition: opacity 0.5s ease, transform 0.5s ease; }
  </style>
</head>
<body class="bg-gray-50/80 antialiased">

<?php
// -------------------------------------------------------------
// ORIGINAL PHP LOGIC – UNTOUCHED (header/footer, routes, helpers)
// -------------------------------------------------------------
require_once APPPATH . 'Views/config.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$purpose = $_GET['purpose'] ?? '';
$property_type = $_GET['property_type'] ?? '';
$flat_type = $_GET['flat_type'] ?? '';
$location = $_GET['location'] ?? '';

$params = array_filter([
    'search' => $search,
    'category' => $category,
    'purpose' => $purpose,
    'property_type' => $property_type,
    'flat_type' => $flat_type,
    'location' => $location,
]);



$properties = !empty($properties) ? $properties : (fetch_api_data('properties', $params) ?? []);
$testimonials = fetch_api_data('testimonials') ?? [];

$page_title = 'Sharda Properties - Premium NA Plots, Flats, Offices & Real Estate Solutions';
if ($flat_type === 'resale') $page_title = 'Resale Flats for Sale - Sharda Properties';
elseif ($flat_type === 'new') $page_title = 'New Flats for Sale - Sharda Properties';
elseif ($category === 'na_plot') $page_title = 'NA Plots for Sale - Sharda Properties';
elseif ($property_type === 'commercial') $page_title = 'Commercial Properties - Sharda Properties';

$page_description = 'Explore premium NA plots, modern flats, offices, residential & commercial properties for sale and rent with Sharda Properties.';

// ORIGINAL HELPER FUNCTIONS (unchanged)
if (!function_exists('get_image_url')) {
    function get_image_url($url) {
        if (empty($url)) return 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80';
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) return $url;
        return '/sharda-properties/public' . $url;
    }
}
if (!function_exists('format_price')) {
    function format_price($price, $purpose) {
        $formatted = '$' . number_format((float)$price);
        return $purpose === 'rent' ? $formatted . '/mo' : $formatted;
    }
}
if (!function_exists('get_category_label')) {
    function get_category_label($cat) {
        switch ($cat) {
            case 'na_plot': return 'NA Plot';
            case 'flat': return 'Flat';
            case 'office': return 'Office';
            default: return ucfirst($cat ?? '');
        }
    }
}

// ----- ORIGINAL HEADER (preserved) -----
require_once APPPATH . 'Views/layouts/header.php';
?>

<!-- ============================================================ -->
<!--  MAIN CONTENT – aesthetically enhanced, logic unchanged        -->
<!-- ============================================================ -->
<div class="bg-gray-50/80 min-h-screen">

    <!-- 1. HERO – refined with glassmorphism, gradient, grid pattern -->
    <section class="relative bg-indigo-950 text-white overflow-hidden px-4 py-20 md:py-28">
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto text-center space-y-8">
            <div class="inline-flex items-center gap-2 bg-indigo-800/60 backdrop-blur-md px-5 py-2 rounded-full border border-white/20 text-xs font-bold uppercase tracking-widest text-indigo-200">
                <span class="w-2 h-2 bg-emerald-400 rounded-full inline-block animate-pulse"></span> Premium Real Estate Consultancy
            </div>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black leading-[1.1] tracking-tight">
                Find Your Dream <br class="sm:hidden" />
                <span class="gradient-text">Property</span> With Sharda
            </h1>
            <p class="text-base sm:text-xl text-indigo-100/90 max-w-3xl mx-auto font-light leading-relaxed">
                Verified NA plots, new project flats, resale homes, and commercial offices — complete legal authenticity.
            </p>

            <!-- Quick filter pills – aesthetic -->
            <div class="flex flex-wrap justify-center gap-2.5 pt-2">
                <a href="<?= base_url('/') ?>" class="px-5 py-2 rounded-full text-xs font-bold transition-all <?= empty($category) && empty($flat_type) && empty($property_type) ? 'bg-white text-indigo-900 shadow-lg' : 'bg-indigo-800/40 text-indigo-100 hover:bg-indigo-700/70 border border-white/20' ?>">All</a>
                <a href="<?= base_url('/') ?>?category=na_plot" class="px-5 py-2 rounded-full text-xs font-bold transition-all <?= $category === 'na_plot' ? 'bg-white text-indigo-900 shadow-lg' : 'bg-indigo-800/40 text-indigo-100 hover:bg-indigo-700/70 border border-white/20' ?>">NA Plots</a>
                <a href="<?= base_url('/') ?>?flat_type=resale" class="px-5 py-2 rounded-full text-xs font-bold transition-all <?= $flat_type === 'resale' ? 'bg-white text-indigo-900 shadow-lg' : 'bg-indigo-800/40 text-indigo-100 hover:bg-indigo-700/70 border border-white/20' ?>">Resale Flats</a>
                <a href="<?= base_url('/') ?>?flat_type=new" class="px-5 py-2 rounded-full text-xs font-bold transition-all <?= $flat_type === 'new' ? 'bg-white text-indigo-900 shadow-lg' : 'bg-indigo-800/40 text-indigo-100 hover:bg-indigo-700/70 border border-white/20' ?>">New Flats</a>
                <a href="<?= base_url('/') ?>?property_type=commercial" class="px-5 py-2 rounded-full text-xs font-bold transition-all <?= $property_type === 'commercial' ? 'bg-white text-indigo-900 shadow-lg' : 'bg-indigo-800/40 text-indigo-100 hover:bg-indigo-700/70 border border-white/20' ?>">Commercial</a>
            </div>

            <!-- Search bar – premium glass -->
            <form action="<?= base_url('/') ?>" method="GET" class="mt-10 max-w-4xl mx-auto bg-white/10 backdrop-blur-xl p-2.5 rounded-3xl shadow-2xl border border-white/20 flex flex-col md:flex-row gap-2 text-gray-800">
                <div class="flex-grow flex items-center px-4 py-1 bg-white/90 rounded-2xl md:rounded-l-2xl md:rounded-r-none border-0">
                    <i data-lucide="search" class="h-5 w-5 text-indigo-400 mr-3 shrink-0"></i>
                    <input type="text" name="search" placeholder="Search location, project, keyword..." class="w-full py-3 bg-transparent focus:outline-none text-sm font-medium text-gray-800 placeholder:text-gray-400" value="<?= htmlspecialchars($search) ?>" />
                </div>
                <div class="flex flex-wrap items-center gap-2 bg-white/90 rounded-2xl p-1.5">
                    <select name="category" class="py-2.5 bg-gray-50/80 text-gray-700 focus:outline-none text-xs font-semibold cursor-pointer border-0 rounded-xl px-3 hover:bg-gray-100 transition" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <option value="na_plot" <?= $category === 'na_plot' ? 'selected' : '' ?>>NA Plots</option>
                        <option value="flat" <?= $category === 'flat' ? 'selected' : '' ?>>Flats</option>
                        <option value="office" <?= $category === 'office' ? 'selected' : '' ?>>Offices</option>
                    </select>
                    <select name="purpose" class="py-2.5 bg-gray-50/80 text-gray-700 focus:outline-none text-xs font-semibold cursor-pointer border-0 rounded-xl px-3 hover:bg-gray-100 transition" onchange="this.form.submit()">
                        <option value="">All Purposes</option>
                        <option value="sell" <?= $purpose === 'sell' ? 'selected' : '' ?>>For Sell</option>
                        <option value="rent" <?= $purpose === 'rent' ? 'selected' : '' ?>>For Rent</option>
                    </select>
                    <select name="property_type" class="py-2.5 bg-gray-50/80 text-gray-700 focus:outline-none text-xs font-semibold cursor-pointer border-0 rounded-xl px-3 hover:bg-gray-100 transition" onchange="this.form.submit()">
                        <option value="">All Types</option>
                        <option value="residential" <?= $property_type === 'residential' ? 'selected' : '' ?>>Residential</option>
                        <option value="commercial" <?= $property_type === 'commercial' ? 'selected' : '' ?>>Commercial</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary text-white px-8 py-3.5 rounded-2xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
                    <i data-lucide="search" class="h-4 w-4"></i> Search
                </button>
            </form>
        </div>
    </section>

    <!-- 2. FEATURED PROPERTIES – refined cards -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-12">
            <div>
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50/80 px-4 py-1.5 rounded-full border border-indigo-100">✨ top picks</span>
                <h2 class="text-4xl font-black text-gray-900 tracking-tight mt-3">Featured Properties</h2>
                <p class="text-gray-500 text-sm mt-1">Handpicked listings with prime location & value</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-4 py-2 rounded-full border border-indigo-100"><?= count($properties) ?> listings</span>
                <?php if ($search || $category || $purpose || $property_type || $flat_type): ?>
                    <a href="<?= base_url('/') ?>" class="text-xs text-indigo-600 font-bold hover:underline flex items-center gap-1 bg-white px-3 py-2 rounded-full shadow-sm"><i data-lucide="rotate-ccw" class="h-3.5 w-3.5"></i> Clear</a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (empty($properties)): ?>
            <div class="bg-white rounded-3xl text-center py-20 px-4 border border-gray-100 shadow-soft">
                <div class="bg-indigo-50 p-5 rounded-full inline-block text-indigo-600"><i data-lucide="building-2" class="h-12 w-12"></i></div>
                <h3 class="text-2xl font-bold text-gray-800 mt-4">No Featured Listings</h3>
                <a href="<?= base_url('properties') ?>" class="inline-flex items-center gap-2 btn-primary text-white px-6 py-3 rounded-xl text-sm font-bold mt-4">View All Properties</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach (array_slice($properties, 0, 3) as $property): ?>
                    <div class="property-card group flex flex-col">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="<?= htmlspecialchars(get_image_url($property['image_url'])) ?>" alt="<?= htmlspecialchars($property['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.src='https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80'" />
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider text-white shadow-lg <?= $property['purpose'] === 'sell' ? 'bg-emerald-600' : 'bg-sky-600' ?>">For <?= $property['purpose'] === 'sell' ? 'Sell' : 'Rent' ?></span>
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-gray-900/80 text-white backdrop-blur-sm"><?= htmlspecialchars(get_category_label($property['category'])) ?></span>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="text-2xl font-black text-indigo-600 mb-1"><?= format_price($property['price'], $property['purpose']) ?></div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1"><?= htmlspecialchars($property['title']) ?></h3>
                                <div class="flex items-center text-gray-500 text-sm mt-1"><i data-lucide="map-pin" class="h-4 w-4 mr-1.5 text-indigo-400"></i><span><?= htmlspecialchars($property['location']) ?></span></div>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between items-center text-gray-600 text-xs font-semibold border-t border-b border-gray-100 py-3 mb-4">
                                    <span class="flex items-center gap-1.5"><i data-lucide="bed" class="h-4 w-4 text-indigo-400"></i> <?= $property['bedrooms'] ?> Beds</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="bath" class="h-4 w-4 text-indigo-400"></i> <?= $property['bathrooms'] ?> Baths</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="maximize" class="h-4 w-4 text-indigo-400"></i> <?= $property['area'] ?> sqft</span>
                                </div>
                                <a href="<?= base_url('properties/') ?><?= $property['id'] ?>" class="block text-center bg-gray-50 hover:bg-indigo-600 hover:text-white text-indigo-700 font-bold py-3.5 rounded-2xl transition-all border border-gray-100 group-hover:border-indigo-300">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-14 text-center">
                <a href="<?= base_url('properties') ?>" class="inline-flex items-center gap-3 btn-primary text-white font-extrabold px-8 py-4 rounded-2xl shadow-lg transition-all group">View All Properties (<?= count($properties) ?>) <i data-lucide="arrow-right" class="h-4 w-4 group-hover:translate-x-1 transition-transform"></i></a>
            </div>
        <?php endif; ?>
    </section>

    <!-- 3. PROPERTY TYPES – modern cards -->
    <section class="bg-white/80 py-20 border-y border-gray-100/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center"><span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">explore options</span><h2 class="text-4xl font-black text-gray-900 mt-3">Property Types</h2><p class="text-gray-500 text-sm mt-1">Find categories designed for your lifestyle or business</p></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $types = [
                    ['url' => '?category=na_plot', 'icon' => 'map-pin', 'label' => 'NA Plots', 'desc' => 'Non-Agricultural approved clear title land'],
                    ['url' => '?flat_type=resale', 'icon' => 'home', 'label' => 'Resale Flats', 'desc' => 'Ready-to-move 1/2/3 BHK apartments'],
                    ['url' => '?flat_type=new', 'icon' => 'building-2', 'label' => 'New Projects', 'desc' => 'Upcoming tower launches with amenities'],
                    ['url' => '?property_type=commercial', 'icon' => 'briefcase', 'label' => 'Commercial Spaces', 'desc' => 'Offices, retail shops, co-working'],
                ]; foreach ($types as $t): ?>
                <a href="<?= base_url($t['url']) ?>" class="group bg-white p-7 rounded-3xl border border-gray-100 hover:border-indigo-200 hover:shadow-soft transition-smooth hover-lift space-y-4">
                    <div class="bg-indigo-50 text-indigo-700 p-4 rounded-2xl inline-block group-hover:bg-indigo-600 group-hover:text-white transition-colors"><i data-lucide="<?= $t['icon'] ?>" class="h-7 w-7"></i></div>
                    <div><h3 class="font-bold text-gray-900 text-xl group-hover:text-indigo-600 transition-colors"><?= $t['label'] ?></h3><p class="text-gray-500 text-xs mt-1"><?= $t['desc'] ?></p></div>
                    <span class="text-xs font-bold text-indigo-600 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Browse <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 4. POPULAR LOCATIONS – refined image overlays -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center"><span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">prime areas</span><h2 class="text-4xl font-black text-gray-900 mt-3">Explore Popular Locations</h2><p class="text-gray-500 text-sm">Top-rated residential & commercial hubs</p></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <?php $locs = [
                ['name' => 'Downtown City', 'desc' => 'Commercial & High-rise Flats', 'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80'],
                ['name' => 'Green Valley', 'desc' => 'Clear Title NA Plots & Villas', 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=600&q=80'],
                ['name' => 'Metro Central', 'desc' => 'Luxury Resale & New Apartments', 'img' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=600&q=80'],
                ['name' => 'Airport Road Hub', 'desc' => 'Commercial IT & Retail Offices', 'img' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80'],
            ]; foreach ($locs as $loc): ?>
            <a href="<?= base_url('/') ?>?search=<?= urlencode($loc['name']) ?>" class="group relative rounded-3xl overflow-hidden shadow-lg h-72 block border border-gray-100">
                <img src="<?= $loc['img'] ?>" alt="<?= $loc['name'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950/80 via-gray-900/30 to-transparent p-6 flex flex-col justify-end">
                    <h3 class="font-extrabold text-2xl text-white"><?= $loc['name'] ?></h3>
                    <p class="text-indigo-200 text-xs font-medium"><?= $loc['desc'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 5. WHY CHOOSE – refined -->
    <section class="bg-white/70 py-20 border-y border-gray-100/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center"><span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">our promise</span><h2 class="text-4xl font-black text-gray-900 mt-3">Why Sharda Properties</h2><p class="text-gray-500 text-sm">Expertise + legal transparency</p></div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $reasons = [
                    ['icon' => 'shield-check', 'title' => '100% Verified Titles', 'desc' => 'Legal clearance & 7/12 record verification for every plot and flat.'],
                    ['icon' => 'percent', 'title' => 'Zero Hidden Fees', 'desc' => 'Full price transparency, no vague contract terms during registration.'],
                    ['icon' => 'user-check', 'title' => 'Expert Advisory', 'desc' => 'Dedicated consultants helping buyers and investors make smart choices.'],
                    ['icon' => 'landmark', 'title' => 'Home Loan Assistance', 'desc' => 'Fast-track processing with HDFC, ICICI, SBI, Axis Bank.'],
                ]; foreach ($reasons as $r): ?>
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-soft space-y-4 hover:shadow-lg transition-smooth">
                    <div class="bg-indigo-50 text-indigo-700 p-3.5 rounded-2xl inline-block"><i data-lucide="<?= $r['icon'] ?>" class="h-7 w-7"></i></div>
                    <h3 class="font-bold text-gray-900 text-xl"><?= $r['title'] ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed"><?= $r['desc'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 6. BUY / RENT / SELL – fresh -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center"><span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">services</span><h2 class="text-4xl font-black text-gray-900 mt-3">Buy, Rent or Sell</h2><p class="text-gray-500 text-sm">Tailored solutions for every real estate need</p></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php $actions = [
                ['icon' => 'shopping-bag', 'color' => 'emerald', 'label' => 'Buy A Property', 'desc' => 'Verified NA plots, new launches, resale apartments with clear titles.', 'link' => '?purpose=sell', 'btn' => 'Explore For Sale'],
                ['icon' => 'key', 'color' => 'sky', 'label' => 'Rent A Property', 'desc' => 'Flats, corporate offices, commercial spaces on convenient lease.', 'link' => '?purpose=rent', 'btn' => 'Explore For Rent'],
                ['icon' => 'tag', 'color' => 'indigo', 'label' => 'Sell Your Property', 'desc' => 'List your plot, apartment, or commercial space to 500+ buyers.', 'link' => 'contact', 'btn' => 'List Your Property'],
            ]; foreach ($actions as $a): ?>
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-soft text-center space-y-5 hover:shadow-xl transition-smooth">
                <div class="bg-<?= $a['color'] ?>-50 text-<?= $a['color'] ?>-600 p-4 rounded-2xl inline-block"><i data-lucide="<?= $a['icon'] ?>" class="h-9 w-9"></i></div>
                <h3 class="font-extrabold text-2xl text-gray-900"><?= $a['label'] ?></h3>
                <p class="text-gray-500 text-sm"><?= $a['desc'] ?></p>
                <a href="<?= base_url($a['link']) ?>" class="inline-flex items-center gap-2 bg-<?= $a['color'] ?>-600 text-white px-6 py-3 rounded-2xl font-bold text-xs hover:bg-<?= $a['color'] ?>-700 transition-colors shadow-md"><?= $a['btn'] ?> <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 7. NEW ARRIVALS -->
    <section class="bg-white/80 py-20 border-y border-gray-100/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                <div><span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">just added</span><h2 class="text-4xl font-black text-gray-900 mt-3">New Property Arrivals</h2><p class="text-gray-500 text-sm">Latest listings added this week</p></div>
                <a href="<?= base_url('/') ?>" class="text-sm text-indigo-600 font-bold hover:underline flex items-center gap-1 bg-white px-4 py-2 rounded-full shadow-sm">View all <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></a>
            </div>
            <?php if (empty($properties)): ?><p class="text-gray-500 text-center py-8">No new arrivals.</p><?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach (array_slice(array_reverse($properties), 0, 3) as $np): ?>
                <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-soft transition hover:shadow-xl flex flex-col">
                    <div class="relative h-52 bg-gray-200"><img src="<?= htmlspecialchars(get_image_url($np['image_url'])) ?>" alt="<?= htmlspecialchars($np['title']) ?>" class="w-full h-full object-cover" /><span class="absolute top-3 left-3 bg-rose-600 text-white text-[10px] font-extrabold uppercase px-3 py-1 rounded-full shadow">NEW</span></div>
                    <div class="p-5 space-y-3">
                        <div class="text-xl font-black text-indigo-600"><?= format_price($np['price'], $np['purpose']) ?></div>
                        <h3 class="font-bold text-gray-900 line-clamp-1"><?= htmlspecialchars($np['title']) ?></h3>
                        <div class="text-gray-500 text-xs flex items-center gap-1"><i data-lucide="map-pin" class="h-3.5 w-3.5 text-indigo-400"></i> <?= htmlspecialchars($np['location']) ?></div>
                        <a href="<?= base_url('properties/') ?><?= $np['id'] ?>" class="block text-center bg-indigo-50 hover:bg-indigo-600 hover:text-white text-indigo-700 font-bold text-xs py-3 rounded-2xl transition-all border border-indigo-100">View Property</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- 8. HOW IT WORKS – numbers -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center"><span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">simple process</span><h2 class="text-4xl font-black text-gray-900 mt-3">How It Works</h2><p class="text-gray-500 text-sm">4 easy steps to buy, rent, or invest</p></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $steps = [
                ['num' => '01', 'title' => 'Search & Filter', 'desc' => 'Browse NA plots, flats, or offices matching your budget.'],
                ['num' => '02', 'title' => 'Schedule Site Visit', 'desc' => 'Book an in-person visit with our consultant.'],
                ['num' => '03', 'title' => 'Legal Verification', 'desc' => 'Review 7/12 title deeds & NA clearances.'],
                ['num' => '04', 'title' => 'Key Handover', 'desc' => 'Finalize registration, loan, and receive keys!'],
            ]; foreach ($steps as $s): ?>
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-soft text-center space-y-3 hover:shadow-xl transition-smooth">
                <span class="text-5xl font-black text-indigo-100 block"><?= $s['num'] ?></span>
                <h3 class="font-bold text-gray-900 text-xl"><?= $s['title'] ?></h3>
                <p class="text-gray-500 text-sm"><?= $s['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 9. ABOUT -->
    <section class="bg-white/80 py-20 border-y border-gray-100/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">about</span>
                <h2 class="text-4xl font-black text-gray-900 leading-tight">Your Trusted Real Estate Partner</h2>
                <p class="text-gray-600 text-sm leading-relaxed">Sharda Properties is a leading consultancy specializing in NA plots, residential flats, villas, and commercial spaces. Full legal compliance, integrity, client-first.</p>
                <div class="flex items-center gap-6 pt-2"><div><span class="block text-3xl font-black text-indigo-600">10+ Years</span><span class="text-xs text-gray-500 font-semibold">Industry Experience</span></div><div class="h-10 w-px bg-gray-200"></div><div><span class="block text-3xl font-black text-indigo-600">500+</span><span class="text-xs text-gray-500 font-semibold">Deals Completed</span></div></div>
                <a href="<?= base_url('about') ?>" class="inline-flex items-center gap-2 btn-primary text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-lg">Read More <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
            </div>
            <div class="rounded-3xl overflow-hidden shadow-2xl h-80 md:h-96 bg-gray-200"><img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80" alt="office" class="w-full h-full object-cover" /></div>
        </div>
    </section>

    <!-- 10. TESTIMONIALS – enhanced slider -->
    <section class="bg-indigo-950 text-white py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 text-center">
            <span class="text-xs font-bold text-indigo-300 uppercase tracking-widest bg-indigo-900/60 px-5 py-2 rounded-full border border-indigo-800">client reviews</span>
            <h2 class="text-4xl md:text-5xl font-black tracking-tight">What Our Clients Say</h2>
            <p class="text-indigo-200 text-sm">Real reviews from buyers, investors & tenants</p>
            <div class="max-w-4xl mx-auto relative">
                <div id="testimonialSlider" class="relative rounded-3xl bg-indigo-900/40 backdrop-blur-xl border border-indigo-800/60 p-8 sm:p-14 shadow-2xl min-h-[280px] flex items-center justify-center transition-all">
                    <?php foreach ($testimonials as $index => $t): ?>
                    <div class="testimonial-slide w-full <?= $index === 0 ? 'block opacity-100 scale-100' : 'hidden opacity-0 scale-95' ?>" data-index="<?= $index ?>">
                        <div class="flex justify-center text-amber-400 gap-1.5 mb-6"><?php for ($s=0; $s<($t['rating']??5); $s++) echo '<i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>'; ?></div>
                        <blockquote class="text-indigo-100 text-lg sm:text-2xl font-light italic leading-relaxed max-w-2xl mx-auto mb-8">“<?= htmlspecialchars($t['content']) ?>”</blockquote>
                        <div class="flex items-center justify-center gap-3"><div class="bg-indigo-600 text-white font-extrabold h-12 w-12 rounded-full flex items-center justify-center text-sm shadow-md uppercase"><?= substr($t['name'],0,2) ?></div><div class="text-left"><h4 class="font-extrabold text-white text-lg"><?= htmlspecialchars($t['name']) ?></h4><span class="text-xs text-indigo-300 font-medium"><?= htmlspecialchars($t['role']) ?></span></div></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button id="sliderPrevBtn" class="absolute -left-4 sm:-left-6 top-1/2 -translate-y-1/2 bg-indigo-800/80 hover:bg-indigo-600 text-white p-3.5 rounded-full border border-indigo-700 shadow-xl transition-all cursor-pointer z-20"><i data-lucide="chevron-left" class="h-5 w-5"></i></button>
                <button id="sliderNextBtn" class="absolute -right-4 sm:-right-6 top-1/2 -translate-y-1/2 bg-indigo-800/80 hover:bg-indigo-600 text-white p-3.5 rounded-full border border-indigo-700 shadow-xl transition-all cursor-pointer z-20"><i data-lucide="chevron-right" class="h-5 w-5"></i></button>
                <div id="sliderDots" class="flex justify-center gap-2 mt-6"><?php foreach ($testimonials as $idx=>$t): ?><button class="slider-dot w-3 h-3 rounded-full transition-all cursor-pointer <?= $idx===0 ? 'bg-indigo-400 w-8' : 'bg-indigo-700' ?>" data-index="<?= $idx ?>"></button><?php endforeach; ?></div>
            </div>
        </div>
    </section>

    <!-- 11. CTA BANNER -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-indigo-800 rounded-3xl p-10 sm:p-14 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <div class="relative z-10 max-w-2xl space-y-3 text-center md:text-left"><h2 class="text-3xl sm:text-4xl font-black tracking-tight">Ready to Buy, Sell, or Invest?</h2><p class="text-indigo-100 text-sm leading-relaxed">Schedule a free consultation with our property experts. We’ll guide you through listings, site visits, and paperwork.</p></div>
            <div class="flex flex-col sm:flex-row gap-4 relative z-10"><a href="<?= base_url('contact') ?>" class="bg-white text-indigo-700 font-bold px-8 py-4 rounded-2xl text-sm hover:bg-indigo-50 transition shadow-lg flex items-center gap-2"><i data-lucide="phone-call" class="h-4 w-4"></i> Schedule Consultation</a><a href="<?= base_url('about') ?>" class="bg-indigo-900/40 hover:bg-indigo-900/60 text-white border border-indigo-400/40 font-bold px-8 py-4 rounded-2xl text-sm transition">Learn About Us</a></div>
        </div>
    </section>

</div> <!-- end main content -->

<?php
// ----- ORIGINAL FOOTER (preserved) -----
require_once APPPATH . 'Views/layouts/footer.php';
?>

<!-- lucide icons (same as before) -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>

<!-- slider script (unchanged logic) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.getElementById('sliderPrevBtn');
    const nextBtn = document.getElementById('sliderNextBtn');
    let currentIndex = 0, autoSlideInterval = null;
    if (slides.length <= 1) { if(prevBtn) prevBtn.style.display='none'; if(nextBtn) nextBtn.style.display='none'; return; }
    function showSlide(index) {
        slides.forEach((s,i) => { if(i===index) { s.classList.remove('hidden','opacity-0','scale-95'); s.classList.add('block','opacity-100','scale-100'); } else { s.classList.remove('block','opacity-100','scale-100'); s.classList.add('hidden','opacity-0','scale-95'); } });
        dots.forEach((d,i) => { d.className = 'slider-dot w-3 h-3 rounded-full transition-all cursor-pointer ' + (i===index ? 'bg-indigo-400 w-8' : 'bg-indigo-700'); });
        currentIndex = index;
    }
    function nextSlide() { showSlide((currentIndex+1)%slides.length); }
    function prevSlide() { showSlide((currentIndex-1+slides.length)%slides.length); }
    if(nextBtn) nextBtn.addEventListener('click', nextSlide);
    if(prevBtn) prevBtn.addEventListener('click', prevSlide);
    dots.forEach(d => d.addEventListener('click', function() { showSlide(parseInt(this.dataset.index)); }));
    function startAuto() { autoSlideInterval = setInterval(nextSlide, 5000); }
    function stopAuto() { if(autoSlideInterval) clearInterval(autoSlideInterval); }
    const sliderElem = document.getElementById('testimonialSlider');
    if(sliderElem) { sliderElem.addEventListener('mouseenter', stopAuto); sliderElem.addEventListener('mouseleave', startAuto); }
    startAuto();
});
</script>

</body>
</html>
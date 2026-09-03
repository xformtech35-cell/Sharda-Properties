<?php
require_once APPPATH . 'Views/config.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$purpose = $_GET['purpose'] ?? '';
$property_type = $_GET['property_type'] ?? '';
$flat_type = $_GET['flat_type'] ?? '';
$location = $_GET['location'] ?? '';

// Query params for API
$params = array_filter([
    'search' => $search,
    'category' => $category,
    'purpose' => $purpose,
    'property_type' => $property_type,
    'flat_type' => $flat_type,
    'location' => $location,
]);

$properties = fetch_api_data('properties', $params) ?? [];

$page_title = 'All Properties - Sharda Properties';
if ($flat_type === 'resale') {
    $page_title = 'Resale Flats for Sale - Sharda Properties';
} elseif ($flat_type === 'new') {
    $page_title = 'New Flats for Sale - Sharda Properties';
} elseif ($category === 'na_plot') {
    $page_title = 'NA Plots for Sale - Sharda Properties';
} elseif ($property_type === 'commercial') {
    $page_title = 'Commercial Properties - Sharda Properties';
}

$page_description = 'Browse our complete catalog of verified NA plots, modern flats, offices, residential & commercial properties for sale and rent.';

require_once APPPATH . 'Views/layouts/header.php';

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
?>

<div class="bg-gray-50 min-h-screen pb-16">
    
    <!-- Page Header & Filter Section -->
    <section class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-indigo-950 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden hero-section">
        <!-- Glowing background accent orbs -->
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-delay: 2s;"></div>

        <div class="absolute inset-0 opacity-15 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>
        <div class="max-w-7xl mx-auto text-center relative z-10 space-y-4">
            <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase border border-white/10 animate-fade-in-up">Full Catalog</span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight animate-fade-in-up delay-100">Explore All Properties</h1>
            <p class="text-indigo-200 text-base max-w-2xl mx-auto animate-fade-in-up delay-200">
                Find verified NA plots, new project flats, resale apartments, and commercial offices.
            </p>

            <!-- Search & Filter Form with entrance & hover glow -->
            <form action="<?= base_url('properties') ?>" method="GET" class="mt-8 max-w-4xl mx-auto bg-white p-2.5 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-2 text-gray-800 border border-indigo-100/20 animate-fade-in-up delay-300 hover:border-indigo-400/40 transition-all">
                <div class="flex-grow flex items-center px-3 border-b md:border-b-0 md:border-r border-gray-200">
                    <i data-lucide="search" class="h-5 w-5 text-gray-400 mr-2 shrink-0"></i>
                    <input
                        type="text"
                        name="search"
                        placeholder="Search location, title, keyword..."
                        class="w-full py-3 focus:outline-none text-gray-800 text-sm font-medium"
                        value="<?= htmlspecialchars($search) ?>"
                    />
                </div>
                
                <div class="flex flex-wrap sm:flex-nowrap items-center px-2 gap-2">
                    <select
                        name="category"
                        class="flex-1 min-w-[110px] w-full sm:w-auto py-2.5 bg-gray-50 text-gray-700 focus:outline-none text-xs font-semibold cursor-pointer border border-gray-200 rounded-xl px-3 hover:bg-gray-100 transition"
                        onchange="this.form.submit()"
                    >
                        <option value="">All Categories</option>
                        <option value="na_plot" <?= $category === 'na_plot' ? 'selected' : '' ?>>NA Plots</option>
                        <option value="flat" <?= $category === 'flat' ? 'selected' : '' ?>>Flats</option>
                        <option value="office" <?= $category === 'office' ? 'selected' : '' ?>>Offices</option>
                    </select>

                    <select
                        name="purpose"
                        class="flex-1 min-w-[110px] w-full sm:w-auto py-2.5 bg-gray-50 text-gray-700 focus:outline-none text-xs font-semibold cursor-pointer border border-gray-200 rounded-xl px-3 hover:bg-gray-100 transition"
                        onchange="this.form.submit()"
                    >
                        <option value="">All Purposes</option>
                        <option value="sell" <?= $purpose === 'sell' ? 'selected' : '' ?>>For Sell</option>
                        <option value="rent" <?= $purpose === 'rent' ? 'selected' : '' ?>>For Rent</option>
                    </select>

                    <select
                        name="property_type"
                        class="flex-1 min-w-[110px] w-full sm:w-auto py-2.5 bg-gray-50 text-gray-700 focus:outline-none text-xs font-semibold cursor-pointer border border-gray-200 rounded-xl px-3 hover:bg-gray-100 transition"
                        onchange="this.form.submit()"
                    >
                        <option value="">All Types</option>
                        <option value="residential" <?= $property_type === 'residential' ? 'selected' : '' ?>>Residential</option>
                        <option value="commercial" <?= $property_type === 'commercial' ? 'selected' : '' ?>>Commercial</option>
                    </select>
                </div>

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-all cursor-pointer shrink-0 shadow-md flex items-center justify-center gap-2 hover:scale-102 w-full md:w-auto"
                >
                    <i data-lucide="search" class="h-4 w-4"></i> Search
                </button>
            </form>
        </div>
    </section>

    <!-- Properties Grid Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-8 scroll-reveal">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Property Listings
                </h2>
                <p class="text-gray-500 text-sm">Showing all available properties matching your criteria</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full border border-indigo-100"><?= count($properties) ?> Properties Available</span>
                <?php if ($search || $category || $purpose || $property_type || $flat_type): ?>
                    <a href="<?= base_url('properties') ?>" class="text-xs text-indigo-600 font-bold hover:underline cursor-pointer flex items-center gap-1 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-2xs">
                        <i data-lucide="rotate-ccw" class="h-3.5 w-3.5"></i> Clear Filters
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (empty($properties)): ?>
            <div class="bg-white rounded-3xl text-center py-20 px-4 border border-gray-100 space-y-4 shadow-sm scroll-reveal">
                <div class="bg-indigo-50 p-4 rounded-full inline-block text-indigo-600">
                    <i data-lucide="building-2" class="h-10 w-10"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">No Properties Found</h3>
                <p class="text-gray-500 text-sm max-w-md mx-auto">We couldn't find any property matching your search parameters. Try clearing filters or searching for another location.</p>
                <a href="<?= base_url('properties') ?>" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                    <i data-lucide="rotate-ccw" class="h-4 w-4"></i> Reset All Filters
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ($properties as $index => $property): ?>
                    <div class="group bg-white rounded-2xl shadow-md card-hover-smooth scroll-reveal delay-<?= (($index % 6) + 1) * 100 ?> overflow-hidden border border-gray-100 flex flex-col">
                        <div class="relative h-60 bg-gray-100 overflow-hidden shrink-0">
                            <img
                                src="<?= htmlspecialchars(get_image_url($property['image_url'])) ?>"
                                alt="<?= htmlspecialchars($property['title']) ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.src='https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80'"
                            />
                            <div class="absolute top-4 left-4 flex flex-col gap-1.5 items-start z-10">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider text-white shadow-md <?= $property['purpose'] === 'sell' ? 'bg-emerald-600' : 'bg-sky-600' ?>">
                                    For <?= $property['purpose'] === 'sell' ? 'Sell' : 'Rent' ?>
                                </span>
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-gray-900/80 text-white backdrop-blur-xs shadow-md">
                                    <?= htmlspecialchars(get_category_label($property['category'])) ?>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="text-2xl font-extrabold text-indigo-600 mb-1.5">
                                    <?= format_price($property['price'], $property['purpose']) ?>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1 mb-1.5">
                                    <?= htmlspecialchars($property['title']) ?>
                                </h3>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i data-lucide="map-pin" class="h-4 w-4 mr-1.5 text-indigo-500 shrink-0"></i>
                                    <span class="line-clamp-1"><?= htmlspecialchars($property['location']) ?></span>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between items-center text-gray-600 text-xs font-semibold border-t border-b border-gray-100 py-3 mb-4 shrink-0 gap-1.5 sm:gap-3">
                                    <div class="flex items-center gap-1 sm:gap-1.5 text-[11px] sm:text-xs">
                                        <i data-lucide="bed" class="h-4 w-4 text-indigo-500 shrink-0"></i>
                                        <span><?= htmlspecialchars($property['bedrooms']) ?> Beds</span>
                                    </div>
                                    <div class="flex items-center gap-1 sm:gap-1.5 text-[11px] sm:text-xs">
                                        <i data-lucide="bath" class="h-4 w-4 text-indigo-500 shrink-0"></i>
                                        <span><?= htmlspecialchars($property['bathrooms']) ?> Baths</span>
                                    </div>
                                    <div class="flex items-center gap-1 sm:gap-1.5 text-[11px] sm:text-xs">
                                        <i data-lucide="maximize" class="h-4 w-4 text-indigo-500 shrink-0"></i>
                                        <span><?= htmlspecialchars($property['area']) ?> sqft</span>
                                    </div>
                                </div>

                                <a href="<?= base_url('properties/') ?><?= $property['id'] ?>" class="block text-center bg-gray-50 hover:bg-indigo-600 hover:text-white text-indigo-700 font-bold py-3 rounded-xl transition-all shadow-2xs border border-gray-100 group-hover:border-indigo-300">
                                    View Full Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

<?php
// Property Details Page View
require_once APPPATH . 'Views/config.php';

// Safe property fallback if loaded directly or id mismatch
if (empty($property) || !is_array($property)) {
    $propId = $_GET['id'] ?? null;
    if ($propId) {
        try {
            $db = \Config\Database::connect();
            $property = $db->table('sp_properties')->where('id', $propId)->get()->getRowArray();
        } catch (\Throwable $e) {}
    }
}

if (empty($property) || !is_array($property)) {
    $property = [
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
        'google_map' => 'City Center, Main Road',
        'description' => 'Spacious 3BHK flat with modern amenities, 24/7 power backup, and dedicated parking.'
    ];
}

if (!function_exists('get_image_url')) {
    function get_image_url($url) {
        if (empty($url)) return 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80';
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) return $url;
        return base_url(ltrim($url, '/'));
    }
}

if (!function_exists('format_price')) {
    function format_price($price, $purpose) {
        $formatted = '$' . number_format((float)$price);
        return $purpose === 'rent' ? $formatted . '/mo' : $formatted;
    }
}

if (!function_exists('get_google_map_embed_src')) {
    function get_google_map_embed_src($input, $location = '') {
        $val = trim($input ?? '');

        // 1. If full iframe tag was pasted (e.g. <iframe src="...">)
        if (preg_match('/src=["\']([^"\']+)["\']/', $val, $m)) {
            return $m[1];
        }

        // 2. If official Google Maps embed URL
        if (str_contains($val, 'maps/embed') && str_contains($val, 'pb=')) {
            return $val;
        }

        // 3. If Google Maps short link (maps.app.goo.gl or goo.gl/maps)
        if (str_contains($val, 'goo.gl')) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $val);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 4);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
                $html = curl_exec($ch);
                curl_close($ch);

                if ($html) {
                    // Extract exact pin coordinates !3dLat!4dLng
                    if (preg_match('/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/', $html, $m)) {
                        return 'https://maps.google.com/maps?q=' . $m[1] . ',' . $m[2] . '&t=&z=16&ie=UTF8&iwloc=&output=embed';
                    }
                    if (preg_match('/[?&]q=([^&"\'<>]+)/i', $html, $m)) {
                        $val = urldecode($m[1]);
                    } elseif (preg_match('/<title>(.*?)<\/title>/i', $html, $m)) {
                        $cleanTitle = trim(str_ireplace(['- Google Maps', 'Google Maps'], '', $m[1]));
                        if (!empty($cleanTitle)) {
                            $val = $cleanTitle;
                        }
                    }
                }
            } catch (\Throwable $e) {}
        }

        // 4. Prevent raw URLs from being passed into q= parameter
        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
            $val = trim($location ?? '');
        }

        // 5. Final query string
        $query = !empty($val) ? $val : trim($location ?? '');
        if (empty($query)) return null;

        return 'https://maps.google.com/maps?q=' . urlencode($query) . '&t=&z=16&ie=UTF8&iwloc=&output=embed';
    }
}

$directMapUrl = '';
if (!empty($property['google_map'])) {
    $directMapUrl = str_starts_with($property['google_map'], 'http') ? $property['google_map'] : 'https://www.google.com/maps/search/?api=1&query=' . urlencode($property['google_map']);
} else if (!empty($property['location'])) {
    $directMapUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($property['location']);
}

$meta_title = htmlspecialchars($property['title']) . ' in ' . htmlspecialchars($property['location']) . ' | Sharda Properties';
$meta_description = htmlspecialchars(substr(strip_tags($property['description'] ?? ''), 0, 160));
$meta_image = get_image_url($property['image_url']);

require_once APPPATH . 'Views/layouts/header.php';
?>

<div class="bg-gray-50 min-h-screen pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <a href="<?= base_url('properties') ?>" class="inline-flex items-center gap-1.5 text-gray-600 hover:text-indigo-600 font-semibold mb-6 transition-colors">
            <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to All Properties
        </a>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Details Section (ColSpan 2) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Image Container -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
                    <div class="h-[400px] sm:h-[500px] relative bg-gray-100">
                        <img
                            src="<?= htmlspecialchars(get_image_url($property['image_url'])) ?>"
                            alt="<?= htmlspecialchars($property['title']) ?>"
                            class="w-full h-full object-cover"
                            onerror="this.src='https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80'"
                        />
                        <div class="absolute top-4 left-4 px-4 py-1.5 rounded-full text-sm font-bold uppercase tracking-wider text-white <?= $property['purpose'] === 'sell' ? 'bg-green-600' : 'bg-blue-600' ?>">
                            For <?= $property['purpose'] === 'sell' ? 'Sale' : 'Rent' ?>
                        </div>
                    </div>
                </div>

                <!-- Core Info -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-md border border-gray-100 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900"><?= htmlspecialchars($property['title']) ?></h1>
                            <div class="flex flex-wrap items-center gap-3 text-gray-500 mt-2">
                                <div class="flex items-center">
                                    <i data-lucide="map-pin" class="h-5 w-5 mr-1.5 text-indigo-600 shrink-0"></i>
                                    <span class="font-medium text-gray-700"><?= htmlspecialchars($property['location']) ?></span>
                                </div>
                                <?php if (!empty($directMapUrl)): ?>
                                <a href="<?= htmlspecialchars($directMapUrl) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded-full transition-colors shadow-2xs">
                                    <i data-lucide="external-link" class="h-3.5 w-3.5"></i> Open in Google Maps
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="text-3xl font-extrabold text-indigo-600 whitespace-nowrap">
                            <?= format_price($property['price'], $property['purpose']) ?>
                        </div>
                    </div>

                    <!-- Specs Row -->
                    <div class="flex flex-wrap gap-6 text-gray-600 border-t border-b border-gray-100 py-4">
                        <div class="flex items-center gap-2">
                            <i data-lucide="bed" class="h-5 w-5 text-indigo-500"></i>
                            <div>
                                <span class="block font-bold text-gray-900"><?= htmlspecialchars($property['bedrooms']) ?></span>
                                <span class="text-xs text-gray-500">Bedrooms</span>
                            </div>
                        </div>
                        <div class="h-10 w-px bg-gray-200 self-center"></div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="bath" class="h-5 w-5 text-indigo-500"></i>
                            <div>
                                <span class="block font-bold text-gray-900"><?= htmlspecialchars($property['bathrooms']) ?></span>
                                <span class="text-xs text-gray-500">Bathrooms</span>
                            </div>
                        </div>
                        <div class="h-10 w-px bg-gray-200 self-center"></div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="maximize" class="h-5 w-5 text-indigo-500"></i>
                            <div>
                                <span class="block font-bold text-gray-900"><?= htmlspecialchars($property['area']) ?></span>
                                <span class="text-xs text-gray-500">Square Feet</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                            <?= nl2br(htmlspecialchars($property['description'] ?: 'No description provided for this property.')) ?>
                        </p>
                    </div>

                    <!-- Google Map Section -->
                    <?php 
                    $mapSrc = get_google_map_embed_src($property['google_map'] ?? '', $property['location'] ?? '');
                    if ($mapSrc): 
                    ?>
                    <div class="border-t border-gray-100 pt-6 space-y-3">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i data-lucide="map-pin" class="h-5 w-5 text-indigo-600"></i> Property Location Map
                            </h3>
                            <?php if (!empty($directMapUrl)): ?>
                            <a href="<?= htmlspecialchars($directMapUrl) ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-indigo-600 hover:underline inline-flex items-center gap-1">
                                Open full map <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="h-[350px] w-full rounded-xl overflow-hidden border border-gray-200 shadow-sm relative bg-gray-50">
                            <iframe
                                src="<?= esc($mapSrc) ?>"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Contact / Side Widget -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Listed By</h3>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-indigo-50 p-3 rounded-full text-indigo-600">
                            <i data-lucide="user" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Sharda Properties Agent</h4>
                            <span class="text-xs text-gray-500">Certified Broker</span>
                        </div>
                    </div>

                    <div id="enquiryAlert" class="hidden mb-4 p-3 rounded-lg text-sm font-semibold"></div>

                    <!-- Property Inquiry Form -->
                    <form id="propertyDetailForm" class="space-y-4">
                        <input type="hidden" name="property_id" value="<?= htmlspecialchars($property['id']) ?>">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Your Name *</label>
                            <input type="text" name="name" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Your Email *</label>
                            <input type="email" name="email" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="john@example.com">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Your Phone *</label>
                            <input type="tel" name="phone" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="+91 9876543210">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Message *</label>
                            <textarea name="message" rows="3" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 resize-none" placeholder="I am interested in this property..."></textarea>
                        </div>
                        <button type="submit" id="enquirySubmitBtn" class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white font-bold py-3 px-4 rounded-xl transition-all cursor-pointer shadow-md shadow-indigo-100">
                            <span id="enquirySubmitSpinner" class="hidden"><svg class="animate-spin-custom h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>
                            <span id="enquirySubmitText">Send Property Enquiry</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('propertyDetailForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('enquirySubmitBtn');
        const submitText = document.getElementById('enquirySubmitText');
        const submitSpinner = document.getElementById('enquirySubmitSpinner');
        const alertBox = document.getElementById('enquiryAlert');

        submitBtn.disabled = true;
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        if (submitText) submitText.innerText = 'Sending Enquiry...';
        alertBox.classList.add('hidden');
        if (window.TopLoader) window.TopLoader.start();

        const formData = new FormData(this);
        try {
            const res = await fetch('<?= base_url('api/enquiries') ?>', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (res.ok) {
                alertBox.className = 'mb-4 p-3 rounded-lg text-sm font-semibold bg-green-50 text-green-700 border border-green-200 animate-fade-in';
                alertBox.innerText = 'Enquiry sent successfully! Our agent will contact you soon.';
                alertBox.classList.remove('hidden');
                this.reset();
            } else {
                alertBox.className = 'mb-4 p-3 rounded-lg text-sm font-semibold bg-red-50 text-red-700 border border-red-200 animate-fade-in';
                alertBox.innerText = data.error || 'Failed to send enquiry.';
                alertBox.classList.remove('hidden');
            }
        } catch (err) {
            alertBox.className = 'mb-4 p-3 rounded-lg text-sm font-semibold bg-red-50 text-red-700 border border-red-200 animate-fade-in';
            alertBox.innerText = 'Network error. Please try again.';
            alertBox.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            if (submitSpinner) submitSpinner.classList.add('hidden');
            if (submitText) submitText.innerText = 'Send Property Enquiry';
            if (window.TopLoader) window.TopLoader.complete();
        }
    });
</script>

<?= $this->include('layouts/footer') ?>

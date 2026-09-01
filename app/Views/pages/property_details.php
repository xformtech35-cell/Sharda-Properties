<?php
require_once APPPATH . 'Views/config.php';

// If property variable not passed from Controller, fetch via GET parameter
if (!isset($property) || empty($property)) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $property = fetch_api_data("properties/{$id}");
    }
}

if (!isset($property) || empty($property)) {
    $meta_title = 'Property Not Found - Sharda Properties';
    require_once APPPATH . 'Views/layouts/header.php';
    ?>
    <div class="min-h-[70vh] flex flex-col items-center justify-center bg-gray-50 px-4">
        <h2 class="text-2xl font-bold text-gray-800">Property Not Found</h2>
        <p class="text-gray-500 mt-2">The property you are looking for might have been removed or does not exist.</p>
        <a href="<?= base_url('/') ?>" class="mt-6 inline-flex items-center gap-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
            <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to Listings
        </a>
    </div>
    <?php
    require_once APPPATH . 'Views/layouts/footer.php';
    exit;
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
                            <div class="flex items-center text-gray-500 mt-2">
                                <i data-lucide="map-pin" class="h-5 w-5 mr-1.5 text-gray-400 shrink-0"></i>
                                <span><?= htmlspecialchars($property['location']) ?></span>
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

                    <div class="space-y-3.5 mb-6 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <i data-lucide="phone" class="h-4 w-4 text-indigo-600"></i>
                            <span>+91 98765 43210</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="h-4 w-4 text-indigo-600"></i>
                            <span>contact@shardaproperties.com</span>
                        </div>
                    </div>

                    <!-- Inquiry Form -->
                    <div class="border-t border-gray-100 pt-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Send Inquiry</h4>
                        
                        <div id="propertyInquiryAlert" class="hidden mb-4 p-4 rounded-lg text-sm text-center font-medium"></div>

                        <form id="propertyInquiryForm" class="space-y-3">
                            <input type="hidden" name="property_id" value="<?= $property['id'] ?>">
                            <input
                                type="text"
                                name="name"
                                placeholder="Your Name"
                                required
                                class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500"
                            />
                            <input
                                type="email"
                                name="email"
                                placeholder="Your Email"
                                required
                                class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500"
                            />
                            <input
                                type="tel"
                                name="phone"
                                placeholder="Your Phone Number"
                                required
                                class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500"
                            />
                            <textarea
                                name="message"
                                placeholder="I'm interested in this property..."
                                rows="3"
                                required
                                class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 resize-none"
                            ></textarea>
                            <button
                                type="submit"
                                id="propertyInquirySubmitBtn"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors cursor-pointer"
                            >
                                Submit Inquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('propertyInquiryForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const alertBox = document.getElementById('propertyInquiryAlert');
        const submitBtn = document.getElementById('propertyInquirySubmitBtn');
        const formData = new FormData(this);
        
        submitBtn.disabled = true;
        submitBtn.innerText = 'Sending...';
        alertBox.classList.add('hidden');

        try {
            const response = await fetch('<?= base_url('api/enquiries') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData)),
            });

            const data = await response.json();

            if (response.ok) {
                alertBox.className = 'mb-4 bg-green-50 text-green-700 p-4 rounded-lg text-sm text-center font-medium';
                alertBox.innerText = 'Thank you! Your inquiry has been sent. An agent will contact you shortly.';
                alertBox.classList.remove('hidden');
                this.reset();
            } else {
                alertBox.className = 'mb-4 bg-red-50 text-red-700 p-4 rounded-lg text-sm text-center font-medium';
                alertBox.innerText = data.error || 'Failed to submit inquiry. Please check your inputs.';
                alertBox.classList.remove('hidden');
            }
        } catch (err) {
            alertBox.className = 'mb-4 bg-red-50 text-red-700 p-4 rounded-lg text-sm text-center font-medium';
            alertBox.innerText = 'Network error. Please try again later.';
            alertBox.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Submit Inquiry';
        }
    });
</script>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

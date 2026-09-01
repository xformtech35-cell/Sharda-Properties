<?php
require_once APPPATH . 'Views/config.php';

$page_title = 'Our Partners & Developers - Sharda Properties';
$page_description = 'Explore our network of trusted real estate developers, financial institution partners, banking partners, and channel partners.';

require_once APPPATH . 'Views/layouts/header.php';
?>

<div class="bg-gray-50 min-h-screen pb-16">
    <!-- Header -->
    <div class="bg-indigo-900 text-white py-16 px-4 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>
        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold tracking-tight">Our Partners & Collaborators</h1>
            <p class="mt-4 text-lg text-indigo-100 max-w-2xl mx-auto">
                Partnering with leading real estate developers, financial institutions, and channel networks to bring you top-tier property choices.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 space-y-16">

        <!-- Developers & Financial Partners -->
        <div class="space-y-8">
            <h2 class="text-2xl font-bold text-gray-900 text-center">Top Developer Partners</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="bg-indigo-50 p-4 rounded-xl inline-block text-indigo-600">
                        <i data-lucide="building-2" class="h-8 w-8"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Sharda Builders</h3>
                    <p class="text-gray-500 text-xs">Premium Residential & NA Plot Developers</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="bg-indigo-50 p-4 rounded-xl inline-block text-indigo-600">
                        <i data-lucide="building" class="h-8 w-8"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Apex Heights Group</h3>
                    <p class="text-gray-500 text-xs">Luxury High-Rise Flats & Villas</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="bg-indigo-50 p-4 rounded-xl inline-block text-indigo-600">
                        <i data-lucide="briefcase" class="h-8 w-8"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Metro Commercial Corp</h3>
                    <p class="text-gray-500 text-xs">Modern Commercial Offices & IT Parks</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="bg-indigo-50 p-4 rounded-xl inline-block text-indigo-600">
                        <i data-lucide="map-pin" class="h-8 w-8"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Greenfield Estates</h3>
                    <p class="text-gray-500 text-xs">Approved NA Plotting Layouts</p>
                </div>

            </div>
        </div>

        <!-- Banking & Loan Partners -->
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <h2 class="text-2xl font-bold text-gray-900">Banking & Home Loan Partners</h2>
                <p class="text-gray-600 text-sm">We assist our clients with hassle-free home loan approvals and quick disbursement through our partner banks.</p>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center font-bold text-gray-700 text-sm">
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center justify-center gap-2">
                    <i data-lucide="landmark" class="h-5 w-5 text-indigo-600"></i> HDFC Bank
                </div>
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center justify-center gap-2">
                    <i data-lucide="landmark" class="h-5 w-5 text-indigo-600"></i> ICICI Bank
                </div>
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center justify-center gap-2">
                    <i data-lucide="landmark" class="h-5 w-5 text-indigo-600"></i> State Bank of India
                </div>
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center justify-center gap-2">
                    <i data-lucide="landmark" class="h-5 w-5 text-indigo-600"></i> Axis Bank
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

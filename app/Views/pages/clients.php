<?php
require_once APPPATH . 'Views/config.php';

$page_title = 'Our Clients & Testimonials - Sharda Properties';
$page_description = 'Discover our valued clients, successful real estate transactions, and testimonials from property buyers, sellers, and investors.';

require_once APPPATH . 'Views/layouts/header.php';
?>

<div class="bg-gray-50 min-h-screen pb-16">
    <!-- Header -->
    <div class="bg-indigo-900 text-white py-16 px-4 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>
        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold tracking-tight">Our Clients & Testimonials</h1>
            <p class="mt-4 text-lg text-indigo-100 max-w-2xl mx-auto">
                Building lifelong relationships based on trust, authenticity, and successful real estate investments.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 space-y-16">

        <!-- Stats Overview -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <span class="block text-3xl font-extrabold text-indigo-600">500+</span>
                <span class="text-gray-500 text-sm font-medium mt-1 block">Happy Families</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <span class="block text-3xl font-extrabold text-indigo-600">120+</span>
                <span class="text-gray-500 text-sm font-medium mt-1 block">NA Plots Sold</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <span class="block text-3xl font-extrabold text-indigo-600">85+</span>
                <span class="text-gray-500 text-sm font-medium mt-1 block">Commercial Spaces</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <span class="block text-3xl font-extrabold text-indigo-600">99%</span>
                <span class="text-gray-500 text-sm font-medium mt-1 block">Client Satisfaction</span>
            </div>
        </div>

        <!-- Client Testimonials Grid -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">What Our Clients Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 gap-1 mb-3">
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed italic">
                            "Sharda Properties made our dream of owning a 3BHK flat completely seamless. Their documentation process was transparent and stress-free!"
                        </p>
                    </div>
                    <div class="border-t border-gray-100 pt-4 flex items-center gap-3">
                        <div class="bg-indigo-100 text-indigo-700 font-bold h-10 w-10 rounded-full flex items-center justify-center">
                            RK
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Rajesh Kulkarni</h4>
                            <span class="text-xs text-gray-500">Homeowner, City Center</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 gap-1 mb-3">
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed italic">
                            "Finding an authentic NA plot with legal clearance can be tough. Sharda Properties provided clear title verification and smooth registration."
                        </p>
                    </div>
                    <div class="border-t border-gray-100 pt-4 flex items-center gap-3">
                        <div class="bg-indigo-100 text-indigo-700 font-bold h-10 w-10 rounded-full flex items-center justify-center">
                            PS
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Priya Sharma</h4>
                            <span class="text-xs text-gray-500">Investor, NA Plot Owner</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 gap-1 mb-3">
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                            <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed italic">
                            "We leased a prime commercial office through Sharda Properties. Professional support and excellent negotiation!"
                        </p>
                    </div>
                    <div class="border-t border-gray-100 pt-4 flex items-center gap-3">
                        <div class="bg-indigo-100 text-indigo-700 font-bold h-10 w-10 rounded-full flex items-center justify-center">
                            AM
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Amit Mehta</h4>
                            <span class="text-xs text-gray-500">Commercial Tenant</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

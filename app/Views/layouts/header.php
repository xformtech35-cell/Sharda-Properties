<?php
require_once APPPATH . 'Views/config.php';

function is_page_active($path, $param_key = '', $param_val = '') {
    $uri = strtolower($_SERVER['REQUEST_URI'] ?? '');
    $flat_type = strtolower($_GET['flat_type'] ?? '');
    $category = strtolower($_GET['category'] ?? '');
    $property_type = strtolower($_GET['property_type'] ?? '');

    if ($param_key !== '' && $param_val !== '') {
        if ($param_key === 'flat_type' && $flat_type === strtolower($param_val)) return true;
        if ($param_key === 'category' && $category === strtolower($param_val)) return true;
        if ($param_key === 'property_type' && $property_type === strtolower($param_val)) return true;
        return false;
    }

    if ($path === 'home' || $path === 'index.php' || $path === '/') {
        if (!empty($flat_type) || !empty($category) || !empty($property_type)) {
            return false;
        }
        $clean_uri = strtok($uri, '?');
        if (str_ends_with($clean_uri, '/') || str_ends_with($clean_uri, '/index.php') || str_ends_with($clean_uri, '/public') || $clean_uri === '/sharda-properties') {
            return true;
        }
        return false;
    }

    $base_name = str_replace('.php', '', strtolower(ltrim($path, '/')));
    return str_contains($uri, '/' . $base_name);
}

function nav_active_class($path, $param_key = '', $param_val = '') {
    if (is_page_active($path, $param_key, $param_val)) {
        return 'text-indigo-600 font-extrabold bg-indigo-50 border-b-2 border-indigo-600 rounded-lg px-3 py-2 text-xs sm:text-sm shadow-2xs transition-all';
    }
    return 'text-gray-600 hover:text-indigo-600 hover:bg-gray-100 rounded-lg px-3 py-2 text-xs sm:text-sm font-semibold transition-all';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($meta_title) ? esc($meta_title) : 'Sharda Properties - Real Estate Listings' ?></title>
    <meta name="description" content="<?= isset($meta_description) ? esc($meta_description) : 'Premium NA plots, flats, offices, residential & commercial properties for sale and rent.' ?>">
    <meta name="keywords" content="Sharda Properties, NA plots, resale flats, new flats, commercial, real estate">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags for SEO -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= isset($meta_title) ? esc($meta_title) : 'Sharda Properties' ?>">
    <meta property="og:description" content="<?= isset($meta_description) ? esc($meta_description) : 'Premium NA plots, flats, offices, residential & commercial properties.' ?>">
    <?php if (isset($meta_image) && $meta_image): ?>
    <meta property="og:image" content="<?= esc($meta_image) ?>">
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom Smooth Animations & Loaders CSS -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Top Progress Bar Loader */
        #globalTopLoader {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #818cf8, #a5b4fc);
            z-index: 99999;
            transition: width 0.4s ease-out, opacity 0.4s ease-out;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.7);
        }

        /* Keyframes */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.96);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes spinSlow {
            to { transform: rotate(360deg); }
        }

        /* Skeleton Loading Utility */
        .skeleton {
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 37%, #f3f4f6 63%);
            background-size: 400% 100%;
            animation: shimmer 1.4s ease infinite;
            border-radius: 0.5rem;
        }

        /* Utility Animation Classes */
        .animate-fade-in-up {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-in-out both;
        }

        .animate-scale-in {
            animation: scaleIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .animate-spin-custom {
            animation: spinSlow 0.8s linear infinite;
        }

        /* Scroll Reveal Animations */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-reveal-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .scroll-reveal-left.revealed {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-reveal-right {
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .scroll-reveal-right.revealed {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .scroll-reveal-scale.revealed {
            opacity: 1;
            transform: scale(1);
        }

        /* Stagger Delay Classes */
        .delay-100 { animation-delay: 0.1s; transition-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; transition-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; transition-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; transition-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; transition-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; transition-delay: 0.6s; }

        /* Card Hover Transition */
        .card-hover-smooth {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
        }
        .card-hover-smooth:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -10px rgba(79, 70, 229, 0.15);
        }

        /* Smooth Mobile Drawer */
        #mobileMenuDrawer {
            transition: max-height 0.35s ease-in-out, opacity 0.3s ease-in-out, padding 0.35s ease-in-out;
            overflow: hidden;
        }
        #mobileMenuDrawer.drawer-closed {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
            pointer-events: none;
        }
        #mobileMenuDrawer.drawer-open {
            max-height: 650px;
            opacity: 1;
            padding-top: 0.75rem;
            padding-bottom: 1rem;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans text-gray-800 antialiased">
    
    <!-- Top Progress Bar Loader -->
    <div id="globalTopLoader"></div>

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <!-- Brand Logo -->
                <div class="flex items-center">
                    <a href="<?= base_url('/') ?>" class="flex items-center gap-2.5 text-xl font-extrabold text-indigo-700 hover:opacity-90 transition-opacity">
                        <div class="bg-indigo-600 text-white p-2 rounded-xl shadow-sm">
                            <i data-lucide="home" class="h-5 w-5"></i>
                        </div>
                        <span class="tracking-tight">Sharda <span class="text-gray-900 font-bold">Properties</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation Items -->
                <div class="hidden lg:flex items-center gap-1.5 font-medium">
                    <a href="<?= base_url('/') ?>" class="<?= nav_active_class('home') ?>">
                        Home
                    </a>
                    <a href="<?= base_url('about') ?>" class="<?= nav_active_class('about') ?>">
                        About Us
                    </a>
                    <a href="<?= base_url('properties') ?>" class="<?= nav_active_class('properties') ?>">
                        Listing
                    </a>
                   
                    <a href="<?= base_url('partners') ?>" class="<?= nav_active_class('partners') ?>">
                        Partners
                    </a>
                    <a href="<?= base_url('contact') ?>" class="<?= nav_active_class('contact') ?>">
                        Contact Us
                    </a>
                </div>

                <!-- Admin Action Button / Auth State -->
                <div class="hidden lg:flex items-center gap-2">
                    <span id="navAuthContainer">
                        <a href="<?= base_url('login') ?>" id="navLoginBtn" class="flex items-center gap-1.5 bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 transition-all shadow-sm hover:shadow cursor-pointer">
                            <i data-lucide="log-in" class="h-4 w-4"></i>
                            Admin Portal
                        </a>
                    </span>
                </div>

                <!-- Mobile Hamburger Toggle -->
                <div class="flex lg:hidden items-center gap-2">
                    <button id="mobileMenuBtn" class="p-2 rounded-xl text-gray-600 hover:bg-gray-100 focus:outline-none cursor-pointer transition-colors" aria-label="Toggle Navigation">
                        <i data-lucide="menu" class="h-6 w-6"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileMenuDrawer" class="drawer-closed lg:hidden border-t border-gray-100 bg-white px-4 space-y-2 shadow-lg">
            <a href="<?= base_url('/') ?>" class="block <?= nav_active_class('home') ?>">Home</a>
            <a href="<?= base_url('about') ?>" class="block <?= nav_active_class('about') ?>">About Us</a>
            <a href="<?= base_url('/?flat_type=resale') ?>" class="block <?= nav_active_class('/', 'flat_type', 'resale') ?>">Resale Flats</a>
            <a href="<?= base_url('/?flat_type=new') ?>" class="block <?= nav_active_class('/', 'flat_type', 'new') ?>">New Flats</a>
            <a href="<?= base_url('/?category=na_plot') ?>" class="block <?= nav_active_class('/', 'category', 'na_plot') ?>">NA Plots</a>
            <a href="<?= base_url('/?property_type=commercial') ?>" class="block <?= nav_active_class('/', 'property_type', 'commercial') ?>">Commercial</a>
            <a href="<?= base_url('clients') ?>" class="block <?= nav_active_class('clients') ?>">Clients</a>
            <a href="<?= base_url('partners') ?>" class="block <?= nav_active_class('partners') ?>">Partners</a>
            <a href="<?= base_url('contact') ?>" class="block <?= nav_active_class('contact') ?>">Contact Us</a>
            <div class="pt-2 border-t border-gray-100 pb-4">
                <a href="<?= base_url('login') ?>" id="mobileNavLoginBtn" class="flex items-center justify-center gap-2 bg-indigo-600 text-white py-2.5 rounded-xl text-xs font-bold shadow-sm">
                    <i data-lucide="log-in" class="h-4 w-4"></i> Admin Portal
                </a>
            </div>
        </div>
    </nav>

    <script>
        // Global Loader Utilities
        window.TopLoader = {
            element: null,
            init: function() {
                this.element = document.getElementById('globalTopLoader');
            },
            start: function() {
                if (!this.element) this.init();
                if (!this.element) return;
                this.element.style.opacity = '1';
                this.element.style.width = '30%';
                setTimeout(() => {
                    if (this.element.style.width === '30%') {
                        this.element.style.width = '70%';
                    }
                }, 200);
            },
            complete: function() {
                if (!this.element) this.init();
                if (!this.element) return;
                this.element.style.width = '100%';
                setTimeout(() => {
                    this.element.style.opacity = '0';
                    setTimeout(() => {
                        this.element.style.width = '0%';
                    }, 400);
                }, 250);
            }
        };

        // Trigger loader on page unload / link navigation
        window.addEventListener('beforeunload', function() {
            window.TopLoader.start();
        });

        document.addEventListener('DOMContentLoaded', function() {
            window.TopLoader.complete();

            // Mobile Menu Drawer Toggle with smooth height animation
            const mobileBtn = document.getElementById('mobileMenuBtn');
            const mobileDrawer = document.getElementById('mobileMenuDrawer');
            if (mobileBtn && mobileDrawer) {
                // Remove hidden class so drawer transitions properly
                mobileDrawer.classList.remove('hidden');
                mobileBtn.addEventListener('click', function() {
                    if (mobileDrawer.classList.contains('drawer-closed')) {
                        mobileDrawer.classList.remove('drawer-closed');
                        mobileDrawer.classList.add('drawer-open');
                    } else {
                        mobileDrawer.classList.remove('drawer-open');
                        mobileDrawer.classList.add('drawer-closed');
                    }
                });
            }

            // Auth State Navigation Handler
            const token = localStorage.getItem('token');
            const authContainer = document.getElementById('navAuthContainer');
            const mobileLoginBtn = document.getElementById('mobileNavLoginBtn');
            const adminHref = '<?= base_url('admin') ?>';

            if (token && authContainer) {
                authContainer.innerHTML = `
                    <div class="flex items-center gap-2">
                    <a href="${adminHref}" class="flex items-center gap-1.5 bg-indigo-600 text-white px-3.5 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 transition-all shadow-sm">
                        <i data-lucide="layout-dashboard" class="h-4 w-4"></i> Dashboard
                    </a>
                    <button onclick="handleNavLogout()" class="text-xs font-bold text-red-600 hover:bg-red-50 p-2 rounded-xl transition-colors cursor-pointer" title="Sign Out">
                        <i data-lucide="log-out" class="h-4 w-4"></i>
                    </button>
                    </div>
                `;
            }

            if (token && mobileLoginBtn) {
                mobileLoginBtn.href = adminHref;
                mobileLoginBtn.innerHTML = `<i data-lucide="layout-dashboard" class="h-4 w-4"></i> Admin Dashboard`;
            }

            if (typeof lucide !== 'undefined') lucide.createIcons();
            
            // Initialize Scroll Reveal Observer
            initScrollReveal();
        });

        // Global Scroll Reveal Engine (Excludes Hero Sections)
        function initScrollReveal() {
            const targets = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale, main > section:not(:first-of-type) > div, .grid > div');
            if (!targets.length) return;

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                root: null,
                rootMargin: '0px 0px -30px 0px',
                threshold: 0.1
            });

            targets.forEach((el) => {
                // Skip hero section and top banner elements so hero remains untouched and visible immediately
                if (el.closest('section:first-of-type') || el.closest('.hero-section') || el.closest('[class*="bg-indigo-950"]') || el.closest('[class*="bg-indigo-900"]')) {
                    return;
                }

                if (!el.classList.contains('scroll-reveal') &&
                    !el.classList.contains('scroll-reveal-left') &&
                    !el.classList.contains('scroll-reveal-right') &&
                    !el.classList.contains('scroll-reveal-scale')) {
                    el.classList.add('scroll-reveal');
                }

                // Add stagger effect for grid items
                if (el.parentElement && el.parentElement.classList.contains('grid')) {
                    const idx = Array.from(el.parentElement.children).indexOf(el);
                    if (idx > 0 && idx < 6) {
                        el.style.transitionDelay = (idx * 0.07) + 's';
                    }
                }
                observer.observe(el);
            });
        }

        function handleNavLogout() {
            if (confirm('Sign out of Admin Portal?')) {
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                window.location.reload();
            }
        }
    </script>

    <main class="flex-grow animate-fade-in">
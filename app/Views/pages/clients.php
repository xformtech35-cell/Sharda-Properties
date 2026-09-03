<?php
require_once APPPATH . 'Views/config.php';

$page_title = 'Our Clients & Testimonials - Sharda Properties';
$page_description = 'Discover our valued clients, successful real estate transactions, and testimonials from property buyers, sellers, and investors.';

$db_testimonials = fetch_api_data('testimonials') ?? [];

require_once APPPATH . 'Views/layouts/header.php';
?>

<div class="bg-gray-50 min-h-screen pb-16">
    <!-- Header Banner -->
    <div class="bg-indigo-900 text-white py-16 px-4 text-center relative overflow-hidden hero-section">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>
        <div class="relative z-10 max-w-4xl mx-auto space-y-3">
            <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase border border-white/10 animate-fade-in-up">Trusted Reviews</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight animate-fade-in-up delay-100">Our Clients & Testimonials</h1>
            <p class="text-base sm:text-lg text-indigo-100 max-w-2xl mx-auto font-light animate-fade-in-up delay-200">
                Building lifelong relationships based on trust, authenticity, and successful real estate investments.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 space-y-12">

        <!-- Stats Overview -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm card-hover-smooth">
                <span class="block text-2xl sm:text-3xl font-extrabold text-indigo-600">500+</span>
                <span class="text-gray-500 text-xs sm:text-sm font-medium mt-1 block">Happy Families</span>
            </div>
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm card-hover-smooth">
                <span class="block text-2xl sm:text-3xl font-extrabold text-indigo-600">120+</span>
                <span class="text-gray-500 text-xs sm:text-sm font-medium mt-1 block">NA Plots Sold</span>
            </div>
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm card-hover-smooth">
                <span class="block text-2xl sm:text-3xl font-extrabold text-indigo-600">85+</span>
                <span class="text-gray-500 text-xs sm:text-sm font-medium mt-1 block">Commercial Spaces</span>
            </div>
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm card-hover-smooth">
                <span class="block text-2xl sm:text-3xl font-extrabold text-indigo-600">99%</span>
                <span class="text-gray-500 text-xs sm:text-sm font-medium mt-1 block">Client Satisfaction</span>
            </div>
        </div>

        <!-- Testimonials Grid Header & Controls -->
        <div id="testimonialsContainer" class="space-y-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">What Our Clients Say</h2>
                    <p class="text-gray-500 text-sm mt-0.5">Real feedback from verified buyers, sellers, and investors</p>
                </div>
                <div class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-full border border-indigo-100">
                    <span id="totalTestimonialsCount"><?= count($db_testimonials) ?></span> Reviews Featured
                </div>
            </div>

            <!-- Grid Container -->
            <div id="testimonialsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Dynamic Testimonial Cards rendered via JS -->
            </div>

            <!-- Pagination Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-200 pt-6" id="paginationWrapper">
                <div class="text-xs font-semibold text-gray-500" id="paginationInfo">
                    Showing 0 to 0 of 0 testimonials
                </div>
                <div class="flex items-center gap-2" id="paginationButtons">
                    <!-- Pagination buttons rendered via JS -->
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const testimonialsData = <?= json_encode($db_testimonials) ?>;
    const itemsPerPage = 6;
    let currentPage = 1;

    function getInitials(name) {
        if (!name) return 'C';
        const parts = name.trim().split(' ');
        if (parts.length >= 2) {
            return (parts[0][0] + parts[1][0]).toUpperCase();
        }
        return name.substr(0, 2).toUpperCase();
    }

    function renderStars(rating) {
        const count = Math.min(5, Math.max(1, parseInt(rating) || 5));
        let starsHtml = '';
        for (let i = 0; i < count; i++) {
            starsHtml += `<i data-lucide="star" class="h-4 w-4 fill-amber-400 text-amber-400"></i>`;
        }
        return starsHtml;
    }

    function renderTestimonials(page) {
        currentPage = page;
        const totalItems = testimonialsData.length;
        const grid = document.getElementById('testimonialsGrid');
        grid.innerHTML = '';

        if (totalItems === 0) {
            grid.innerHTML = `
                <div class="col-span-full py-16 text-center text-gray-500 bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                    <i data-lucide="star" class="h-12 w-12 text-gray-300 mx-auto mb-3"></i>
                    <p class="text-base font-bold text-gray-700">No client reviews added yet.</p>
                    <p class="text-xs text-gray-400 mt-1">Add client testimonials from the admin dashboard to feature them here.</p>
                </div>
            `;
            document.getElementById('paginationInfo').innerText = 'Showing 0 of 0 testimonials';
            document.getElementById('paginationButtons').innerHTML = '';
            if (typeof lucide !== 'undefined') lucide.createIcons();
            return;
        }

        const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
        const currentItems = testimonialsData.slice(startIndex, endIndex);

        if (window.TopLoader) window.TopLoader.start();

        currentItems.forEach((item, index) => {
            const initials = getInitials(item.name);
            const card = document.createElement('div');
            card.className = 'bg-white p-6 sm:p-8 rounded-2xl border border-gray-100 shadow-sm card-hover-smooth animate-fade-in-up flex flex-col justify-between space-y-6';
            card.style.animationDelay = (index * 0.08) + 's';
            
            card.innerHTML = `
                <div class="space-y-4">
                    <div class="flex text-amber-400 gap-1">
                        ${renderStars(item.rating)}
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "${escapeHtml(item.content)}"
                    </p>
                </div>
                <div class="border-t border-gray-100 pt-4 flex items-center gap-3">
                    <div class="bg-indigo-100 text-indigo-700 font-extrabold h-11 w-11 rounded-full flex items-center justify-center text-xs shrink-0 shadow-xs">
                        ${initials}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">${escapeHtml(item.name)}</h4>
                        <span class="text-xs text-gray-500">${escapeHtml(item.role || 'Valued Client')}</span>
                    </div>
                </div>
            `;
            grid.appendChild(card);
        });

        // Update Pagination Info
        const pageInfo = document.getElementById('paginationInfo');
        if (pageInfo) {
            pageInfo.innerText = `Showing ${startIndex + 1} to ${endIndex} of ${totalItems} testimonials`;
        }

        // Render Pagination Buttons
        const buttonsContainer = document.getElementById('paginationButtons');
        buttonsContainer.innerHTML = '';

        if (totalPages > 1) {
            // Previous Button
            const prevBtn = document.createElement('button');
            prevBtn.className = `px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1 cursor-pointer ${currentPage === 1 ? 'opacity-40 pointer-events-none text-gray-400 bg-gray-100' : 'bg-white border border-gray-200 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 shadow-xs'}`;
            prevBtn.innerHTML = `<i data-lucide="chevron-left" class="h-4 w-4"></i> Prev`;
            prevBtn.onclick = () => {
                renderTestimonials(currentPage - 1);
                scrollToGridTop();
            };
            buttonsContainer.appendChild(prevBtn);

            // Numbered Buttons
            for (let i = 1; i <= totalPages; i++) {
                const numBtn = document.createElement('button');
                numBtn.className = `w-9 h-9 rounded-xl text-xs font-bold transition-all cursor-pointer ${i === currentPage ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600'}`;
                numBtn.innerText = i;
                numBtn.onclick = () => {
                    renderTestimonials(i);
                    scrollToGridTop();
                };
                buttonsContainer.appendChild(numBtn);
            }

            // Next Button
            const nextBtn = document.createElement('button');
            nextBtn.className = `px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1 cursor-pointer ${currentPage === totalPages ? 'opacity-40 pointer-events-none text-gray-400 bg-gray-100' : 'bg-white border border-gray-200 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 shadow-xs'}`;
            nextBtn.innerHTML = `Next <i data-lucide="chevron-right" class="h-4 w-4"></i>`;
            nextBtn.onclick = () => {
                renderTestimonials(currentPage + 1);
                scrollToGridTop();
            };
            buttonsContainer.appendChild(nextBtn);
        }

        if (typeof lucide !== 'undefined') lucide.createIcons();
        if (typeof initScrollReveal === 'function') initScrollReveal();
        if (window.TopLoader) window.TopLoader.complete();
    }

    function scrollToGridTop() {
        const container = document.getElementById('testimonialsContainer');
        if (container) {
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderTestimonials(1);
    });
</script>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

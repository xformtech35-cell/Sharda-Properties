<?php
require_once APPPATH . 'Views/config.php';

$db_testimonials = fetch_api_data('testimonials');
$testimonials = $db_testimonials ?? [];

$page_title = 'About Us - Sharda Properties | Leading Real Estate Consultancy';
$page_description = 'Learn about Sharda Properties, our vision, mission, and core values in providing trusted real estate consulting, NA plots, flats, and commercial offices.';

require_once APPPATH . 'Views/layouts/header.php';
?>

<div class="bg-gray-50 min-h-screen pb-16">
    <!-- Page Header with refined overlay and gradient -->
    <div class="relative bg-gradient-to-br from-indigo-950 via-indigo-900 to-indigo-800 text-white py-20 px-4 text-center overflow-hidden hero-section">
        <!-- Abstract background glowing shapes -->
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl -translate-y-1/2 translate-x-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl translate-y-1/2 -translate-x-1/2 animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>
        <div class="relative z-10 max-w-4xl mx-auto space-y-4">
            <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase border border-white/10 animate-fade-in-up">Trusted Since 2010</span>
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight leading-tight animate-fade-in-up delay-100">About Sharda Properties</h1>
            <div class="w-24 h-1.5 bg-indigo-400 mx-auto mt-4 rounded-full animate-fade-in-up delay-150"></div>
            <p class="mt-4 text-lg md:text-xl text-indigo-100/90 max-w-2xl mx-auto font-light leading-relaxed animate-fade-in-up delay-200">
                Your premium real estate partner helping you find properties that suit your lifestyle and business requirements.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 space-y-20">

        <!-- Intro Grid with improved visual hierarchy -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="space-y-6 order-2 md:order-1 scroll-reveal-left">
                <span class="inline-block text-indigo-600 font-semibold text-sm tracking-widest uppercase bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">Who We Are</span>
                <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">Building Dreams,<br>Delivering Trust</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Sharda Properties is a leading real estate consultancy and listing service provider. We offer comprehensive real estate solutions, specializing in NA (Non-Agricultural) plots, residential flats, luxury villas, and modern commercial offices.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    With years of experience in the industry, our primary goal is to guide you step-by-step through the process of buying, selling, or leasing properties with full legal validation, transparency, and integrity.
                </p>
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-indigo-600 animate-pulse"></span>
                        <span class="text-sm font-semibold text-gray-700">1000+ Happy Clients</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-indigo-600 animate-pulse"></span>
                        <span class="text-sm font-semibold text-gray-700">500+ Properties Sold</span>
                    </div>
                </div>
            </div>
            <div class="order-1 md:order-2 relative group scroll-reveal-right">
                <div class="rounded-3xl overflow-hidden shadow-2xl ring-1 ring-gray-200/50 h-96 bg-gray-200 relative">
                    <img
                        src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80"
                        alt="Real estate office"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                </div>
                <!-- floating badge -->
                <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-xl px-5 py-3 border border-gray-100 hidden sm:flex items-center gap-3 card-hover-smooth animate-fade-in-up delay-300">
                    <div class="bg-indigo-100 p-2.5 rounded-xl text-indigo-600">
                        <i data-lucide="medal" class="h-6 w-6"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Award Winning</p>
                        <p class="text-sm font-bold text-gray-800">Real Estate Consultancy</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission with enhanced cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="group bg-white p-10 rounded-3xl border border-gray-100 shadow-sm card-hover-smooth scroll-reveal delay-100 space-y-5 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-50 rounded-full opacity-50"></div>
                <div class="bg-indigo-50 p-3.5 rounded-2xl inline-block text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110 transition-all duration-300 shadow-xs">
                    <i data-lucide="eye" class="h-7 w-7"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed text-base">
                    To be the most trusted and reliable name in real estate services, recognized globally for establishing benchmarks in customer satisfaction, legal authenticity, and transparent transactions.
                </p>
            </div>
            <div class="group bg-white p-10 rounded-3xl border border-gray-100 shadow-sm card-hover-smooth scroll-reveal delay-200 space-y-5 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-50 rounded-full opacity-50"></div>
                <div class="bg-indigo-50 p-3.5 rounded-2xl inline-block text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110 transition-all duration-300 shadow-xs">
                    <i data-lucide="compass" class="h-7 w-7"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed text-base">
                    To deliver premium quality real estate guidance and curate the best deals for our clients. We strive to make property acquisition simple, safe, and efficient using verified records and expert consulting.
                </p>
            </div>
        </div>

        <!-- Core Values with refined styling -->
        <div class="bg-white p-10 md:p-14 rounded-3xl border border-gray-100 shadow-sm">
            <div class="text-center max-w-2xl mx-auto mb-12 scroll-reveal">
                <span class="inline-block text-indigo-600 font-semibold text-sm tracking-widest uppercase bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100">What Drives Us</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4">Our Core Values</h2>
                <div class="w-16 h-1 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
                <div class="group text-center space-y-4 p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 scroll-reveal delay-100 card-hover-smooth">
                    <div class="bg-indigo-50 p-4 rounded-2xl inline-block text-indigo-600 mx-auto ring-8 ring-indigo-50/50 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i data-lucide="award" class="h-8 w-8"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-xl group-hover:text-indigo-600 transition-colors">Trust & Integrity</h4>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">We maintain absolute honesty and compliance in all our agreements and listing verification processes.</p>
                </div>
                <div class="group text-center space-y-4 p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 scroll-reveal delay-200 card-hover-smooth">
                    <div class="bg-indigo-50 p-4 rounded-2xl inline-block text-indigo-600 mx-auto ring-8 ring-indigo-50/50 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i data-lucide="users" class="h-8 w-8"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-xl group-hover:text-indigo-600 transition-colors">Customer Centric</h4>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">Your goals are our priorities. We find the right properties that match your specifications and budget.</p>
                </div>
                <div class="group text-center space-y-4 p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 scroll-reveal delay-300 card-hover-smooth">
                    <div class="bg-indigo-50 p-4 rounded-2xl inline-block text-indigo-600 mx-auto ring-8 ring-indigo-50/50 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i data-lucide="eye" class="h-8 w-8"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-xl group-hover:text-indigo-600 transition-colors">Transparency</h4>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">No hidden charges or vague contract details. We keep every party fully informed at every stage.</p>
                </div>
            </div>
        </div>

        <!-- INTERACTIVE TESTIMONIALS SLIDER SECTION -->
        <section class="bg-indigo-950 text-white py-16 rounded-3xl relative overflow-hidden shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 relative z-10">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-indigo-300 uppercase tracking-widest bg-indigo-900/60 px-4 py-1.5 rounded-full border border-indigo-800">Client Reviews</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">What Our Clients Say</h2>
                    <p class="text-indigo-200 text-sm">Real reviews from satisfied property buyers, investors & tenants</p>
                </div>

                <!-- Testimonial Slider Container -->
                <div class="max-w-4xl mx-auto relative group">
                    <div id="aboutTestimonialSlider" class="overflow-hidden relative rounded-3xl bg-gradient-to-b from-indigo-900/80 to-indigo-900/40 border border-indigo-800/80 p-8 sm:p-12 shadow-2xl backdrop-blur-md min-h-[260px] flex items-center justify-center">
                        
                        <?php foreach ($testimonials as $index => $t): ?>
                            <div class="about-testimonial-slide transition-all duration-500 transform w-full <?= $index === 0 ? 'block opacity-100 scale-100' : 'hidden opacity-0 scale-95' ?>" data-index="<?= $index ?>">
                                <div class="flex justify-center text-amber-400 gap-1.5 mb-6">
                                    <?php for ($s = 0; $s < ($t['rating'] ?? 5); $s++): ?>
                                        <i data-lucide="star" class="h-5 w-5 fill-amber-400"></i>
                                    <?php endfor; ?>
                                </div>
                                <blockquote class="text-indigo-100 text-base sm:text-xl font-medium leading-relaxed italic text-center max-w-2xl mx-auto mb-8">
                                    "<?= htmlspecialchars($t['content']) ?>"
                                </blockquote>
                                <div class="flex items-center justify-center gap-3">
                                    <div class="bg-indigo-600 text-white font-extrabold h-11 w-11 rounded-full flex items-center justify-center text-sm shadow-md uppercase">
                                        <?= substr($t['name'], 0, 2) ?>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-extrabold text-white text-base leading-tight"><?= htmlspecialchars($t['name']) ?></h4>
                                        <span class="text-xs text-indigo-300 font-medium"><?= htmlspecialchars($t['role']) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <!-- Slider Navigation Controls -->
                    <button id="aboutSliderPrevBtn" class="absolute -left-4 sm:-left-6 top-1/2 -translate-y-1/2 bg-indigo-900/90 hover:bg-indigo-600 text-white p-3 rounded-full border border-indigo-700 shadow-xl transition-all cursor-pointer z-20">
                        <i data-lucide="chevron-left" class="h-5 w-5"></i>
                    </button>
                    <button id="aboutSliderNextBtn" class="absolute -right-4 sm:-right-6 top-1/2 -translate-y-1/2 bg-indigo-900/90 hover:bg-indigo-600 text-white p-3 rounded-full border border-indigo-700 shadow-xl transition-all cursor-pointer z-20">
                        <i data-lucide="chevron-right" class="h-5 w-5"></i>
                    </button>

                    <!-- Slider Pagination Dots -->
                    <div id="aboutSliderDots" class="flex justify-center gap-2 mt-6">
                        <?php foreach ($testimonials as $index => $t): ?>
                            <button class="about-slider-dot w-3 h-3 rounded-full transition-all cursor-pointer <?= $index === 0 ? 'bg-indigo-400 w-8' : 'bg-indigo-800' ?>" data-index="<?= $index ?>"></button>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </section>

        <!-- Leadership Team
        <div class="bg-white p-10 md:p-14 rounded-3xl border border-gray-100 shadow-sm">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="inline-block text-indigo-600 font-semibold text-sm tracking-widest uppercase bg-indigo-50 px-4 py-1.5 rounded-full">Leadership</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4">Meet Our Experts</h2>
                <div class="w-16 h-1 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
                <p class="text-gray-500 mt-4">The experienced minds behind Sharda Properties' success.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-28 h-28 rounded-full bg-indigo-100 mx-auto flex items-center justify-center text-4xl font-light text-indigo-600 shadow-md">SP</div>
                    <h4 class="font-bold text-gray-800 mt-4">Sharda Prasad</h4>
                    <p class="text-sm text-indigo-600 font-medium">Founder & CEO</p>
                    <p class="text-xs text-gray-400 mt-1">20+ years in real estate</p>
                </div>
                <div class="text-center">
                    <div class="w-28 h-28 rounded-full bg-indigo-100 mx-auto flex items-center justify-center text-4xl font-light text-indigo-600 shadow-md">AR</div>
                    <h4 class="font-bold text-gray-800 mt-4">Anita Reddy</h4>
                    <p class="text-sm text-indigo-600 font-medium">Head of Operations</p>
                    <p class="text-xs text-gray-400 mt-1">Excellence in client relations</p>
                </div>
                <div class="text-center">
                    <div class="w-28 h-28 rounded-full bg-indigo-100 mx-auto flex items-center justify-center text-4xl font-light text-indigo-600 shadow-md">VM</div>
                    <h4 class="font-bold text-gray-800 mt-4">Vikram Malhotra</h4>
                    <p class="text-sm text-indigo-600 font-medium">Legal & Compliance</p>
                    <p class="text-xs text-gray-400 mt-1">Property law specialist</p>
                </div>
            </div>
        </div> -->

    </div>
</div>

<script>
    // Testimonial Slider Logic for About Us
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.about-testimonial-slide');
        const dots = document.querySelectorAll('.about-slider-dot');
        const prevBtn = document.getElementById('aboutSliderPrevBtn');
        const nextBtn = document.getElementById('aboutSliderNextBtn');
        let currentIndex = 0;
        let autoSlideInterval = null;

        if (slides.length <= 1) {
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
            return;
        }

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('hidden', 'opacity-0', 'scale-95');
                    slide.classList.add('block', 'opacity-100', 'scale-100');
                } else {
                    slide.classList.remove('block', 'opacity-100', 'scale-100');
                    slide.classList.add('hidden', 'opacity-0', 'scale-95');
                }
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.className = 'about-slider-dot w-8 h-3 rounded-full bg-indigo-400 transition-all cursor-pointer';
                } else {
                    dot.className = 'about-slider-dot w-3 h-3 rounded-full bg-indigo-800 transition-all cursor-pointer';
                }
            });

            if (typeof lucide !== 'undefined' && lucide.createIcons) {
                lucide.createIcons();
            }

            currentIndex = index;
        }

        function nextSlide() {
            let nextIndex = (currentIndex + 1) % slides.length;
            showSlide(nextIndex);
        }

        function prevSlide() {
            let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(prevIndex);
        }

        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const idx = parseInt(this.getAttribute('data-index'));
                showSlide(idx);
            });
        });

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            if (autoSlideInterval) clearInterval(autoSlideInterval);
        }

        const sliderElem = document.getElementById('aboutTestimonialSlider');
        if (sliderElem) {
            sliderElem.addEventListener('mouseenter', stopAutoSlide);
            sliderElem.addEventListener('mouseleave', startAutoSlide);
        }

        startAutoSlide();
    });
</script>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>
<?php
require_once APPPATH . 'Views/config.php';

$page_title = 'Our Partners & Clients - Sharda Properties';
$page_description = 'Explore our network of trusted real estate developers, banking partners, corporate clients, and financial advisors.';

require_once APPPATH . 'Views/layouts/header.php';

$db_partners = fetch_api_data('partners');
$partners = $db_partners ?? [];
$partner_categories = fetch_api_data('categories', ['type' => 'partner']) ?? [];
?>

<div class="bg-gray-50/80 min-h-screen pb-20">
    
    <!-- 1. HERO BANNER – Animated Glassmorphism -->
    <section class="relative bg-gradient-to-br from-indigo-950 via-indigo-900 to-indigo-950 text-white py-20 px-4 text-center overflow-hidden hero-section">
        <!-- Glowing background accent orbs -->
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-delay: 2s;"></div>

        <div class="absolute inset-0 bg-grid-pattern opacity-15"></div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-4">
            <div class="inline-flex items-center gap-2 bg-indigo-800/60 backdrop-blur-md px-5 py-2 rounded-full border border-white/20 text-xs font-bold uppercase tracking-widest text-indigo-200 animate-fade-in-up">
                <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full inline-block animate-pulse"></span> Network & Collaborators
            </div>
            <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-tight animate-fade-in-up delay-100">
                Our Partners & <span class="gradient-text">Clients</span>
            </h1>
            <p class="text-base sm:text-xl text-indigo-100/90 max-w-2xl mx-auto font-light leading-relaxed animate-fade-in-up delay-200">
                Collaborating with top real estate developers, banking partners, and corporate clients for seamless property transactions.
            </p>
        </div>
    </section>

    <!-- 2. MAIN PARTNERS GRID & FILTER SECTION -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 space-y-12">

        <!-- Dynamic Category Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-3 scroll-reveal">
            <button onclick="filterCategory('all')" id="tab-all" class="partner-tab-btn active px-6 py-2.5 rounded-full text-xs font-bold transition-all bg-indigo-600 text-white shadow-md cursor-pointer">
                All Partners & Clients (<?= count($partners) ?>)
            </button>
            <?php foreach ($partner_categories as $pcat): ?>
                <button onclick="filterCategory('<?= htmlspecialchars($pcat['slug']) ?>')" id="tab-<?= htmlspecialchars($pcat['slug']) ?>" class="partner-tab-btn px-6 py-2.5 rounded-full text-xs font-bold transition-all bg-white text-gray-700 hover:bg-indigo-50 border border-gray-200 cursor-pointer">
                    <?= htmlspecialchars($pcat['name']) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Partners Cards Grid -->
        <div id="partnersGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($partners as $index => $p): 
                $cat = htmlspecialchars($p['category'] ?? 'Partner');
                $rawLogo = trim($p['logo_url'] ?? '');
                $logo = !empty($rawLogo) ? (str_starts_with($rawLogo, 'http') ? $rawLogo : base_url(ltrim($rawLogo, '/'))) : null;
                $initials = strtoupper(substr($p['name'], 0, 2));
            ?>
                <div class="partner-card group bg-white rounded-3xl p-7 border border-gray-100 shadow-soft card-hover-smooth scroll-reveal delay-<?= (($index % 6) + 1) * 100 ?> flex flex-col justify-between" data-category="<?= $cat ?>">
                    
                    <div class="space-y-5">
                        <!-- Top Header: Logo / Avatar & Category Badge -->
                        <div class="flex items-center justify-between gap-4">
                            <div class="h-16 w-16 rounded-2xl bg-indigo-50/80 border border-indigo-100 flex items-center justify-center p-2 group-hover:scale-105 transition-transform duration-300 overflow-hidden shrink-0 shadow-xs">
                                <?php if ($logo): ?>
                                    <img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="w-full h-full object-contain rounded-xl" onerror="this.classList.add('hidden'); if(this.nextElementSibling) this.nextElementSibling.classList.remove('hidden');" />
                                    <span class="hidden font-black text-indigo-600 text-xl"><?= $initials ?></span>
                                <?php else: ?>
                                    <span class="font-black text-indigo-600 text-xl"><?= $initials ?></span>
                                <?php endif; ?>
                            </div>

                            <span class="px-3.5 py-1.5 rounded-full text-[11px] font-extrabold uppercase tracking-wider text-indigo-700 bg-indigo-50 border border-indigo-100/80">
                                <?= $cat ?>
                            </span>
                        </div>

                        <!-- Details -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                <?= htmlspecialchars($p['name']) ?>
                            </h3>
                            <p class="text-gray-500 text-xs mt-2 leading-relaxed line-clamp-3">
                                <?= !empty($p['description']) ? htmlspecialchars($p['description']) : 'Trusted real estate partner collaborating with Sharda Properties for verified deals.' ?>
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Action Link -->
                    <div class="pt-6 mt-6 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-gray-400">Verified Partner</span>
                        <?php if (!empty($p['website_url']) && $p['website_url'] !== '#'): ?>
                            <a href="<?= htmlspecialchars($p['website_url']) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                Visit Website <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
                            </a>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600">
                                Official Partner <i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
                            </span>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<script>
    function filterCategory(category) {
        const cards = document.querySelectorAll('.partner-card');
        const buttons = document.querySelectorAll('.partner-tab-btn');

        buttons.forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md');
            btn.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
        });

        const activeBtn = document.getElementById('tab-' + category);
        if (activeBtn) {
            activeBtn.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-200');
            activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-md');
        }

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                card.classList.remove('opacity-0', 'scale-95');
                card.classList.add('opacity-100', 'scale-100');
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

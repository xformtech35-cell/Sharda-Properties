    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-auto border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Column 1: Brand Info -->
                <div class="space-y-4 md:col-span-1">
                    <div class="flex items-center gap-2 text-xl font-extrabold text-white">
                        <div class="bg-indigo-600 text-white p-2 rounded-xl">
                            <i data-lucide="home" class="h-5 w-5"></i>
                        </div>
                        <span>Sharda <span class="text-indigo-400">Properties</span></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Your trusted real estate consultancy specializing in NA plots, modern flats, villas, and commercial spaces with complete legal verification.
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="<?= base_url('/') ?>" class="hover:text-indigo-400 transition-colors">Home</a></li>
                        <li><a href="<?= base_url('about') ?>" class="hover:text-indigo-400 transition-colors">About Us</a></li>
                        <li><a href="<?= base_url('properties') ?>" class="hover:text-indigo-400 transition-colors">All Properties</a></li>
                        <li><a href="<?= base_url('clients') ?>" class="hover:text-indigo-400 transition-colors">Clients & Reviews</a></li>
                        <li><a href="<?= base_url('partners') ?>" class="hover:text-indigo-400 transition-colors">Partners & Developers</a></li>
                    </ul>
                </div>

                <!-- Column 3: Property Categories -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Categories</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="<?= base_url('/?category=na_plot') ?>" class="hover:text-indigo-400 transition-colors">NA Plots</a></li>
                        <li><a href="<?= base_url('/?flat_type=resale') ?>" class="hover:text-indigo-400 transition-colors">Resale Flats</a></li>
                        <li><a href="<?= base_url('/?flat_type=new') ?>" class="hover:text-indigo-400 transition-colors">New Project Flats</a></li>
                        <li><a href="<?= base_url('/?property_type=commercial') ?>" class="hover:text-indigo-400 transition-colors">Commercial Offices</a></li>
                        <li><a href="<?= base_url('/?purpose=rent') ?>" class="hover:text-indigo-400 transition-colors">Properties for Rent</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact & Location -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Get In Touch</h4>
                    <ul class="space-y-2.5 text-sm text-gray-400">
                        <li class="flex items-start gap-2.5">
                            <i data-lucide="map-pin" class="h-4 w-4 text-indigo-400 mt-0.5 shrink-0"></i>
                            <span>123 Real Estate Avenue, City Center, State, India</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="phone" class="h-4 w-4 text-indigo-400 shrink-0"></i>
                            <span>+91 98765 43210</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="mail" class="h-4 w-4 text-indigo-400 shrink-0"></i>
                            <span>info@shardaproperties.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright & Developer Info -->
            <div class="border-t border-gray-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-400">
                <div>&copy; <?= date('Y') ?> Sharda Properties. All rights reserved.</div>
                <div class="text-xs text-gray-500">
                    Developed by <a href="https://xform.in" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-indigo-400 font-semibold transition-colors">Xform Technologies</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>
</html>

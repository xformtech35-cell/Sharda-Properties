<?php require_once APPPATH . 'Views/config.php'; ?>
<?= $this->include('layouts/header') ?>

<div class="bg-gray-50 min-h-screen pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header / Navigation Bar inside Dashboard -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Admin Dashboard</h1>
                <p class="text-gray-500 text-sm mt-1">Manage property listings, property enquiries, contact messages, and client testimonials.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    id="addPropertyBtn"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition-colors cursor-pointer shadow-sm"
                >
                    <i data-lucide="plus" class="h-4 w-4"></i> Add Property
                </button>
                <button
                    id="addTestimonialBtn"
                    class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition-colors cursor-pointer shadow-sm"
                >
                    <i data-lucide="star" class="h-4 w-4"></i> Add Testimonial
                </button>
            </div>
        </div>

        <!-- Dashboard Tabs -->
        <div class="border-b border-gray-200 mb-8 overflow-x-auto">
            <nav class="flex gap-8 whitespace-nowrap">
                <button
                    id="tabPropertiesBtn"
                    class="pb-4 px-1 text-sm font-bold border-b-2 border-indigo-600 text-indigo-600 flex items-center gap-2 cursor-pointer"
                >
                    <i data-lucide="home" class="h-4 w-4"></i> Properties (<span id="propertiesCount">0</span>)
                </button>
                <button
                    id="tabPropEnquiriesBtn"
                    class="pb-4 px-1 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-gray-700 flex items-center gap-2 cursor-pointer"
                >
                    <i data-lucide="building-2" class="h-4 w-4"></i> Property Enquiries (<span id="propEnquiriesCount">0</span>)
                </button>
                <button
                    id="tabContactEnquiriesBtn"
                    class="pb-4 px-1 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-gray-700 flex items-center gap-2 cursor-pointer"
                >
                    <i data-lucide="mail" class="h-4 w-4"></i> Contact Enquiries (<span id="contactEnquiriesCount">0</span>)
                </button>
                <button
                    id="tabTestimonialsBtn"
                    class="pb-4 px-1 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-gray-700 flex items-center gap-2 cursor-pointer"
                >
                    <i data-lucide="star" class="h-4 w-4"></i> Testimonials (<span id="testimonialsCount">0</span>)
                </button>
            </nav>
        </div>

        <!-- Properties Tab Panel -->
        <div id="panelProperties">
            <div id="propertiesLoading" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 skeleton shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/3"></div>
                        <div class="h-3 skeleton w-1/4"></div>
                    </div>
                    <div class="h-8 skeleton w-20"></div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 skeleton shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-2/5"></div>
                        <div class="h-3 skeleton w-1/3"></div>
                    </div>
                    <div class="h-8 skeleton w-20"></div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 skeleton shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/2"></div>
                        <div class="h-3 skeleton w-1/4"></div>
                    </div>
                    <div class="h-8 skeleton w-20"></div>
                </div>
            </div>

            <div id="propertiesTableContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs border-b border-gray-100">
                            <tr>
                                <th class="py-3.5 px-6">Image</th>
                                <th class="py-3.5 px-6">Title</th>
                                <th class="py-3.5 px-6">Location</th>
                                <th class="py-3.5 px-6">Price</th>
                                <th class="py-3.5 px-6">Category</th>
                                <th class="py-3.5 px-6">Purpose</th>
                                <th class="py-3.5 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="propertiesTableBody" class="divide-y divide-gray-100">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Property Enquiries Tab Panel -->
        <div id="panelPropEnquiries" class="hidden">
            <div id="propEnquiriesLoading" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 skeleton rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/4"></div>
                        <div class="h-3 skeleton w-1/2"></div>
                    </div>
                    <div class="h-8 skeleton w-16"></div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 skeleton rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/3"></div>
                        <div class="h-3 skeleton w-2/5"></div>
                    </div>
                    <div class="h-8 skeleton w-16"></div>
                </div>
            </div>

            <div id="propEnquiriesTableContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs border-b border-gray-100">
                            <tr>
                                <th class="py-3.5 px-6">Date</th>
                                <th class="py-3.5 px-6">Name</th>
                                <th class="py-3.5 px-6">Contact Info</th>
                                <th class="py-3.5 px-6">Property Title</th>
                                <th class="py-3.5 px-6">Inquiry Message</th>
                                <th class="py-3.5 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="propEnquiriesTableBody" class="divide-y divide-gray-100">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Contact Enquiries Tab Panel -->
        <div id="panelContactEnquiries" class="hidden">
            <div id="contactEnquiriesLoading" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 skeleton rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/4"></div>
                        <div class="h-3 skeleton w-2/3"></div>
                    </div>
                    <div class="h-8 skeleton w-16"></div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 skeleton rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/3"></div>
                        <div class="h-3 skeleton w-1/2"></div>
                    </div>
                    <div class="h-8 skeleton w-16"></div>
                </div>
            </div>

            <div id="contactEnquiriesTableContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs border-b border-gray-100">
                            <tr>
                                <th class="py-3.5 px-6">Date</th>
                                <th class="py-3.5 px-6">Name</th>
                                <th class="py-3.5 px-6">Contact Info</th>
                                <th class="py-3.5 px-6">Message</th>
                                <th class="py-3.5 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="contactEnquiriesTableBody" class="divide-y divide-gray-100">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Testimonials Tab Panel -->
        <div id="panelTestimonials" class="hidden">
            <div id="testimonialsLoading" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 skeleton rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/4"></div>
                        <div class="h-3 skeleton w-3/4"></div>
                    </div>
                    <div class="h-8 skeleton w-16"></div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 skeleton rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/3"></div>
                        <div class="h-3 skeleton w-1/2"></div>
                    </div>
                    <div class="h-8 skeleton w-16"></div>
                </div>
            </div>

            <div id="testimonialsTableContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs border-b border-gray-100">
                            <tr>
                                <th class="py-3.5 px-6">Date</th>
                                <th class="py-3.5 px-6">Name</th>
                                <th class="py-3.5 px-6">Role / Location</th>
                                <th class="py-3.5 px-6">Rating</th>
                                <th class="py-3.5 px-6">Review Content</th>
                                <th class="py-3.5 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="testimonialsTableBody" class="divide-y divide-gray-100">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Property Add/Edit Modal -->
<div id="propertyModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold text-gray-900">Add Property</h3>
            <button id="modalCloseBtn" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>

        <form id="propertyForm" class="p-6 space-y-6">
            <input type="hidden" id="editPropertyId" name="id" value="">
            <div id="formErrorAlert" class="hidden bg-red-50 border-l-4 border-red-400 p-4 text-sm text-red-700 rounded-r-lg"></div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Property Title *</label>
                    <input type="text" id="propTitle" name="title" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Modern 3BHK Villa in City Center">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Price ($) *</label>
                        <input type="number" id="propPrice" name="price" required step="0.01" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="250000">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Location *</label>
                        <input type="text" id="propLocation" name="location" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Downtown City">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Category *</label>
                        <select id="propCategory" name="category" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <option value="flat">Flat</option>
                            <option value="na_plot">NA Plot</option>
                            <option value="office">Office</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Purpose *</label>
                        <select id="propPurpose" name="purpose" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <option value="sell">For Sell</option>
                            <option value="rent">For Rent</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Type *</label>
                        <select id="propPropertyType" name="property_type" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Bedrooms *</label>
                        <input type="number" id="propBedrooms" name="bedrooms" required min="0" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" value="1">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Bathrooms *</label>
                        <input type="number" id="propBathrooms" name="bathrooms" required min="0" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" value="1">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Area (sqft) *</label>
                        <input type="number" id="propArea" name="area" required min="1" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" value="1000">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Google Map Embed Link / Location (Optional)</label>
                    <input type="text" id="propGoogleMap" name="google_map" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. https://maps.google.com/maps?q=Mumbai&output=embed or location name">
                    <p class="text-xs text-gray-400 mt-1">Paste Google Map embed URL, share link, or location name. Leave empty to hide map on property details page.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Property Image</label>
                    <input type="file" id="propImage" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400 mt-1">Leave empty when editing to keep the existing image.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Description</label>
                    <textarea id="propDescription" name="description" rows="4" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 resize-none" placeholder="Detailed property description..."></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" id="modalCancelBtn" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-lg cursor-pointer">Cancel</button>
                <button type="submit" id="modalSubmitBtn" class="inline-flex items-center gap-2 px-6 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 rounded-lg cursor-pointer transition-all">
                    <span id="modalSubmitSpinner" class="hidden"><svg class="animate-spin-custom h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>
                    <span id="modalSubmitText">Save Property</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Testimonial Add Modal -->
<div id="testimonialModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-100 animate-scale-in">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Add Client Testimonial</h3>
            <button id="testimonialModalCloseBtn" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>

        <form id="testimonialForm" class="p-6 space-y-4">
            <div id="testimonialFormErrorAlert" class="hidden bg-red-50 border-l-4 border-red-400 p-4 text-sm text-red-700 rounded-r-lg animate-fade-in"></div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Client Name *</label>
                <input type="text" name="name" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Rajesh Kulkarni">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Role / Designation *</label>
                <input type="text" name="role" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Homeowner, City Center">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Star Rating (1 to 5) *</label>
                <select name="rating" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    <option value="5" selected>5 Stars (Excellent)</option>
                    <option value="4">4 Stars (Good)</option>
                    <option value="3">3 Stars (Average)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Review Content *</label>
                <textarea name="content" rows="4" required class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 resize-none" placeholder="Write client's feedback or quote..."></textarea>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" id="testimonialModalCancelBtn" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-lg cursor-pointer">Cancel</button>
                <button type="submit" id="testimonialModalSubmitBtn" class="inline-flex items-center gap-2 px-6 py-2 text-sm font-semibold text-white bg-amber-600 hover:bg-amber-700 disabled:opacity-60 rounded-lg cursor-pointer transition-all">
                    <span id="testimonialModalSubmitSpinner" class="hidden"><svg class="animate-spin-custom h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>
                    <span id="testimonialModalSubmitText">Save Testimonial</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const loginUrl = '<?= base_url('login') ?>';
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = loginUrl;
    }

    let globalProperties = [];
    let globalPropEnquiries = [];
    let globalContactEnquiries = [];
    let globalTestimonials = [];

    async function apiFetch(url, options = {}) {
        options.headers = options.headers || {};
        options.headers['Authorization'] = 'Bearer ' + token;
        const res = await fetch(url, options);
        if (res.status === 401) {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            window.location.href = loginUrl;
            return;
        }
        return res;
    }

    // Tabs Control
    const tabPropsBtn = document.getElementById('tabPropertiesBtn');
    const tabPropEnqBtn = document.getElementById('tabPropEnquiriesBtn');
    const tabContactEnqBtn = document.getElementById('tabContactEnquiriesBtn');
    const tabTestimonialsBtn = document.getElementById('tabTestimonialsBtn');

    const panelProps = document.getElementById('panelProperties');
    const panelPropEnq = document.getElementById('panelPropEnquiries');
    const panelContactEnq = document.getElementById('panelContactEnquiries');
    const panelTestimonials = document.getElementById('panelTestimonials');

    function setActiveTab(activeBtn, activePanel) {
        [tabPropsBtn, tabPropEnqBtn, tabContactEnqBtn, tabTestimonialsBtn].forEach(btn => {
            btn.className = 'pb-4 px-1 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-gray-700 flex items-center gap-2 cursor-pointer transition-colors';
        });
        [panelProps, panelPropEnq, panelContactEnq, panelTestimonials].forEach(panel => {
            panel.classList.add('hidden');
            panel.classList.remove('animate-fade-in');
        });

        activeBtn.className = 'pb-4 px-1 text-sm font-bold border-b-2 border-indigo-600 text-indigo-600 flex items-center gap-2 cursor-pointer transition-colors';
        activePanel.classList.remove('hidden');
        activePanel.classList.add('animate-fade-in');
    }

    tabPropsBtn.addEventListener('click', () => setActiveTab(tabPropsBtn, panelProps));
    tabPropEnqBtn.addEventListener('click', () => setActiveTab(tabPropEnqBtn, panelPropEnq));
    tabContactEnqBtn.addEventListener('click', () => setActiveTab(tabContactEnqBtn, panelContactEnq));
    tabTestimonialsBtn.addEventListener('click', () => setActiveTab(tabTestimonialsBtn, panelTestimonials));

    // Properties
    async function loadProperties() {
        document.getElementById('propertiesLoading').classList.remove('hidden');
        document.getElementById('propertiesTableContainer').classList.add('hidden');
        try {
            const res = await apiFetch('<?= base_url('api/properties') ?>');
            if (!res) return;
            const data = await res.json();
            globalProperties = Array.isArray(data) ? data : [];
            document.getElementById('propertiesCount').innerText = globalProperties.length;
            renderPropertiesTable();
        } catch(e) {
            console.error(e);
        } finally {
            document.getElementById('propertiesLoading').classList.add('hidden');
            document.getElementById('propertiesTableContainer').classList.remove('hidden');
        }
    }

    function renderPropertiesTable() {
        const tbody = document.getElementById('propertiesTableBody');
        tbody.innerHTML = '';
        if (globalProperties.length === 0) {
            tbody.innerHTML = `<tr><td colspan="7" class="py-8 text-center text-gray-500">No properties available.</td></tr>`;
            return;
        }
        globalProperties.forEach(p => {
            let imgUrl = p.image_url ? (p.image_url.startsWith('http') ? p.image_url : '<?= base_url() ?>' + p.image_url.replace(/^\//, '')) : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80';
            let formattedPrice = '$' + Number(p.price).toLocaleString();
            let catLabel = p.category === 'na_plot' ? 'NA Plot' : (p.category === 'flat' ? 'Flat' : 'Office');
            
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/80 transition-colors';
            tr.innerHTML = `
                <td class="py-3 px-6"><img src="${imgUrl}" class="w-12 h-12 rounded-lg object-cover border border-gray-100"></td>
                <td class="py-3 px-6 font-bold text-gray-800">${escapeHtml(p.title)}</td>
                <td class="py-3 px-6">${escapeHtml(p.location)}</td>
                <td class="py-3 px-6 font-bold text-indigo-600">${formattedPrice}</td>
                <td class="py-3 px-6"><span class="px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-700">${catLabel}</span></td>
                <td class="py-3 px-6"><span class="px-2 py-1 rounded-md text-xs font-semibold ${p.purpose === 'sell' ? 'bg-green-50 text-green-700' : 'bg-blue-50 text-blue-700'}">For ${p.purpose === 'sell' ? 'Sell' : 'Rent'}</span></td>
                <td class="py-3 px-6 text-right space-x-2">
                    <button onclick="editProperty(${p.id})" class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg cursor-pointer" title="Edit Property"><i data-lucide="edit" class="h-4 w-4"></i></button>
                    <button onclick="deleteProperty(${p.id})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer" title="Delete Property"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // Edit Property Function
    function editProperty(id) {
        const p = globalProperties.find(item => item.id == id);
        if (!p) return;

        document.getElementById('modalTitle').innerText = 'Edit Property';
        document.getElementById('editPropertyId').value = p.id;
        document.getElementById('propTitle').value = p.title || '';
        document.getElementById('propPrice').value = p.price || '';
        document.getElementById('propLocation').value = p.location || '';
        document.getElementById('propCategory').value = p.category || 'flat';
        document.getElementById('propPurpose').value = p.purpose || 'sell';
        document.getElementById('propPropertyType').value = p.property_type || 'residential';
        document.getElementById('propBedrooms').value = p.bedrooms || 1;
        document.getElementById('propBathrooms').value = p.bathrooms || 1;
        document.getElementById('propArea').value = p.area || 1000;
        document.getElementById('propGoogleMap').value = p.google_map || '';
        document.getElementById('propDescription').value = p.description || '';

        const alertBox = document.getElementById('formErrorAlert');
        if (alertBox) alertBox.classList.add('hidden');

        document.getElementById('propertyModal').classList.remove('hidden');
    }

    // Property Enquiries
    async function loadPropEnquiries() {
        document.getElementById('propEnquiriesLoading').classList.remove('hidden');
        document.getElementById('propEnquiriesTableContainer').classList.add('hidden');
        try {
            const res = await apiFetch('<?= base_url('api/enquiries?type=property') ?>');
            if (!res) return;
            const data = await res.json();
            globalPropEnquiries = Array.isArray(data) ? data : [];
            document.getElementById('propEnquiriesCount').innerText = globalPropEnquiries.length;
            renderPropEnquiriesTable();
        } catch(e) {
            console.error(e);
        } finally {
            document.getElementById('propEnquiriesLoading').classList.add('hidden');
            document.getElementById('propEnquiriesTableContainer').classList.remove('hidden');
        }
    }

    function renderPropEnquiriesTable() {
        const tbody = document.getElementById('propEnquiriesTableBody');
        tbody.innerHTML = '';
        if (globalPropEnquiries.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="py-8 text-center text-gray-500">No property enquiries received yet.</td></tr>`;
            return;
        }
        globalPropEnquiries.forEach(e => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/80 transition-colors';
            tr.innerHTML = `
                <td class="py-3 px-6 text-xs text-gray-500">${e.created_at ? new Date(e.created_at).toLocaleDateString() : 'N/A'}</td>
                <td class="py-3 px-6 font-bold text-gray-800">${escapeHtml(e.name)}</td>
                <td class="py-3 px-6"><div>${escapeHtml(e.email)}</div><div class="text-xs text-gray-400">${escapeHtml(e.phone)}</div></td>
                <td class="py-3 px-6 font-medium text-indigo-600">${e.property_title ? escapeHtml(e.property_title) : 'Property #' + e.property_id}</td>
                <td class="py-3 px-6 max-w-xs text-xs text-gray-600 line-clamp-2">${escapeHtml(e.message)}</td>
                <td class="py-3 px-6 text-right">
                    <button onclick="deleteEnquiry(${e.id})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // Contact Enquiries
    async function loadContactEnquiries() {
        document.getElementById('contactEnquiriesLoading').classList.remove('hidden');
        document.getElementById('contactEnquiriesTableContainer').classList.add('hidden');
        try {
            const res = await apiFetch('<?= base_url('api/enquiries?type=contact') ?>');
            if (!res) return;
            const data = await res.json();
            globalContactEnquiries = Array.isArray(data) ? data : [];
            document.getElementById('contactEnquiriesCount').innerText = globalContactEnquiries.length;
            renderContactEnquiriesTable();
        } catch(e) {
            console.error(e);
        } finally {
            document.getElementById('contactEnquiriesLoading').classList.add('hidden');
            document.getElementById('contactEnquiriesTableContainer').classList.remove('hidden');
        }
    }

    function renderContactEnquiriesTable() {
        const tbody = document.getElementById('contactEnquiriesTableBody');
        tbody.innerHTML = '';
        if (globalContactEnquiries.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="py-8 text-center text-gray-500">No contact enquiries received yet.</td></tr>`;
            return;
        }
        globalContactEnquiries.forEach(e => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/80 transition-colors';
            tr.innerHTML = `
                <td class="py-3 px-6 text-xs text-gray-500">${e.created_at ? new Date(e.created_at).toLocaleDateString() : 'N/A'}</td>
                <td class="py-3 px-6 font-bold text-gray-800">${escapeHtml(e.name)}</td>
                <td class="py-3 px-6"><div>${escapeHtml(e.email)}</div><div class="text-xs text-gray-400">${escapeHtml(e.phone)}</div></td>
                <td class="py-3 px-6 max-w-xs text-xs text-gray-600 line-clamp-2">${escapeHtml(e.message)}</td>
                <td class="py-3 px-6 text-right">
                    <button onclick="deleteEnquiry(${e.id})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // Testimonials
    async function loadTestimonials() {
        document.getElementById('testimonialsLoading').classList.remove('hidden');
        document.getElementById('testimonialsTableContainer').classList.add('hidden');
        try {
            const res = await apiFetch('<?= base_url('api/testimonials') ?>');
            if (!res) return;
            const data = await res.json();
            globalTestimonials = Array.isArray(data) ? data : [];
            document.getElementById('testimonialsCount').innerText = globalTestimonials.length;
            renderTestimonialsTable();
        } catch(e) {
            console.error(e);
        } finally {
            document.getElementById('testimonialsLoading').classList.add('hidden');
            document.getElementById('testimonialsTableContainer').classList.remove('hidden');
        }
    }

    function renderTestimonialsTable() {
        const tbody = document.getElementById('testimonialsTableBody');
        tbody.innerHTML = '';
        if (globalTestimonials.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="py-8 text-center text-gray-500">No testimonials added yet.</td></tr>`;
            return;
        }
        globalTestimonials.forEach(t => {
            let stars = '★'.repeat(t.rating || 5);
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/80 transition-colors';
            tr.innerHTML = `
                <td class="py-3 px-6 text-xs text-gray-500">${t.created_at ? new Date(t.created_at).toLocaleDateString() : 'N/A'}</td>
                <td class="py-3 px-6 font-bold text-gray-800">${escapeHtml(t.name)}</td>
                <td class="py-3 px-6 text-xs text-gray-600">${escapeHtml(t.role)}</td>
                <td class="py-3 px-6 text-amber-500 font-bold">${stars}</td>
                <td class="py-3 px-6 max-w-xs text-xs text-gray-600 line-clamp-2">${escapeHtml(t.content)}</td>
                <td class="py-3 px-6 text-right">
                    <button onclick="deleteTestimonial(${t.id})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    // Delete Testimonial Action
    async function deleteTestimonial(id) {
        if (confirm('Are you sure you want to delete this testimonial?')) {
            try {
                const res = await apiFetch('<?= base_url('api/testimonials') ?>/' + id, { method: 'DELETE' });
                if (res && res.ok) {
                    loadTestimonials();
                } else {
                    alert('Failed to delete testimonial.');
                }
            } catch(e) {
                alert('Error deleting testimonial.');
            }
        }
    }

    // Delete Property & Enquiry Actions
    async function deleteProperty(id) {
        if (confirm('Are you sure you want to delete this property?')) {
            const res = await apiFetch('<?= base_url('api/properties') ?>/' + id, { method: 'DELETE' });
            if (res && res.ok) loadProperties();
        }
    }
    async function deleteEnquiry(id) {
        if (confirm('Are you sure you want to delete this enquiry?')) {
            const res = await apiFetch('<?= base_url('api/enquiries') ?>/' + id, { method: 'DELETE' });
            if (res && res.ok) { loadPropEnquiries(); loadContactEnquiries(); }
        }
    }

    // Modals Control
    const propModal = document.getElementById('propertyModal');
    const testModal = document.getElementById('testimonialModal');

    document.getElementById('addPropertyBtn').addEventListener('click', () => {
        document.getElementById('modalTitle').innerText = 'Add Property';
        document.getElementById('editPropertyId').value = '';
        document.getElementById('propertyForm').reset();
        document.getElementById('propGoogleMap').value = '';
        const alertBox = document.getElementById('formErrorAlert');
        if (alertBox) alertBox.classList.add('hidden');
        propModal.classList.remove('hidden');
    });

    document.getElementById('modalCloseBtn').addEventListener('click', () => propModal.classList.add('hidden'));
    document.getElementById('modalCancelBtn').addEventListener('click', () => propModal.classList.add('hidden'));

    document.getElementById('addTestimonialBtn').addEventListener('click', () => {
        const alertBox = document.getElementById('testimonialFormErrorAlert');
        if (alertBox) alertBox.classList.add('hidden');
        testModal.classList.remove('hidden');
    });
    document.getElementById('testimonialModalCloseBtn').addEventListener('click', () => testModal.classList.add('hidden'));
    document.getElementById('testimonialModalCancelBtn').addEventListener('click', () => testModal.classList.add('hidden'));

    // Property Form Submit (Add & Edit)
    document.getElementById('propertyForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('modalSubmitBtn');
        const submitText = document.getElementById('modalSubmitText');
        const submitSpinner = document.getElementById('modalSubmitSpinner');
        const alertBox = document.getElementById('formErrorAlert');

        submitBtn.disabled = true;
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        if (submitText) submitText.innerText = 'Saving...';
        if (alertBox) alertBox.classList.add('hidden');
        if (window.TopLoader) window.TopLoader.start();

        const formData = new FormData(this);
        const editId = document.getElementById('editPropertyId').value;
        const url = editId ? ('<?= base_url('api/properties') ?>/' + editId) : '<?= base_url('api/properties') ?>';

        try {
            const res = await apiFetch(url, { method: 'POST', body: formData });
            const data = await res.json();

            if (res && res.ok) {
                propModal.classList.add('hidden');
                this.reset();
                document.getElementById('editPropertyId').value = '';
                document.getElementById('propGoogleMap').value = '';
                loadProperties();
            } else {
                const errStr = data.errors ? Object.values(data.errors).join(', ') : (data.error || 'Error saving property');
                if (alertBox) {
                    alertBox.innerText = errStr;
                    alertBox.classList.remove('hidden');
                } else {
                    alert(errStr);
                }
            }
        } catch(err) {
            if (alertBox) {
                alertBox.innerText = 'Network error saving property';
                alertBox.classList.remove('hidden');
            } else {
                alert('Network error saving property');
            }
        } finally {
            submitBtn.disabled = false;
            if (submitSpinner) submitSpinner.classList.add('hidden');
            if (submitText) submitText.innerText = 'Save Property';
            if (window.TopLoader) window.TopLoader.complete();
        }
    });

    // Testimonial Form Submit
    document.getElementById('testimonialForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('testimonialModalSubmitBtn');
        const submitText = document.getElementById('testimonialModalSubmitText');
        const submitSpinner = document.getElementById('testimonialModalSubmitSpinner');
        const alertBox = document.getElementById('testimonialFormErrorAlert');

        submitBtn.disabled = true;
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        if (submitText) submitText.innerText = 'Saving...';
        alertBox.classList.add('hidden');
        if (window.TopLoader) window.TopLoader.start();

        const formData = new FormData(this);
        try {
            const res = await apiFetch('<?= base_url('api/testimonials') ?>', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (res && res.ok) {
                testModal.classList.add('hidden');
                this.reset();
                loadTestimonials();
            } else {
                alertBox.innerText = data.messages ? Object.values(data.messages).join(', ') : (data.error || 'Failed to save testimonial.');
                alertBox.classList.remove('hidden');
            }
        } catch(err) {
            alertBox.innerText = 'Network error. Try again.';
            alertBox.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            if (submitSpinner) submitSpinner.classList.add('hidden');
            if (submitText) submitText.innerText = 'Save Testimonial';
            if (window.TopLoader) window.TopLoader.complete();
        }
    });

    function escapeHtml(text) {
        if (!text) return '';
        return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    loadProperties();
    loadPropEnquiries();
    loadContactEnquiries();
    loadTestimonials();
</script>

<?= $this->include('layouts/footer') ?>

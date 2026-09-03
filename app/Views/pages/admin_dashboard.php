<?php require_once APPPATH . 'Views/config.php'; ?>
<?= $this->include('layouts/header') ?>

<div class="bg-gray-100 min-h-screen flex flex-col md:flex-row">

    <!-- LEFT SIDEBAR -->
    <aside id="sidebar" class="w-full md:w-72 bg-indigo-950 text-white shrink-0 md:min-h-screen flex flex-col justify-between p-5 transition-all duration-300">
        <div class="space-y-8">
            <!-- Brand Logo Header -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-500 via-indigo-600 to-purple-600 flex items-center justify-center font-black text-white shadow-lg text-lg">
                        SP
                    </div>
                    <div>
                        <h2 class="font-black text-base tracking-tight text-white leading-none">Sharda Admin</h2>
                        <span class="text-[11px] text-indigo-300 font-medium">Control Panel</span>
                    </div>
                </div>
                <button id="mobileSidebarToggle" class="md:hidden text-indigo-300 hover:text-white p-2">
                    <i data-lucide="menu" class="h-6 w-6"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:block space-y-1.5" id="sidebarNav">
                <button id="tabPropertiesBtn" class="sidebar-nav-btn active w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-white bg-indigo-800/90 shadow-sm cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="home" class="h-4 w-4"></i> Properties
                    </div>
                    <span id="propertiesCount" class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-600 text-white">0</span>
                </button>

                <button id="tabPropEnquiriesBtn" class="sidebar-nav-btn w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-indigo-200 hover:bg-indigo-900/60 hover:text-white cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="building-2" class="h-4 w-4"></i> Property Enquiries
                    </div>
                    <span id="propEnquiriesCount" class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-900 text-indigo-200">0</span>
                </button>

                <button id="tabContactEnquiriesBtn" class="sidebar-nav-btn w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-indigo-200 hover:bg-indigo-900/60 hover:text-white cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail" class="h-4 w-4"></i> Contact Messages
                    </div>
                    <span id="contactEnquiriesCount" class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-900 text-indigo-200">0</span>
                </button>

                <button id="tabTestimonialsBtn" class="sidebar-nav-btn w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-indigo-200 hover:bg-indigo-900/60 hover:text-white cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="star" class="h-4 w-4"></i> Testimonials
                    </div>
                    <span id="testimonialsCount" class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-900 text-indigo-200">0</span>
                </button>

                <button id="tabPartnersBtn" class="sidebar-nav-btn w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-indigo-200 hover:bg-indigo-900/60 hover:text-white cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="handshake" class="h-4 w-4"></i> Partners & Clients
                    </div>
                    <span id="partnersCount" class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-900 text-indigo-200">0</span>
                </button>

                <button id="tabCategoriesBtn" class="sidebar-nav-btn w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-indigo-200 hover:bg-indigo-900/60 hover:text-white cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="tag" class="h-4 w-4"></i> Dynamic Categories
                    </div>
                    <span id="categoriesCount" class="px-2 py-0.5 rounded-full text-[10px] bg-indigo-900 text-indigo-200">0</span>
                </button>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="pt-6 border-t border-indigo-900/80 mt-6 space-y-3">
            <div class="flex items-center gap-3 px-2">
                <div class="w-9 h-9 rounded-xl bg-indigo-800 flex items-center justify-center text-white font-bold text-xs shadow-xs">
                    ADM
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-white truncate" id="adminUserEmail">Admin Account</div>
                    <div class="text-[10px] text-emerald-400 font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse inline-block"></span> Online
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- RIGHT MAIN CONTENT AREA -->
    <main class="flex-1 bg-gray-50/80 p-4 sm:p-6 lg:p-8 min-h-screen overflow-y-auto">
        
        <!-- Top Bar Header & Action Buttons -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-gray-100 shadow-soft mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Dashboard Overview</h1>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Manage listings, enquiries, client reviews, partners, and categories.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-2.5">
                <button id="addPropertyBtn" class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm cursor-pointer">
                    <i data-lucide="plus" class="h-4 w-4"></i> Add Property
                </button>
                <button id="addTestimonialBtn" class="inline-flex items-center gap-1.5 bg-amber-600 hover:bg-amber-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm cursor-pointer">
                    <i data-lucide="star" class="h-4 w-4"></i> Add Testimonial
                </button>
                <button id="addPartnerBtn" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm cursor-pointer">
                    <i data-lucide="handshake" class="h-4 w-4"></i> Add Partner
                </button>
                <button id="addCategoryBtn" class="inline-flex items-center gap-1.5 bg-purple-600 hover:bg-purple-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm cursor-pointer">
                    <i data-lucide="tag" class="h-4 w-4"></i> Add Category
                </button>
            </div>
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

        <!-- Partners & Clients Tab Panel -->
        <div id="panelPartners" class="hidden">
            <div id="partnersLoading" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 skeleton shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/3"></div>
                        <div class="h-3 skeleton w-1/4"></div>
                    </div>
                </div>
            </div>

            <div id="partnersTableContainer" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs border-b border-gray-100">
                            <tr>
                                <th class="py-3.5 px-6">Logo</th>
                                <th class="py-3.5 px-6">Partner / Client Name</th>
                                <th class="py-3.5 px-6">Category</th>
                                <th class="py-3.5 px-6">Description</th>
                                <th class="py-3.5 px-6">Website Link</th>
                                <th class="py-3.5 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="partnersTableBody" class="divide-y divide-gray-100">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Dynamic Categories Tab Panel -->
        <div id="panelCategories" class="hidden">
            <div id="categoriesLoading" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 skeleton shrink-0"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 skeleton w-1/3"></div>
                        <div class="h-3 skeleton w-1/4"></div>
                    </div>
                </div>
            </div>

            <div id="categoriesTableContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8 hidden">
                <!-- Property Categories Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Property Categories</h3>
                            <p class="text-xs text-gray-500">Categories used in Property listings & filters</p>
                        </div>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 font-extrabold text-xs rounded-full" id="propCategoriesCount">0</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                                <tr>
                                    <th class="py-2.5 px-4">Category Name</th>
                                    <th class="py-2.5 px-4">Slug</th>
                                    <th class="py-2.5 px-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="propertyCategoriesTableBody" class="divide-y divide-gray-100">
                                <!-- Populated via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Partner Categories Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Partner & Client Categories</h3>
                            <p class="text-xs text-gray-500">Categories used in Partner listings & tabs</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 font-extrabold text-xs rounded-full" id="partnerCategoriesCount">0</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                                <tr>
                                    <th class="py-2.5 px-4">Category Name</th>
                                    <th class="py-2.5 px-4">Slug</th>
                                    <th class="py-2.5 px-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="partnerCategoriesTableBody" class="divide-y divide-gray-100">
                                <!-- Populated via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Dynamic Category Add Modal -->
<div id="categoryModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Add Dynamic Category</h3>
            <button id="categoryModalCloseBtn" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>

        <form id="categoryForm" class="p-6 space-y-5">
            <div id="categoryFormErrorAlert" class="hidden bg-red-50 border-l-4 border-red-400 p-4 text-sm text-red-700 rounded-r-lg"></div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category Name *</label>
                <input type="text" id="categoryName" name="name" required placeholder="e.g. Warehouse, Media Partner, Villa" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-indigo-600 text-sm font-medium">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category Type *</label>
                <select id="categoryType" name="type" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-indigo-600 text-sm font-medium">
                    <option value="property">Property Category</option>
                    <option value="partner">Partner / Client Category</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-gray-100">
                <button type="button" id="categoryModalCancelBtn" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-100 cursor-pointer">Cancel</button>
                <button type="submit" id="categoryModalSubmitBtn" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition-colors cursor-pointer shadow-md">
                    <svg id="categoryModalSubmitSpinner" class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span id="categoryModalSubmitText">Save Category</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Partner & Client Add/Edit Modal -->
<div id="partnerModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 id="partnerModalTitle" class="text-xl font-bold text-gray-900">Add Partner / Client</h3>
            <button id="partnerModalCloseBtn" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>

        <form id="partnerForm" class="p-6 space-y-5">
            <input type="hidden" id="editPartnerId" name="id" value="">
            <div id="partnerFormErrorAlert" class="hidden bg-red-50 border-l-4 border-red-400 p-4 text-sm text-red-700 rounded-r-lg"></div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Partner / Client Name *</label>
                <input type="text" id="partnerName" name="name" required placeholder="e.g. HDFC Bank, Sharda Builders" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-indigo-600 text-sm font-medium">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category *</label>
                <select id="partnerCategory" name="category" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-indigo-600 text-sm font-medium">
                    <option value="Builder">Builder / Developer</option>
                    <option value="Banking">Banking & Financial Partner</option>
                    <option value="Corporate Client">Corporate Client</option>
                    <option value="Legal">Legal & Advisory</option>
                    <option value="Channel Partner">Channel Partner</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Website URL (Optional)</label>
                <input type="url" id="partnerWebsiteUrl" name="website_url" placeholder="https://example.com" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-indigo-600 text-sm font-medium">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Upload Partner / Client Logo *</label>
                <div class="space-y-3">
                    <input type="file" id="partnerLogoFileInput" name="logo" accept="image/*" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-xs text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                    <input type="hidden" id="partnerLogoUrl" name="logo_url" value="">
                    
                    <div id="partnerLogoPreviewWrapper" class="hidden flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200">
                        <img id="partnerLogoPreviewImg" src="" alt="Logo Preview" class="w-12 h-12 rounded-lg object-contain bg-white border border-gray-200 p-1">
                        <div>
                            <span class="text-xs font-bold text-gray-700 block">Logo Image</span>
                            <span class="text-[11px] text-emerald-600 font-semibold" id="partnerLogoPreviewText">File ready</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Short Description</label>
                <textarea id="partnerDescription" name="description" rows="3" placeholder="Brief description of the partner or client..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-indigo-600 text-sm font-medium"></textarea>
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-gray-100">
                <button type="button" id="partnerModalCancelBtn" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-100 cursor-pointer">Cancel</button>
                <button type="submit" id="partnerModalSubmitBtn" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition-colors cursor-pointer shadow-md">
                    <svg id="partnerModalSubmitSpinner" class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span id="partnerModalSubmitText">Save Partner</span>
                </button>
            </div>
        </form>
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
    let globalPartners = [];

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

    // Tabs Control with Persistence across Page Refreshes
    const tabPropsBtn = document.getElementById('tabPropertiesBtn');
    const tabPropEnqBtn = document.getElementById('tabPropEnquiriesBtn');
    const tabContactEnqBtn = document.getElementById('tabContactEnquiriesBtn');
    const tabTestimonialsBtn = document.getElementById('tabTestimonialsBtn');
    const tabPartnersBtn = document.getElementById('tabPartnersBtn');
    const tabCategoriesBtn = document.getElementById('tabCategoriesBtn');

    const panelProps = document.getElementById('panelProperties');
    const panelPropEnq = document.getElementById('panelPropEnquiries');
    const panelContactEnq = document.getElementById('panelContactEnquiries');
    const panelTestimonials = document.getElementById('panelTestimonials');
    const panelPartners = document.getElementById('panelPartners');
    const panelCategories = document.getElementById('panelCategories');

    const tabMap = {
        'properties': { btn: tabPropsBtn, panel: panelProps },
        'prop-enquiries': { btn: tabPropEnqBtn, panel: panelPropEnq },
        'contact-enquiries': { btn: tabContactEnqBtn, panel: panelContactEnq },
        'testimonials': { btn: tabTestimonialsBtn, panel: panelTestimonials },
        'partners': { btn: tabPartnersBtn, panel: panelPartners },
        'categories': { btn: tabCategoriesBtn, panel: panelCategories }
    };

    function setActiveTab(tabKey) {
        const target = tabMap[tabKey] || tabMap['properties'];

        Object.keys(tabMap).forEach(key => {
            const item = tabMap[key];
            if (item.btn) item.btn.className = 'sidebar-nav-btn w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-indigo-200 hover:bg-indigo-900/60 hover:text-white cursor-pointer';
            if (item.panel) {
                item.panel.classList.add('hidden');
                item.panel.classList.remove('animate-fade-in');
            }
        });

        if (target.btn) target.btn.className = 'sidebar-nav-btn active w-full flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all text-white bg-indigo-800/90 shadow-sm cursor-pointer';
        if (target.panel) {
            target.panel.classList.remove('hidden');
            target.panel.classList.add('animate-fade-in');
        }

        const sidebarNavElem = document.getElementById('sidebarNav');
        if (window.innerWidth < 768 && sidebarNavElem && !sidebarNavElem.classList.contains('hidden')) {
            sidebarNavElem.classList.add('hidden');
        }

        try {
            localStorage.setItem('adminActiveTab', tabKey);
            history.replaceState(null, null, '#' + tabKey);
        } catch(e) {}
    }

    if (tabPropsBtn) tabPropsBtn.addEventListener('click', () => setActiveTab('properties'));
    if (tabPropEnqBtn) tabPropEnqBtn.addEventListener('click', () => setActiveTab('prop-enquiries'));
    if (tabContactEnqBtn) tabContactEnqBtn.addEventListener('click', () => setActiveTab('contact-enquiries'));
    if (tabTestimonialsBtn) tabTestimonialsBtn.addEventListener('click', () => setActiveTab('testimonials'));
    if (tabPartnersBtn) tabPartnersBtn.addEventListener('click', () => setActiveTab('partners'));
    if (tabCategoriesBtn) tabCategoriesBtn.addEventListener('click', () => setActiveTab('categories'));

    function initActiveTab() {
        const hash = window.location.hash ? window.location.hash.replace('#', '') : '';
        const savedTab = hash || localStorage.getItem('adminActiveTab') || 'properties';
        setActiveTab(tabMap[savedTab] ? savedTab : 'properties');
    }

    initActiveTab();

    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
    const sidebarNav = document.getElementById('sidebarNav');
    if (mobileSidebarToggle && sidebarNav) {
        mobileSidebarToggle.addEventListener('click', () => {
            sidebarNav.classList.toggle('hidden');
        });
    }

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

    // Partners & Clients CRUD Logic
    const partnerModal = document.getElementById('partnerModal');
    const addPartnerBtn = document.getElementById('addPartnerBtn');
    const partnerModalCloseBtn = document.getElementById('partnerModalCloseBtn');
    const partnerModalCancelBtn = document.getElementById('partnerModalCancelBtn');
    const partnerLogoFileInput = document.getElementById('partnerLogoFileInput');
    const partnerLogoPreviewWrapper = document.getElementById('partnerLogoPreviewWrapper');
    const partnerLogoPreviewImg = document.getElementById('partnerLogoPreviewImg');

    if (partnerLogoFileInput) {
        partnerLogoFileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (partnerLogoPreviewImg) partnerLogoPreviewImg.src = e.target.result;
                    if (partnerLogoPreviewWrapper) partnerLogoPreviewWrapper.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (addPartnerBtn) {
        addPartnerBtn.addEventListener('click', () => {
            document.getElementById('partnerModalTitle').innerText = 'Add Partner / Client';
            document.getElementById('editPartnerId').value = '';
            document.getElementById('partnerForm').reset();
            document.getElementById('partnerLogoUrl').value = '';
            if (partnerLogoPreviewWrapper) partnerLogoPreviewWrapper.classList.add('hidden');
            document.getElementById('partnerFormErrorAlert').classList.add('hidden');
            partnerModal.classList.remove('hidden');
        });
    }

    [partnerModalCloseBtn, partnerModalCancelBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                partnerModal.classList.add('hidden');
            });
        }
    });

    async function loadPartners() {
        document.getElementById('partnersLoading').classList.remove('hidden');
        document.getElementById('partnersTableContainer').classList.add('hidden');
        try {
            const res = await apiFetch('<?= base_url('api/partners') ?>');
            if (!res) return;
            const data = await res.json();
            globalPartners = Array.isArray(data) ? data : [];
            const countElem = document.getElementById('partnersCount');
            if (countElem) countElem.innerText = globalPartners.length;
            renderPartnersTable();
        } catch(e) {
            console.error(e);
        } finally {
            document.getElementById('partnersLoading').classList.add('hidden');
            document.getElementById('partnersTableContainer').classList.remove('hidden');
        }
    }

    function renderPartnersTable() {
        const tbody = document.getElementById('partnersTableBody');
        if (!tbody) return;
        tbody.innerHTML = '';
        if (globalPartners.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="py-8 text-center text-gray-500">No partners or clients added yet.</td></tr>`;
            return;
        }
        globalPartners.forEach(p => {
            let logoImg = p.logo_url ? (p.logo_url.startsWith('http') ? p.logo_url : '<?= base_url() ?>' + p.logo_url.replace(/^\//, '')) : '';
            let initials = escapeHtml(p.name ? p.name.substring(0, 2).toUpperCase() : 'P');
            let logoHtml = logoImg ? `<img src="${logoImg}" class="w-10 h-10 rounded-lg object-contain bg-gray-50 border border-gray-100 p-1">` : `<div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-xs">${initials}</div>`;

            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/80 transition-colors';
            tr.innerHTML = `
                <td class="py-3 px-6">${logoHtml}</td>
                <td class="py-3 px-6 font-bold text-gray-800">${escapeHtml(p.name)}</td>
                <td class="py-3 px-6"><span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">${escapeHtml(p.category || 'Builder')}</span></td>
                <td class="py-3 px-6 max-w-xs text-xs text-gray-600 line-clamp-2">${escapeHtml(p.description || '-')}</td>
                <td class="py-3 px-6 text-xs font-medium text-indigo-600">${p.website_url ? `<a href="${escapeHtml(p.website_url)}" target="_blank" class="hover:underline flex items-center gap-1">Website <i data-lucide="external-link" class="h-3 w-3"></i></a>` : '-'}</td>
                <td class="py-3 px-6 text-right space-x-2">
                    <button onclick="editPartner(${p.id})" class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg cursor-pointer" title="Edit Partner"><i data-lucide="edit" class="h-4 w-4"></i></button>
                    <button onclick="deletePartner(${p.id})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer" title="Delete Partner"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function editPartner(id) {
        const p = globalPartners.find(item => item.id == id);
        if (!p) return;

        document.getElementById('partnerModalTitle').innerText = 'Edit Partner / Client';
        document.getElementById('editPartnerId').value = p.id;
        document.getElementById('partnerName').value = p.name || '';
        document.getElementById('partnerCategory').value = p.category || 'Builder';
        document.getElementById('partnerWebsiteUrl').value = p.website_url || '';
        document.getElementById('partnerLogoUrl').value = p.logo_url || '';
        document.getElementById('partnerDescription').value = p.description || '';

        if (p.logo_url && partnerLogoPreviewWrapper && partnerLogoPreviewImg) {
            let logoSrc = p.logo_url.startsWith('http') ? p.logo_url : ('<?= base_url() ?>' + p.logo_url.replace(/^\//, ''));
            partnerLogoPreviewImg.src = logoSrc;
            partnerLogoPreviewWrapper.classList.remove('hidden');
        } else if (partnerLogoPreviewWrapper) {
            partnerLogoPreviewWrapper.classList.add('hidden');
        }

        const alertBox = document.getElementById('partnerFormErrorAlert');
        if (alertBox) alertBox.classList.add('hidden');

        partnerModal.classList.remove('hidden');
    }

    async function deletePartner(id) {
        if (!confirm('Are you sure you want to delete this partner / client?')) return;
        if (window.TopLoader) window.TopLoader.start();
        try {
            const res = await apiFetch('<?= base_url('api/partners') ?>/' + id, { method: 'DELETE' });
            if (res && res.ok) {
                loadPartners();
            }
        } catch(e) {
            console.error(e);
        } finally {
            if (window.TopLoader) window.TopLoader.complete();
        }
    }

    document.getElementById('partnerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('partnerModalSubmitBtn');
        const submitText = document.getElementById('partnerModalSubmitText');
        const submitSpinner = document.getElementById('partnerModalSubmitSpinner');
        const alertBox = document.getElementById('partnerFormErrorAlert');
        const editId = document.getElementById('editPartnerId').value;

        submitBtn.disabled = true;
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        if (submitText) submitText.innerText = 'Saving...';
        alertBox.classList.add('hidden');
        if (window.TopLoader) window.TopLoader.start();

        const formData = new FormData(this);
        const url = editId ? ('<?= base_url('api/partners') ?>/' + editId) : '<?= base_url('api/partners') ?>';

        try {
            const res = await apiFetch(url, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (res && res.ok) {
                partnerModal.classList.add('hidden');
                document.getElementById('editPartnerId').value = '';
                this.reset();
                loadPartners();
            } else {
                alertBox.innerText = data.messages ? Object.values(data.messages).join(', ') : (data.error || 'Failed to save partner.');
                alertBox.classList.remove('hidden');
            }
        } catch(err) {
            alertBox.innerText = 'Network error. Try again.';
            alertBox.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            if (submitSpinner) submitSpinner.classList.add('hidden');
            if (submitText) submitText.innerText = 'Save Partner';
            if (window.TopLoader) window.TopLoader.complete();
        }
    });

    // Dynamic Categories Manager for Properties & Partners
    let globalPropertyCategories = [];
    let globalPartnerCategories = [];

    const categoryModal = document.getElementById('categoryModal');
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const categoryModalCloseBtn = document.getElementById('categoryModalCloseBtn');
    const categoryModalCancelBtn = document.getElementById('categoryModalCancelBtn');

    if (addCategoryBtn) {
        addCategoryBtn.addEventListener('click', () => {
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryFormErrorAlert').classList.add('hidden');
            categoryModal.classList.remove('hidden');
        });
    }

    [categoryModalCloseBtn, categoryModalCancelBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                categoryModal.classList.add('hidden');
            });
        }
    });

    async function loadCategories() {
        const loadingBox = document.getElementById('categoriesLoading');
        const containerBox = document.getElementById('categoriesTableContainer');
        if (loadingBox) loadingBox.classList.remove('hidden');
        if (containerBox) containerBox.classList.add('hidden');

        try {
            const resProp = await apiFetch('<?= base_url('api/categories?type=property') ?>');
            if (resProp && resProp.ok) {
                globalPropertyCategories = await resProp.json();
                renderCategorySelect('propCategory', globalPropertyCategories, 'flat');
            }
            const resPart = await apiFetch('<?= base_url('api/categories?type=partner') ?>');
            if (resPart && resPart.ok) {
                globalPartnerCategories = await resPart.json();
                renderCategorySelect('partnerCategory', globalPartnerCategories, 'Builder');
            }

            renderCategoryTables();
            const totalCatCount = (globalPropertyCategories.length || 0) + (globalPartnerCategories.length || 0);
            const countElem = document.getElementById('categoriesCount');
            if (countElem) countElem.innerText = totalCatCount;
        } catch(e) {
            console.error(e);
        } finally {
            if (loadingBox) loadingBox.classList.add('hidden');
            if (containerBox) containerBox.classList.remove('hidden');
        }
    }

    function renderCategorySelect(elemId, categories, defaultValue) {
        const select = document.getElementById(elemId);
        if (!select || !Array.isArray(categories) || categories.length === 0) return;
        const currentVal = select.value || defaultValue;
        select.innerHTML = '';
        categories.forEach(cat => {
            const opt = document.createElement('option');
            opt.value = cat.slug;
            opt.textContent = cat.name;
            if (cat.slug === currentVal) opt.selected = true;
            select.appendChild(opt);
        });
    }

    function renderCategoryTables() {
        // Render Property Categories Table
        const propTbody = document.getElementById('propertyCategoriesTableBody');
        const propCountElem = document.getElementById('propCategoriesCount');
        if (propCountElem) propCountElem.innerText = globalPropertyCategories.length;
        if (propTbody) {
            propTbody.innerHTML = '';
            if (globalPropertyCategories.length === 0) {
                propTbody.innerHTML = `<tr><td colspan="3" class="py-4 text-center text-gray-400">No property categories.</td></tr>`;
            } else {
                globalPropertyCategories.forEach(cat => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50/80 transition-colors';
                    tr.innerHTML = `
                        <td class="py-2.5 px-4 font-bold text-gray-800">${escapeHtml(cat.name)}</td>
                        <td class="py-2.5 px-4 text-xs font-mono text-indigo-600">${escapeHtml(cat.slug)}</td>
                        <td class="py-2.5 px-4 text-right">
                            <button onclick="deleteCategory(${cat.id})" class="p-1 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer" title="Delete Category"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                        </td>
                    `;
                    propTbody.appendChild(tr);
                });
            }
        }

        // Render Partner Categories Table
        const partTbody = document.getElementById('partnerCategoriesTableBody');
        const partCountElem = document.getElementById('partnerCategoriesCount');
        if (partCountElem) partCountElem.innerText = globalPartnerCategories.length;
        if (partTbody) {
            partTbody.innerHTML = '';
            if (globalPartnerCategories.length === 0) {
                partTbody.innerHTML = `<tr><td colspan="3" class="py-4 text-center text-gray-400">No partner categories.</td></tr>`;
            } else {
                globalPartnerCategories.forEach(cat => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50/80 transition-colors';
                    tr.innerHTML = `
                        <td class="py-2.5 px-4 font-bold text-gray-800">${escapeHtml(cat.name)}</td>
                        <td class="py-2.5 px-4 text-xs font-mono text-emerald-600">${escapeHtml(cat.slug)}</td>
                        <td class="py-2.5 px-4 text-right">
                            <button onclick="deleteCategory(${cat.id})" class="p-1 text-red-600 hover:bg-red-50 rounded-lg cursor-pointer" title="Delete Category"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                        </td>
                    `;
                    partTbody.appendChild(tr);
                });
            }
        }
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    async function deleteCategory(id) {
        if (!confirm('Are you sure you want to delete this category?')) return;
        if (window.TopLoader) window.TopLoader.start();
        try {
            const res = await apiFetch('<?= base_url('api/categories') ?>/' + id, { method: 'DELETE' });
            if (res && res.ok) {
                loadCategories();
            }
        } catch(e) {
            console.error(e);
        } finally {
            if (window.TopLoader) window.TopLoader.complete();
        }
    }

    document.getElementById('categoryForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('categoryModalSubmitBtn');
        const submitText = document.getElementById('categoryModalSubmitText');
        const submitSpinner = document.getElementById('categoryModalSubmitSpinner');
        const alertBox = document.getElementById('categoryFormErrorAlert');

        submitBtn.disabled = true;
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        if (submitText) submitText.innerText = 'Saving...';
        alertBox.classList.add('hidden');
        if (window.TopLoader) window.TopLoader.start();

        const formData = new FormData(this);
        try {
            const res = await apiFetch('<?= base_url('api/categories') ?>', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (res && res.ok) {
                categoryModal.classList.add('hidden');
                this.reset();
                loadCategories();
            } else {
                alertBox.innerText = data.error || 'Failed to create category.';
                alertBox.classList.remove('hidden');
            }
        } catch(err) {
            alertBox.innerText = 'Network error. Try again.';
            alertBox.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            if (submitSpinner) submitSpinner.classList.add('hidden');
            if (submitText) submitText.innerText = 'Save Category';
            if (window.TopLoader) window.TopLoader.complete();
        }
    });

    function escapeHtml(text) {
        if (!text) return '';
        return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    loadCategories();
    loadProperties();
    loadPropEnquiries();
    loadContactEnquiries();
    loadTestimonials();
    loadPartners();
</script>

<?= $this->include('layouts/footer') ?>

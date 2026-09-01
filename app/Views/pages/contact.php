<?php
require_once APPPATH . 'Views/config.php';

$page_title = 'Contact Us - Sharda Properties | Get In Touch';
$page_description = 'Contact Sharda Properties today. Call us, send an email, or visit our office to inquire about real estate buying, selling, or leasing solutions.';

require_once APPPATH . 'Views/layouts/header.php';
?>

<div class="bg-gray-50 min-h-screen pb-16">
    <!-- Header -->
    <div class="bg-indigo-900 text-white py-16 px-4 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center"></div>
        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold tracking-tight">Contact Us</h1>
            <p class="mt-4 text-lg text-indigo-100 max-w-2xl mx-auto">
                Have questions about a property or want to sell with us? Get in touch today.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Contact Details Widget -->
            <div class="lg:col-span-1 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-8">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Get in Touch</h3>
                    <p class="text-gray-500 text-sm">Feel free to contact us via phone, email, or by visiting our office.</p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-indigo-50 p-3 rounded-xl text-indigo-600 shrink-0">
                            <i data-lucide="phone" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Call Us</h4>
                            <p class="text-gray-600 text-sm mt-0.5">+1 (234) 567-890</p>
                            <p class="text-gray-500 text-xs mt-0.5">Mon-Sat: 9:00 AM - 7:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-indigo-50 p-3 rounded-xl text-indigo-600 shrink-0">
                            <i data-lucide="mail" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Email Us</h4>
                            <p class="text-gray-600 text-sm mt-0.5">info@shardaproperties.com</p>
                            <p class="text-gray-500 text-xs mt-0.5">support@shardaproperties.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-indigo-50 p-3 rounded-xl text-indigo-600 shrink-0">
                            <i data-lucide="map-pin" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Our Office</h4>
                            <p class="text-gray-600 text-sm mt-0.5">102 Sharda Heights, Main Street Road,</p>
                            <p class="text-gray-500 text-sm">Downtown City, 411001</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2 bg-white p-8 sm:p-10 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Send an Enquiry</h3>
                
                <div id="contactAlert" class="hidden mb-6 p-4 rounded-r-lg flex items-center gap-3"></div>

                <form id="contactForm" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Your Name</label>
                            <input
                                type="text"
                                required
                                name="name"
                                class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500"
                                placeholder="John Doe"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Phone Number</label>
                            <input
                                type="tel"
                                required
                                name="phone"
                                class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500"
                                placeholder="1234567890"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Email Address</label>
                        <input
                            type="email"
                            required
                            name="email"
                            class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500"
                            placeholder="john@example.com"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Your Message</label>
                        <textarea
                            required
                            name="message"
                            rows="5"
                            class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 resize-none"
                            placeholder="Tell us about the property you are interested in or query..."
                        ></textarea>
                    </div>

                    <div>
                        <button
                            type="submit"
                            id="contactSubmitBtn"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 text-white font-semibold px-6 py-3 rounded-lg text-sm cursor-pointer transition-colors shadow-sm"
                        >
                            <i data-lucide="send" class="h-4 w-4"></i>
                            <span id="contactSubmitText">Send Message</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('contactForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const alertBox = document.getElementById('contactAlert');
        const submitBtn = document.getElementById('contactSubmitBtn');
        const submitText = document.getElementById('contactSubmitText');
        const formData = new FormData(this);

        submitBtn.disabled = true;
        submitText.innerText = 'Sending...';
        alertBox.className = 'hidden';

        try {
            const response = await fetch('<?= API_BASE_URL ?>/enquiries', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData)),
            });

            const data = await response.json();

            if (response.ok) {
                alertBox.className = 'mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-center gap-3 text-green-800 text-sm font-medium';
                alertBox.innerHTML = `
                    <i data-lucide="check-circle-2" class="h-6 w-6 text-green-600 shrink-0"></i>
                    <div>
                        <h4 class="font-bold text-green-800 text-sm">Submission Successful</h4>
                        <p class="text-green-700 text-xs mt-0.5">Your enquiry has been logged. An agent will contact you shortly.</p>
                    </div>
                `;
                this.reset();
            } else {
                alertBox.className = 'mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-center gap-3 text-red-700 text-sm';
                alertBox.innerHTML = `<i data-lucide="alert-circle" class="h-6 w-6 text-red-600 shrink-0"></i> <span>${data.error || 'Failed to send enquiry. Please check your inputs.'}</span>`;
            }
        } catch (err) {
            alertBox.className = 'mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-center gap-3 text-red-700 text-sm';
            alertBox.innerHTML = `<i data-lucide="alert-circle" class="h-6 w-6 text-red-600 shrink-0"></i> <span>Network error. Please try again later.</span>`;
        } finally {
            submitBtn.disabled = false;
            submitText.innerText = 'Send Message';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }
    });
</script>

<?php require_once APPPATH . 'Views/layouts/footer.php'; ?>

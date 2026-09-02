<?php require_once APPPATH . 'Views/config.php'; ?>
<?= $this->include('layouts/header') ?>

<div class="min-h-[80vh] bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center animate-fade-in-up">
        <div class="inline-flex bg-indigo-100 p-3 rounded-full text-indigo-600 mb-4">
            <i data-lucide="home" class="h-8 w-8"></i>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900">Admin Login</h2>
        <p class="mt-2 text-sm text-gray-600">
            Sign in to manage Sharda Properties
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-fade-in-up">
        <div class="bg-white py-8 px-4 shadow-md rounded-2xl sm:px-10 border border-gray-100 transition-all">
            <div id="loginAlert" class="hidden mb-4 bg-red-50 border-l-4 border-red-400 p-4 text-sm text-red-700 rounded-lg animate-fade-in"></div>

            <form id="loginForm" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        Email Address
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            placeholder="admin@sharda.com"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        Password
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            placeholder="••••••••"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        id="loginSubmitBtn"
                        class="w-full flex justify-center items-center gap-2 py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-60 cursor-pointer transition-all"
                    >
                        <span id="loginSubmitSpinner" class="hidden"><svg class="animate-spin-custom h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>
                        <span id="loginSubmitText">Sign In</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const adminUrl = '<?= base_url('admin') ?>';

    // Redirect if already logged in
    if (localStorage.getItem('token')) {
        window.location.href = adminUrl;
    }

    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const alertBox = document.getElementById('loginAlert');
        const submitBtn = document.getElementById('loginSubmitBtn');
        const submitText = document.getElementById('loginSubmitText');
        const submitSpinner = document.getElementById('loginSubmitSpinner');
        const formData = new FormData(this);

        submitBtn.disabled = true;
        if (submitSpinner) submitSpinner.classList.remove('hidden');
        submitText.innerText = 'Signing in...';
        alertBox.classList.add('hidden');
        if (window.TopLoader) window.TopLoader.start();

        try {
            const response = await fetch('<?= base_url('api/login') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData)),
            });

            const data = await response.json();

            if (response.ok && data.token) {
                localStorage.setItem('token', data.token);
                localStorage.setItem('user', JSON.stringify(data.user));
                window.location.href = adminUrl;
            } else {
                alertBox.innerText = data.error || data.message || 'Invalid email or password.';
                alertBox.classList.remove('hidden');
            }
        } catch (err) {
            alertBox.innerText = 'Network error. Please try again.';
            alertBox.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            if (submitSpinner) submitSpinner.classList.add('hidden');
            submitText.innerText = 'Sign In';
            if (window.TopLoader) window.TopLoader.complete();
        }
    });
</script>

<?= $this->include('layouts/footer') ?>

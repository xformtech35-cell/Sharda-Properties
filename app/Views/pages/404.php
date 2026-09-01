<?= $this->include('layouts/header') ?>

<div class="min-h-[70vh] flex flex-col items-center justify-center bg-gray-50 px-4">
    <div class="bg-indigo-100 p-4 rounded-full text-indigo-600 mb-4">
        <i data-lucide="alert-circle" class="h-10 w-10"></i>
    </div>
    <h2 class="text-3xl font-extrabold text-gray-800">Page or Property Not Found</h2>
    <p class="text-gray-500 mt-2 max-w-md text-center">The requested page or property might have been removed or does not exist.</p>
    <a href="<?= base_url('/') ?>" class="mt-6 inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 font-semibold transition-colors">
        <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to Home Listings
    </a>
</div>

<?= $this->include('layouts/footer') ?>

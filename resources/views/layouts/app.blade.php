<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Tool gratis untuk membuat invoice dan RAB versi Indonesia. Tanpa login, langsung pakai!">
    <meta name="keywords" content="invoice, RAB, Indonesia, gratis, online, maker">
    <meta name="author" content="Pagu.id">
    <title>Pagu.id - Invoice & RAB Maker Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-gray-900">
                        📄 Pagu.id
                    </a>
                </div>
                <div class="hidden md:flex space-x-4">
                    <a href="/"
                        class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->is('/') ? 'text-blue-600' : '' }}">
                        Home
                    </a>
                    <a href="/invoice"
                        class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->is('invoice') ? 'text-blue-600' : '' }}">
                        Invoice
                    </a>
                    <a href="/rab"
                        class="px-4 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors {{ request()->is('rab') ? 'text-green-600' : '' }}">
                        RAB
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
                <a href="/invoice" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Invoice</a>
                <a href="/rab" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">RAB</a>
            </div>
        </div>
    </nav>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </div>

    <footer class="mt-12 text-center text-sm text-gray-500 border-t border-gray-200 pt-6 pb-6">
        <p>💡 Tips: Tekan Ctrl+P untuk print atau klik tombol Export PDF untuk download</p>
        <p class="mt-2">Dibuat dengan ❤️ untuk komunitas Indonesia • Open Source</p>
    </footer>

    @livewireScripts

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>

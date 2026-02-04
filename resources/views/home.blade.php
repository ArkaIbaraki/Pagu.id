<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Tool gratis untuk membuat invoice dan RAB versi Indonesia. Tanpa login, langsung pakai!">
    <title>Invoice & RAB Maker - Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-gray-900">
                        📄 Invoice & RAB Maker
                    </a>
                </div>
                <div class="flex space-x-4">
                    <a href="/" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Home
                    </a>
                    <a href="/invoice"
                        class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Invoice
                    </a>
                    <a href="/rab" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        RAB
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-gray-900 mb-4">
                    📄 Invoice & RAB Maker
                </h1>
                <p class="text-xl text-gray-600 mb-2">
                    Tool gratis untuk membuat invoice dan RAB versi Indonesia
                </p>
                <p class="text-lg text-gray-500">
                    Tanpa login • Tanpa ribet • Langsung pakai
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Invoice Card -->
                <a href="/invoice" class="group">
                    <div
                        class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-transparent hover:border-blue-500">
                        <div class="text-center">
                            <div class="text-6xl mb-4">🧾</div>
                            <h2
                                class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                                Invoice Maker
                            </h2>
                            <p class="text-gray-600 mb-6">
                                Buat invoice profesional dengan format Indonesia. Lengkap dengan terbilang otomatis!
                            </p>
                            <div class="space-y-2 text-left text-sm text-gray-600">
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Mode dengan/tanpa quantity</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Perhitungan otomatis (diskon, PPN)</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Terbilang Indonesia 🇮🇩</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Export PDF & Print</span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <span
                                    class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-medium group-hover:bg-blue-700 transition-colors">
                                    Buat Invoice →
                                </span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- RAB Card -->
                <a href="/rab" class="group">
                    <div
                        class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-transparent hover:border-green-500">
                        <div class="text-center">
                            <div class="text-6xl mb-4">📊</div>
                            <h2
                                class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-green-600 transition-colors">
                                RAB Maker
                            </h2>
                            <p class="text-gray-600 mb-6">
                                Buat Rencana Anggaran Biaya (RAB) dengan detail lengkap dan terstruktur.
                            </p>
                            <div class="space-y-2 text-left text-sm text-gray-600">
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Detail item dengan volume & satuan</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Breakdown biaya material & upah</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Perhitungan otomatis total biaya</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="mr-2">✓</span>
                                    <span>Export PDF & Print</span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <span
                                    class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-medium group-hover:bg-green-700 transition-colors">
                                    Buat RAB →
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Info Section -->
            <div class="mt-16 max-w-3xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">
                        🎯 Kenapa Pilih Tool Ini?
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="text-center">
                            <div class="text-3xl mb-2">⚡</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Super Cepat</h4>
                            <p class="text-sm text-gray-600">Buat invoice/RAB dalam 2-3 menit saja</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-2">🆓</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Gratis 100%</h4>
                            <p class="text-sm text-gray-600">Tanpa biaya, tanpa login, tanpa ribet</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-2">🇮🇩</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Format Indonesia</h4>
                            <p class="text-sm text-gray-600">Terbilang otomatis & format lokal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-600 mb-2">
                💡 Tips: Invoice untuk tagihan klien, RAB untuk perencanaan proyek
            </p>
            <p class="text-gray-500 text-sm">
                Dibuat dengan ❤️ untuk komunitas Indonesia • Open Source
            </p>
        </div>
    </footer>
</body>

</html>

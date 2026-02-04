<div>
    <!-- Flash Messages -->
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 flex items-center justify-between">
            <div class="flex items-center">
                <span class="mr-2">⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">✕</button>
        </div>
    @endif

    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-900">📊 RAB (Rencana Anggaran Biaya) Maker</h1>
        <p class="text-gray-600 mt-1">Buat RAB profesional dengan detail lengkap</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- FORM INPUT (KIRI) -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">📝 Data RAB</h2>

            <!-- Data Dasar -->
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Proyek *</label>
                    <input type="text" wire:model.live="namaProyek"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                        placeholder="Pembangunan Rumah 2 Lantai">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor RAB</label>
                        <div class="flex space-x-2">
                            <input type="text" wire:model.live="nomorRab"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                            <button wire:click="regenerateRabNumber"
                                class="px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-sm whitespace-nowrap"
                                title="Generate nomor baru">
                                🔄
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" wire:model.live="tanggalRab"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Proyek</label>
                        <input type="text" wire:model.live="lokasi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="Jakarta Selatan">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
                        <input type="text" wire:model.live="namaPemilik"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="PT. Contoh">
                    </div>
                </div>
            </div>

            <!-- Items -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-bold text-gray-900">Rincian Biaya</h3>
                    <button wire:click="addItem"
                        class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                        + Tambah Item
                    </button>
                </div>

                <div class="space-y-3">
                    @foreach ($items as $index => $item)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <span class="font-semibold text-gray-700">Item {{ $index + 1 }}</span>
                                @if (count($items) > 1)
                                    <button wire:click="removeItem({{ $index }})"
                                        class="text-red-600 hover:text-red-800 text-sm">
                                        Hapus
                                    </button>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs text-gray-600 mb-1">Deskripsi Pekerjaan</label>
                                    <input type="text" wire:model.live="items.{{ $index }}.deskripsi"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-green-500 focus:border-green-500"
                                        placeholder="Contoh: Pekerjaan Pondasi">
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">Volume</label>
                                        <input type="number" wire:model.live="items.{{ $index }}.volume"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-green-500 focus:border-green-500"
                                            step="0.01" min="0">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">Satuan</label>
                                        <select wire:model.live="items.{{ $index }}.satuan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-green-500 focus:border-green-500">
                                            <option value="unit">unit</option>
                                            <option value="m2">m²</option>
                                            <option value="m3">m³</option>
                                            <option value="meter">meter</option>
                                            <option value="kg">kg</option>
                                            <option value="set">set</option>
                                            <option value="ls">ls (lump sum)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">Harga/Satuan</label>
                                        <input type="number" wire:model.live="items.{{ $index }}.hargaSatuan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-green-500 focus:border-green-500"
                                            step="1000" min="0">
                                    </div>
                                </div>

                                <div class="text-right">
                                    <span class="text-xs text-gray-600">Subtotal:</span>
                                    <span class="font-bold text-green-700">
                                        Rp
                                        {{ number_format((float) ($item['volume'] ?? 1) * (float) ($item['hargaSatuan'] ?? 0), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <textarea wire:model.live="catatan" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                        placeholder="Catatan tambahan..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dibuat Oleh</label>
                        <input type="text" wire:model.live="namaPembuat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="Nama pembuat RAB">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Disetujui Oleh</label>
                        <input type="text" wire:model.live="namaPenyetuju"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                            placeholder="Nama penyetuju">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex space-x-3">
                <button onclick="window.print()"
                    class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition-colors duration-200 flex items-center justify-center">
                    <span class="mr-2">🖨️</span> Print
                </button>
                <button wire:click="generatePdf" wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-colors duration-200 flex items-center justify-center">
                    <span class="mr-2">📄</span>
                    <span wire:loading.remove wire:target="generatePdf">Export PDF</span>
                    <span wire:loading wire:target="generatePdf">Generating...</span>
                </button>
            </div>

            <!-- Info Box -->
            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800">
                <strong>💡 Tips:</strong> RAB digunakan untuk perencanaan anggaran proyek dengan rincian biaya per item.
            </div>
        </div>

        <!-- LIVE PREVIEW (KANAN) -->
        <div class="lg:sticky lg:top-6 lg:self-start">
            <div class="bg-white rounded-lg shadow-lg p-8" id="rab-preview">
                <div class="border-b-2 border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 text-center">RENCANA ANGGARAN BIAYA</h2>
                    <h3 class="text-xl font-semibold text-gray-800 text-center mt-2">{{ $namaProyek ?: 'NAMA PROYEK' }}
                    </h3>
                    <div class="mt-3 text-sm text-gray-600 space-y-1">
                        <div><strong>No. RAB:</strong> {{ $nomorRab }}</div>
                        <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($tanggalRab)->format('d F Y') }}</div>
                        @if ($lokasi)
                            <div><strong>Lokasi:</strong> {{ $lokasi }}</div>
                        @endif
                        @if ($namaPemilik)
                            <div><strong>Pemilik:</strong> {{ $namaPemilik }}</div>
                        @endif
                    </div>
                </div>

                <!-- Tabel Items -->
                <div class="mb-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b-2 border-gray-300">
                                <th class="text-left py-2 font-semibold">Uraian Pekerjaan</th>
                                <th class="text-center py-2 font-semibold w-16">Vol.</th>
                                <th class="text-center py-2 font-semibold w-16">Satuan</th>
                                <th class="text-right py-2 font-semibold w-24">Harga</th>
                                <th class="text-right py-2 font-semibold w-28">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr class="border-b border-gray-200">
                                    <td class="py-2">{{ $item['deskripsi'] ?: '-' }}</td>
                                    <td class="py-2 text-center">{{ $item['volume'] ?? 1 }}</td>
                                    <td class="py-2 text-center text-xs">{{ $item['satuan'] ?? 'unit' }}</td>
                                    <td class="py-2 text-right">Rp
                                        {{ number_format((float) ($item['hargaSatuan'] ?? 0), 0, ',', '.') }}</td>
                                    <td class="py-2 text-right font-semibold">
                                        Rp
                                        {{ number_format((float) ($item['volume'] ?? 1) * (float) ($item['hargaSatuan'] ?? 0), 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-900">
                                <td colspan="4" class="py-3 text-right font-bold">TOTAL ANGGARAN:</td>
                                <td class="py-3 text-right font-bold text-green-700 text-lg">
                                    Rp {{ number_format($this->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if ($catatan)
                    <div class="mb-6 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm">
                        <div class="font-semibold text-gray-700 mb-1">Catatan:</div>
                        <div class="text-gray-600">{{ $catatan }}</div>
                    </div>
                @endif

                <!-- Tanda Tangan -->
                @if ($namaPembuat || $namaPenyetuju)
                    <div class="grid grid-cols-2 gap-8 mt-8 text-sm text-center">
                        @if ($namaPembuat)
                            <div>
                                <div class="text-gray-600 mb-16">Dibuat Oleh,</div>
                                <div class="border-t border-gray-900 pt-2 font-semibold">{{ $namaPembuat }}</div>
                            </div>
                        @endif
                        @if ($namaPenyetuju)
                            <div>
                                <div class="text-gray-600 mb-16">Disetujui Oleh,</div>
                                <div class="border-t border-gray-900 pt-2 font-semibold">{{ $namaPenyetuju }}</div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Wire Loading Overlay -->
    <div wire:loading.flex wire:target="generatePdf"
        class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
            <p class="text-gray-700 font-medium">Generating PDF...</p>
        </div>
    </div>
</div>

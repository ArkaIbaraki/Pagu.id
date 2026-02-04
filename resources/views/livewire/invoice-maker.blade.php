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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- FORM INPUT (KIRI) -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">📝 Data Invoice</h2>

            <!-- Data Dasar -->
            <div class="space-y-4 mb-6">
                <!-- Header Style Option -->
                <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gaya Header Invoice</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" wire:model.live="headerStyle" value="nama" class="mr-2">
                            <span class="text-sm">Tampilkan Nama Usaha</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" wire:model.live="headerStyle" value="title" class="mr-2">
                            <span class="text-sm">Title "INVOICE" Saja</span>
                        </label>
                    </div>
                </div>

                <!-- Kop Perusahaan Option -->
                <div class="p-3 bg-purple-50 border border-purple-200 rounded-lg">
                    <label class="flex items-center cursor-pointer mb-2">
                        <input type="checkbox" wire:model.live="useKopPerusahaan" class="mr-2">
                        <span class="text-sm font-medium text-gray-700">Gunakan Logo/Kop Perusahaan</span>
                    </label>
                    @if ($useKopPerusahaan)
                        <div class="space-y-2">
                            <p class="text-xs text-gray-600">Konversi gambar ke Base64:</p>
                            <textarea wire:model.live="kopPerusahaan" rows="2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-xs font-mono resize-none"
                                placeholder="Paste base64 image (misal: data:image/png;base64,iVBORw0KGgo...)"></textarea>
                            <p class="text-xs text-gray-500">
                                💡 <a href="https://www.base64-image.de/" target="_blank"
                                    class="text-blue-600 hover:underline">Convert image to Base64 →</a>
                            </p>
                        </div>
                    @endif
                </div>

                @if ($headerStyle === 'nama')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Usaha / Pribadi *</label>
                        <input type="text" wire:model.live="namaUsaha"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="PT. Contoh Jaya / Budi Santoso">
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Invoice</label>
                        <div class="flex space-x-2">
                            <input type="text" wire:model.live="nomorInvoice"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <button wire:click="regenerateInvoiceNumber"
                                class="px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-sm whitespace-nowrap"
                                title="Generate nomor baru">
                                🔄
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" wire:model.live="tanggalInvoice"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima (Opsional)</label>
                    <input type="text" wire:model.live="namaPenerima"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nama klien / perusahaan">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat (Opsional)</label>
                    <textarea wire:model.live="alamat" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Alamat lengkap penerima"></textarea>
                </div>
            </div>

            <!-- Mode Item -->
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mode Item</label>
                <div class="space-y-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live="modeQuantity" value="1" class="mr-2">
                        <span class="text-sm">Dengan Quantity (Deskripsi, Qty, Harga, Subtotal)</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live="modeQuantity" value="0" class="mr-2">
                        <span class="text-sm">Tanpa Quantity (Deskripsi, Harga)</span>
                    </label>
                </div>
            </div>

            <!-- Items -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Item / Jasa</h3>
                    <button wire:click="addItem"
                        class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                        + Tambah Item
                    </button>
                </div>

                <div class="space-y-3">
                    @foreach ($items as $index => $item)
                        <div class="border border-gray-200 rounded-lg p-3 bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm font-medium text-gray-700">Item {{ $index + 1 }}</span>
                                @if (count($items) > 1)
                                    <button wire:click="removeItem({{ $index }})"
                                        class="text-red-600 hover:text-red-800 text-sm">
                                        ✕ Hapus
                                    </button>
                                @endif
                            </div>

                            <div class="space-y-2">
                                <input type="text" wire:model.live="items.{{ $index }}.deskripsi"
                                    class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                    placeholder="Deskripsi item / jasa">

                                @if ($modeQuantity)
                                    <div class="grid grid-cols-3 gap-2">
                                        <input type="number" wire:model.live="items.{{ $index }}.qty"
                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                            placeholder="Qty" min="1">
                                        <input type="number" wire:model.live="items.{{ $index }}.harga"
                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm col-span-2"
                                            placeholder="Harga satuan" min="0">
                                    </div>
                                @else
                                    <input type="number" wire:model.live="items.{{ $index }}.harga"
                                        class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                        placeholder="Harga" min="0">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Opsi Perhitungan -->
            <div class="mb-6 space-y-4">
                <!-- Diskon -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <label class="flex items-center cursor-pointer mb-3">
                        <input type="checkbox" wire:model.live="useDiskon" class="mr-2">
                        <span class="font-medium text-gray-700">Gunakan Diskon</span>
                    </label>

                    @if ($useDiskon)
                        <div class="space-y-2">
                            <div class="flex space-x-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="diskonTipe" value="nominal"
                                        class="mr-1">
                                    <span class="text-sm">Nominal</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="diskonTipe" value="persen"
                                        class="mr-1">
                                    <span class="text-sm">Persen</span>
                                </label>
                            </div>

                            @if ($diskonTipe === 'nominal')
                                <input type="number" wire:model.live="diskonNominal"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    placeholder="Jumlah diskon" min="0">
                            @else
                                <input type="number" wire:model.live="diskonPersen"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    placeholder="Persen diskon" min="0" max="100">
                            @endif
                        </div>
                    @endif
                </div>

                <!-- PPN -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="usePpn" class="mr-2">
                        <span class="font-medium text-gray-700">Tambah PPN 11%</span>
                    </label>
                </div>

                <!-- Terbilang -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="showTerbilang" class="mr-2">
                        <span class="font-medium text-gray-700">Tampilkan Terbilang</span>
                    </label>
                </div>
            </div>

            <!-- Footer -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <textarea wire:model.live="catatan" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Catatan tambahan..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penanda Tangan (Opsional)</label>
                    <input type="text" wire:model.live="namaTtd"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nama untuk tanda tangan">
                </div>
            </div>
        </div>

        <!-- LIVE PREVIEW (KANAN) -->
        <div class="lg:sticky lg:top-6 lg:self-start">
            <div class="bg-white rounded-lg shadow-lg p-8" id="invoice-preview">
                <!-- Header -->
                <div class="mb-6 pb-4 border-b-2 border-gray-300">
                    <!-- Logo/Kop Jika Ada -->
                    @if ($useKopPerusahaan && $kopPerusahaan)
                        <div class="mb-3">
                            <img src="{{ $kopPerusahaan }}" alt="Kop" class="h-16 object-contain">
                        </div>
                    @endif

                    @if ($headerStyle === 'title')
                        <h1 class="text-3xl font-bold text-center">INVOICE</h1>
                    @else
                        <h1 class="text-3xl font-bold text-center">{{ $namaUsaha ?: 'NAMA USAHA' }}</h1>
                    @endif
                </div>

                <!-- Header Info in Key-Value Format -->
                <div class="mb-6 text-sm border-b border-gray-300 pb-4">
                    <div class="flex justify-between mb-2">
                        <div>
                            <span class="font-semibold">Invoice No</span>
                            <span class="block text-gray-900">{{ $nomorInvoice }}</span>
                        </div>
                        <div class="text-right">
                            <span class="font-semibold">Tanggal</span>
                            <span
                                class="block text-gray-900">{{ \Carbon\Carbon::parse($tanggalInvoice)->format('d F Y') }}</span>
                        </div>
                    </div>
                    @if ($namaPenerima)
                        <div class="mb-2">
                            <span class="font-semibold">Pelanggan</span>
                            <span class="block text-gray-900">{{ $namaPenerima }}</span>
                        </div>
                    @endif
                    @if ($alamat)
                        <div>
                            <span class="font-semibold">Alamat</span>
                            <span class="block text-gray-900">{{ $alamat }}</span>
                        </div>
                    @endif
                </div>

                <!-- Tabel Items -->
                <div class="mb-4">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-900">
                                <th class="text-left py-2 px-2 font-bold w-12">No</th>
                                <th class="text-left py-2 px-2 font-bold">Keterangan</th>
                                @if ($modeQuantity)
                                    <th class="text-center py-2 px-2 font-bold w-16">Qty</th>
                                    <th class="text-right py-2 px-2 font-bold w-28">Harga</th>
                                @endif
                                <th class="text-right py-2 px-2 font-bold w-32">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $idx => $item)
                                <tr class="border-b border-gray-300">
                                    <td class="text-center py-2 px-2">{{ $idx + 1 }}</td>
                                    <td class="py-2 px-2">{{ $item['deskripsi'] ?: '-' }}</td>
                                    @if ($modeQuantity)
                                        <td class="text-center py-2 px-2">{{ $item['qty'] ?? 1 }}</td>
                                        <td class="text-right py-2 px-2">Rp
                                            {{ number_format((float) ($item['harga'] ?? 0), 0, ',', '.') }}</td>
                                    @endif
                                    <td class="text-right py-2 px-2">
                                        Rp
                                        {{ number_format(($modeQuantity ? (float) ($item['qty'] ?? 1) : 1) * (float) ($item['harga'] ?? 0), 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $modeQuantity ? 5 : 3 }}" class="py-4 text-center text-gray-400">
                                        Belum ada item</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Perhitungan Summary -->
                <div class="mb-4">
                    <table class="w-full text-sm border-collapse">
                        <tbody>
                            <tr class="border-b border-gray-300">
                                <td class="py-2 px-2" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                                <td class="text-right py-2 px-2 font-semibold">Subtotal</td>
                                <td class="text-right py-2 px-2 w-32">Rp
                                    {{ number_format($this->subtotal, 0, ',', '.') }}</td>
                            </tr>

                            @if ($useDiskon && $this->diskonValue > 0)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2 px-2" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                                    <td class="text-right py-2 px-2 font-semibold">Diskon</td>
                                    <td class="text-right py-2 px-2 w-32">Rp
                                        {{ number_format($this->diskonValue, 0, ',', '.') }}</td>
                                </tr>
                            @endif

                            @if ($usePpn)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2 px-2" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                                    <td class="text-right py-2 px-2 font-semibold">PPN 11%</td>
                                    <td class="text-right py-2 px-2 w-32">Rp
                                        {{ number_format($this->ppnValue, 0, ',', '.') }}</td>
                                </tr>
                            @endif

                            <tr class="border-t-2 border-b-2 border-gray-900">
                                <td class="py-2 px-2" colspan="{{ $modeQuantity ? 3 : 1 }}"></td>
                                <td class="text-right py-2 px-2 font-bold">Total</td>
                                <td class="text-right py-2 px-2 w-32 font-bold">Rp
                                    {{ number_format($this->total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if ($showTerbilang)
                    <div class="text-sm mb-6 border-t-2 border-gray-300 pt-2">
                        <span class="font-semibold">Terbilang :</span>
                        <span class="italic">{{ $this->totalTerbilang }}</span>
                    </div>
                @endif

                @if ($catatan)
                    <div class="mb-6 text-sm">
                        <div class="text-gray-600 font-medium mb-1">Catatan:</div>
                        <div class="text-gray-700">{{ $catatan }}</div>
                    </div>
                @endif

                @if ($namaTtd)
                    <div class="mt-8 text-right">
                        <div class="text-sm text-gray-600 mb-12">Hormat Saya,</div>
                        <div
                            class="text-sm font-semibold text-gray-900 border-t border-gray-400 inline-block px-4 pt-1">
                            {{ $namaTtd }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 flex space-x-3">
                <button onclick="window.print()"
                    class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors duration-200 flex items-center justify-center">
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
            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800">
                <strong>💡 Tips:</strong> Semua perubahan akan langsung terlihat di preview. Data tidak disimpan di
                server.
            </div>
        </div>
    </div>

    <!-- Wire Loading Overlay -->
    <div wire:loading.flex wire:target="generatePdf"
        class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-700 font-medium">Generating PDF...</p>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice-preview,
            #invoice-preview * {
                visibility: visible;
            }

            #invoice-preview {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</div>

# 📄 Invoice & RAB Maker - Indonesia

Sebuah web tool **tanpa login** untuk membuat Invoice & RAB yang disesuaikan dengan praktik umum di Indonesia. Bisa dipakai siapa saja secara langsung tanpa ribet desain atau template.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-4-FB70A9?logo=livewire)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?logo=tailwind-css)

---

## 📚 Dokumentasi

- 🚀 **[Quick Start Guide](QUICKSTART.md)** - Setup dalam 5 menit
- 📖 **[Technical Documentation](DOCUMENTATION.md)** - Struktur kode & arsitektur
- 🎓 **[Developer Onboarding](ONBOARDING.md)** - Guide untuk developer baru
- 🤝 **[Contributing Guidelines](CONTRIBUTING.md)** - Cara berkontribusi
- 📸 **[Screenshots & Features](SCREENSHOTS.md)** - Visual showcase
- 📝 **[Changelog](CHANGELOG.md)** - Version history & updates

---

## ✨ Fitur Utama

### 🎯 Tanpa Login & Dashboard
- ✅ Public tool yang langsung bisa dipakai
- ✅ Tidak perlu registrasi atau login
- ✅ Fokus pada invoice versi Indonesia

### 📝 Mode Item Fleksibel
User bisa memilih mode item sesuai kebutuhan:

**Mode Dengan Quantity:**
- Deskripsi
- Quantity
- Harga Satuan
- Subtotal (otomatis)

**Mode Tanpa Quantity:**
- Deskripsi
- Harga

### 📋 Data Invoice Indonesia
Field yang tersedia:
- ✅ Nama usaha / pribadi
- ✅ Nomor invoice (auto-generate)
- ✅ Tanggal invoice
- ✅ Nama penerima (opsional)
- ✅ Alamat (opsional)

### 🧮 Perhitungan Otomatis
- ✅ Subtotal semua item
- ✅ Diskon (nominal atau persen) - opsional
- ✅ PPN 11% - opsional
- ✅ Total akhir
- ✅ Semua update secara real-time

### 🇮🇩 Terbilang (Ciri Khas Indonesia!)
- ✅ Konversi angka ke kata-kata Indonesia
- ✅ Contoh: `1.500.000` → `Satu Juta Lima Ratus Ribu Rupiah`
- ✅ Toggle on/off
- ✅ Auto-generate, bukan input manual

### 👁️ Live Preview
- ✅ Preview invoice secara real-time
- ✅ Side-by-side dengan form input
- ✅ WYSIWYG - What You See Is What You Get

### 📤 Export & Print
- ✅ Print langsung dari browser
- ✅ Export ke PDF dengan format rapi
- ✅ Siap digunakan untuk dikirim ke klien

### 📝 Footer Invoice
- ✅ Total akhir
- ✅ Terbilang otomatis
- ✅ Catatan (opsional)
- ✅ Tanda tangan (opsional)

## 🛠️ Tech Stack

- **Laravel 12** - Backend framework
- **Livewire 4** - Reactive components
- **Blade** - Templating engine
- **Tailwind CSS** - Styling
- **DomPDF** - PDF generation

## 📦 Instalasi

### Requirement
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM

### Langkah-langkah

1. **Clone repository**
```bash
git clone <repository-url>
cd invoice-rab-maker
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Build assets**
```bash
npm run build
# atau untuk development
npm run dev
```

5. **Jalankan server**
```bash
php artisan serve
```

6. **Buka browser**
```
http://127.0.0.1:8000
```

## 🎮 Cara Pakai

1. **Isi data invoice**
   - Masukkan nama usaha/pribadi
   - Nomor invoice sudah ter-generate otomatis
   - Pilih tanggal
   - Isi data penerima (opsional)

2. **Pilih mode item**
   - Dengan Quantity: untuk barang/jasa yang ada jumlahnya
   - Tanpa Quantity: untuk jasa atau biaya flat

3. **Tambah item**
   - Klik tombol "Tambah Item"
   - Isi deskripsi dan harga
   - Bisa tambah atau hapus item sesuai kebutuhan

4. **Atur perhitungan**
   - Toggle diskon jika perlu (nominal atau persen)
   - Toggle PPN 11% jika perlu
   - Toggle terbilang (default: aktif)

5. **Preview & Export**
   - Lihat preview di sebelah kanan
   - Klik "Print" untuk print langsung
   - Klik "Export PDF" untuk download PDF

## 🔍 Struktur File Penting

```
app/
├── Helpers/
│   ├── Terbilang.php          # Helper konversi angka ke kata
│   └── helpers.php            # Global helper functions
└── Livewire/
    └── InvoiceMaker.php       # Main component

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php      # Main layout
    ├── livewire/
    │   └── invoice-maker.blade.php  # Main view
    └── pdf/
        └── invoice.blade.php  # PDF template
```

## 🎨 Customization

### Ubah Format Nomor Invoice

Edit file `app/Livewire/InvoiceMaker.php`:

```php
public function mount()
{
    // Ganti format sesuai kebutuhan
    $this->nomorInvoice = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
}
```

### Ubah Rate PPN

Saat ini hardcoded 11%. Untuk ubah, edit di:
- `app/Livewire/InvoiceMaker.php` (method `ppnValue()`)
- `resources/views/livewire/invoice-maker.blade.php` (label "PPN 11%")

### Ubah Styling PDF

Edit file `resources/views/pdf/invoice.blade.php` di bagian `<style>`.

## 🚀 Deployment

Untuk production:

```bash
# Build assets untuk production
npm run build

# Set APP_ENV ke production di .env
APP_ENV=production
APP_DEBUG=false

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📝 Scope & Batasan

### ✅ Yang Ada (MVP)
- Invoice maker tanpa login
- Format Indonesia
- Real-time calculation
- PDF export
- Print support
- Terbilang Indonesia

### ❌ Yang Tidak Ada (By Design)
- Sistem login/register
- Dashboard multi-user
- Multi-currency
- Database penyimpanan invoice
- API publik
- Template builder

> **Catatan:** Batasan di atas disengaja agar proyek fokus dan selesai. Fitur bisa ditambah nanti sesuai kebutuhan.

## 🤝 Contributing

Silakan fork dan kirim pull request. Semua kontribusi diterima dengan senang hati!

## 📄 License

Open source - MIT License

## 💡 Tips & Tricks

1. **Auto-fill untuk testing**: Buka browser console dan jalankan:
```javascript
// Isi semua field otomatis untuk testing
```

2. **Keyboard shortcuts**:
   - `Ctrl+P` - Print preview
   - `Tab` - Navigasi antar field

3. **Mobile friendly**: Layout responsive, bisa diakses dari HP

## 🐛 Troubleshooting

### PDF tidak ter-generate
```bash
php artisan config:clear
composer require barryvdh/laravel-dompdf
```

### Livewire tidak bekerja
```bash
composer require livewire/livewire
php artisan livewire:publish --assets
```

### Styling tidak muncul
```bash
npm run build
php artisan view:clear
```

## 📞 Support

Jika ada issue atau pertanyaan, silakan buat issue di repository ini.

---

**Dibuat dengan ❤️ untuk komunitas Indonesia**


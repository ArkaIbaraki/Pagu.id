# 📄 Pagu.id - Invoice & RAB Maker Indonesia

Sebuah web tool **tanpa login** untuk membuat Invoice & RAB (Rencana Anggaran Biaya) yang disesuaikan dengan praktik umum di Indonesia. Bisa dipakai siapa saja secara langsung tanpa ribet desain atau template.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-4-FB70A9?logo=livewire)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?logo=tailwind-css)

---

## 📚 Dokumentasi

- 🚀 **[Quick Start Guide](docs/QUICKSTART.md)** - Setup dalam 5 menit
- 📖 **[Technical Documentation](docs/DOCUMENTATION.md)** - Struktur kode & arsitektur
- 🎓 **[Developer Onboarding](docs/ONBOARDING.md)** - Guide untuk developer baru
- 🤝 **[Contributing Guidelines](docs/CONTRIBUTING.md)** - Cara berkontribusi
- 📸 **[Screenshots & Features](docs/SCREENSHOTS.md)** - Visual showcase
- 📝 **[Changelog](docs/CHANGELOG.md)** - Version history & updates
- 📋 **[Quick Reference](docs/QUICK_REFERENCE.md)** - Cheat sheet development

---

## ✨ Fitur Utama

### � Tanpa Login
Public tool yang langsung bisa dipakai tanpa registrasi. Data tidak disimpan di server (privacy-friendly).

### 📋 Invoice Maker
- **Header Customization**: Logo/kop perusahaan, pilihan gaya header
- **Mode Fleksibel**: Dengan/tanpa quantity sesuai kebutuhan
- **Auto-generate**: Nomor invoice otomatis (INV-YYYYMMDD-XXXX)
- **Perhitungan Real-time**: Subtotal, diskon (nominal/persen), PPN 11%, total akhir
- **Terbilang Indonesia**: Konversi angka ke kata (18.759.000 → "Delapan Belas Juta...")

### 📊 RAB Maker (Rencana Anggaran Biaya)
- **Volume-based calculations**: Volume × Harga Satuan dengan berbagai satuan
- **Header lengkap**: Nama proyek, nomor RAB, lokasi, pemilik
- **Footer profesional**: Total anggaran, nama pembuat & penyetuju

### 👁️ Live Preview & Export
- Preview real-time dengan layout side-by-side responsive
- Export ke PDF atau print langsung dari browser
- Format profesional siap kirim ke klien

> 📸 **Lihat detail lengkap & screenshot di [docs/SCREENSHOTS.md](docs/SCREENSHOTS.md)**

## 🛠️ Tech Stack

- **Laravel 12** - Backend framework
- **Livewire 4** - Reactive components (single-file pattern)
- **Blade** - Templating engine
- **Tailwind CSS 4.0** - Utility-first styling
- **DomPDF 3.1** - PDF generation
- **Vite 6.4** - Asset bundling & hot reload

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

**Pagu.id** - Dibuat dengan ❤️ untuk komunitas Indonesia


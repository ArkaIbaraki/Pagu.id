# 🚀 Quick Start Guide

## Installation dalam 5 Menit

### 1️⃣ Install Dependencies
```bash
composer install
npm install
```

### 2️⃣ Setup Environment
```bash
# Copy .env (jika belum ada)
cp .env.example .env

# Generate app key
php artisan key:generate
```

### 3️⃣ Build & Run
```bash
# Build assets
npm run build

# Start server
php artisan serve
```

### 4️⃣ Buka Browser
```
http://127.0.0.1:8000
```

---

## 🎯 Fitur yang Bisa Langsung Dicoba

1. **Auto-generate Invoice Number**
   - Nomor invoice otomatis ter-generate
   - Bisa di-refresh dengan tombol 🔄

2. **Mode Item Fleksibel**
   - Dengan Qty: Cocok untuk barang
   - Tanpa Qty: Cocok untuk jasa

3. **Perhitungan Real-time**
   - Ubah harga → total langsung update
   - Tambah diskon → total otomatis terhitung
   - Toggle PPN → langsung ditambahkan

4. **Terbilang Indonesia** 🇮🇩
   - Angka otomatis jadi kata-kata
   - Contoh: 1500000 → "Satu Juta Lima Ratus Ribu Rupiah"

5. **Export & Print**
   - Print: Langsung dari browser (Ctrl+P)
   - PDF: Download file PDF siap kirim

---

## 💡 Tips & Tricks

### Testing Cepat
1. Buka aplikasi
2. Nama usaha sudah ter-isi "NAMA USAHA"
3. Ada 1 item default
4. Langsung bisa tambah item
5. Live preview di kanan

### Keyboard Shortcuts
- `Ctrl + P` → Print preview
- `Tab` → Navigasi antar field
- `Enter` di item terakhir → (bisa di-improve untuk auto-add item)

### Contoh Use Case

**Invoice Jasa Konsultan:**
```
Mode: Tanpa Quantity
Item 1: Konsultasi Sistem - Rp 5.000.000
Item 2: Analisis Kebutuhan - Rp 3.000.000
Total: Rp 8.000.000
Terbilang: Delapan Juta Rupiah
```

**Invoice Penjualan Barang:**
```
Mode: Dengan Quantity
Item 1: Laptop ASUS - 2 unit @ Rp 10.000.000
Item 2: Mouse Wireless - 5 unit @ Rp 150.000
Diskon: 5%
PPN: 11%
Total: Rp 21.145.125
```

---

## 🔧 Development Mode

Untuk development dengan hot reload:

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server
npm run dev
```

Akses di `http://127.0.0.1:8000` dan perubahan CSS/JS langsung reload.

---

## ❓ Common Issues

### Assets tidak load
```bash
npm run build
php artisan view:clear
```

### Livewire error
```bash
php artisan livewire:publish --assets
composer dump-autoload
```

### PDF error
```bash
php artisan config:clear
composer require barryvdh/laravel-dompdf
```

---

## 📱 Mobile Access

Aplikasi responsive, bisa diakses dari HP:
1. Jalankan `php artisan serve --host=0.0.0.0`
2. Akses dari HP: `http://<IP-KOMPUTER-KAMU>:8000`
3. Contoh: `http://192.168.1.100:8000`

---

## 🎨 Customization

### Ubah Format Nomor Invoice
File: `app/Livewire/InvoiceMaker.php`
```php
$this->nomorInvoice = 'CUSTOM-' . date('Ymd') . '-001';
```

### Ubah PPN (dari 11% ke lain)
File: `app/Livewire/InvoiceMaker.php`
```php
return ($this->afterDiskon * 12) / 100; // Ganti 11 jadi 12
```

### Tambah Field Baru
1. Tambah property di `InvoiceMaker.php`
2. Tambah input di `invoice-maker.blade.php`
3. Tambah di `pdf/invoice.blade.php`

---

Selamat mencoba! 🎉

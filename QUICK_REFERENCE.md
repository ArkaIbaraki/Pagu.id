# 📋 Quick Reference

Cheat sheet untuk development Invoice & RAB Maker.

## 🚀 Common Commands

```bash
# Development
php artisan serve          # Start dev server (http://127.0.0.1:8000)
npm run dev               # Start Vite dev server (hot reload)
npm run build             # Build assets for production

# Testing
php artisan test          # Run all tests
php artisan test --filter=TerbilangTest  # Run specific test

# Cache
php artisan cache:clear   # Clear application cache
php artisan config:clear  # Clear config cache
php artisan view:clear    # Clear compiled views

# Livewire
php artisan livewire:make ComponentName  # Create new component
```

## 🗂️ Project Structure

```
invoice-rab-maker/
├── app/
│   ├── Helpers/
│   │   └── Terbilang.php          # Number to words conversion
│   └── Livewire/
│       ├── InvoiceMaker.php       # Invoice component
│       └── RabMaker.php           # RAB component
├── resources/
│   ├── views/
│   │   ├── home.blade.php         # Landing page
│   │   ├── layouts/
│   │   │   └── app.blade.php      # Main layout with navbar
│   │   ├── livewire/
│   │   │   ├── invoice-maker.blade.php  # Invoice view
│   │   │   └── rab-maker.blade.php      # RAB view
│   │   └── pdf/
│   │       ├── invoice.blade.php  # Invoice PDF template
│   │       └── rab.blade.php      # RAB PDF template
│   ├── css/
│   │   └── app.css                # Tailwind CSS
│   └── js/
│       └── app.js                 # Frontend JS
├── routes/
│   └── web.php                    # Routes: /, /invoice, /rab
├── tests/
│   └── Unit/
│       └── TerbilangTest.php      # Terbilang unit tests
└── public/
    └── build/                     # Compiled assets
```

## 🎯 Routes

| URL | Component | Purpose |
|-----|-----------|---------|
| `/` | home.blade.php | Landing page dengan selection |
| `/invoice` | InvoiceMaker | Invoice maker tool |
| `/rab` | RabMaker | RAB maker tool |

## 🔧 Livewire Components

### InvoiceMaker (`app/Livewire/InvoiceMaker.php`)

**Key Properties:**
```php
$headerStyle = 'nama'          // 'nama' or 'title'
$useKopPerusahaan = false      // Logo toggle
$kopPerusahaan = ''            // Base64 image
$modeQuantity = true           // Item mode
$items = []                    // Items array
```

**Key Methods:**
```php
mount()                        // Initialize
regenerateInvoiceNumber()      // New number
addItem() / removeItem($index) // Item management
generatePdf()                  // PDF export
```

**Computed:**
```php
subtotal(), diskonValue(), ppnValue(), total(), totalTerbilang()
```

### RabMaker (`app/Livewire/RabMaker.php`)

**Key Properties:**
```php
$namaProyek, $nomorRab, $tanggalRab
$items = []  // ['deskripsi', 'volume', 'satuan', 'hargaSatuan']
```

**Computed:**
```php
total()  // Sum of (volume × hargaSatuan)
```

## 🎨 Common Tailwind Patterns

```html
<!-- Button Primary -->
<button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

<!-- Input Field -->
<input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">

<!-- 2-Column Grid (responsive) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
```

## 🔢 Terbilang Helper

```php
use App\Helpers\Terbilang;

$words = Terbilang::convert(18759000);
// "Delapan Belas Juta Tujuh Ratus Lima Puluh Sembilan Ribu Rupiah"
```

## 📊 PDF Generation

```php
use Barryvdh\DomPDF\Facade\Pdf;

$pdf = Pdf::loadView('pdf.invoice', $data);
$filename = 'invoice-' . str_replace(['/', '\\'], '-', $this->nomorInvoice) . '.pdf';

return response()->streamDownload(fn() => echo $pdf->output(), $filename);
```

**PDF Tips:**
- Use inline styles only
- Base64 images for logos
- Cast strings to float: `(float)$value`

## 🐛 Common Fixes

```bash
# Livewire not updating
php artisan view:clear && php artisan serve

# Assets not loading
npm run build

# Type errors in calculations
(float)($item['qty'] ?? 1) * (float)($item['harga'] ?? 0)
```

## 📱 Responsive Breakpoints

```
lg: 1024px    ← Main breakpoint (desktop)
```

---

*Last Updated: February 4, 2026*

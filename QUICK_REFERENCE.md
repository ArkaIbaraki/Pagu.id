# 📋 Quick Reference Card

Cheat sheet untuk developer. Simpan untuk referensi cepat!

---

## ⚡ Quick Commands

```bash
# Development
composer install          # Install PHP dependencies
npm install              # Install Node dependencies
npm run dev              # Start Vite dev server (hot reload)
npm run build            # Build for production
php artisan serve        # Start Laravel server

# Testing
php artisan test         # Run all tests
php artisan test --filter=TerbilangTest  # Run specific test

# Maintenance
php artisan config:clear # Clear config cache
php artisan view:clear   # Clear view cache
php artisan route:clear  # Clear route cache
composer dump-autoload   # Reload autoloader
```

---

## 📂 Key Files

```
app/
├── Livewire/InvoiceMaker.php          # Main component (200 lines)
└── Helpers/Terbilang.php              # Number to words (70 lines)

resources/views/
├── layouts/app.blade.php               # Base layout (40 lines)
├── livewire/invoice-maker.blade.php    # Main view (300 lines)
└── pdf/invoice.blade.php               # PDF template (150 lines)

routes/web.php                          # Single route (5 lines)
```

---

## 🎨 Livewire Directives

```blade
{{-- Data Binding --}}
wire:model="property"           {{-- Sync on blur --}}
wire:model.live="property"      {{-- Real-time sync --}}
wire:model.lazy="property"      {{-- On change --}}

{{-- Actions --}}
wire:click="method"             {{-- On click --}}
wire:click="method($index)"     {{-- With parameter --}}

{{-- Loading States --}}
wire:loading                    {{-- Show when loading --}}
wire:loading.remove             {{-- Hide when loading --}}
wire:target="method"            {{-- Specific method --}}

{{-- Computed Properties --}}
{{ $this->subtotal }}           {{-- Call computed --}}
{{ $this->total }}              {{-- Auto-cached --}}
```

---

## 🔢 Terbilang Usage

```php
// In Component
use App\Helpers\Terbilang;
$words = Terbilang::rupiah(1500000);
// Output: "Satu Juta Lima Ratus Ribu Rupiah"

// Helper Function
$words = terbilang(1500000);
// Output: "Satu Juta Lima Ratus Ribu Rupiah"
```

---

## 🎯 Component Structure

```php
class InvoiceMaker extends Component
{
    // Properties (State)
    public $namaUsaha = '';
    public $items = [];
    
    // Methods (Actions)
    public function addItem() { }
    public function removeItem($index) { }
    
    // Computed (Calculations)
    #[Computed]
    public function total() {
        return $this->subtotal + $this->ppnValue;
    }
    
    // Lifecycle
    public function mount() { }
    public function render() {
        return view('livewire.invoice-maker');
    }
}
```

---

## 🎨 Tailwind Common Classes

```blade
{{-- Layout --}}
grid grid-cols-2 gap-6               {{-- 2 column grid --}}
flex items-center justify-between    {{-- Flexbox --}}

{{-- Spacing --}}
p-6                                  {{-- Padding all sides --}}
px-4 py-2                            {{-- Padding x & y --}}
space-x-3                            {{-- Gap between children --}}

{{-- Colors --}}
bg-blue-600 text-white               {{-- Background & text --}}
border border-gray-300               {{-- Border --}}

{{-- Effects --}}
rounded-lg shadow-lg                 {{-- Rounded & shadow --}}
hover:bg-blue-700                    {{-- Hover state --}}

{{-- Responsive --}}
lg:grid-cols-2                       {{-- Large screen only --}}
sm:px-6                              {{-- Small screen & up --}}
```

---

## 🔧 Common Tasks

### Add New Field
```php
// 1. InvoiceMaker.php
public $myField = '';

// 2. View (Form)
<input wire:model.live="myField">

// 3. View (Preview)
<div>{{ $myField }}</div>

// 4. PDF
<div>{{ $myField }}</div>
```

### Add Computed Property
```php
#[Computed]
public function myCalculation()
{
    return $this->subtotal * 0.1;
}

// In view
{{ $this->myCalculation }}
```

### Add Validation
```php
public function generatePdf()
{
    if (empty($this->namaUsaha)) {
        session()->flash('error', 'Field required!');
        return;
    }
    // Continue...
}
```

---

## 🐛 Debugging

```blade
{{-- View State --}}
<pre>{{ json_encode($items, JSON_PRETTY_PRINT) }}</pre>

{{-- Check Computed --}}
<div>Total: {{ $this->total }}</div>

{{-- Livewire Debug --}}
@dump($this->all())
```

```bash
# Logs
tail -f storage/logs/laravel.log

# Clear Everything
php artisan optimize:clear
```

---

## 📊 Calculation Flow

```
Items Input
    ↓
Subtotal = sum(items)
    ↓
Discount = nominal OR (subtotal * percent / 100)
    ↓
After Discount = subtotal - discount
    ↓
PPN = after_discount * 11 / 100
    ↓
Total = after_discount + ppn
    ↓
Terbilang = convert(total)
```

---

## 🎯 File Locations

```
Add item logic:          app/Livewire/InvoiceMaker.php::addItem()
Remove item logic:       app/Livewire/InvoiceMaker.php::removeItem()
Calculation logic:       app/Livewire/InvoiceMaker.php::computed methods
Terbilang logic:         app/Helpers/Terbilang.php::convert()
Form HTML:               resources/views/livewire/invoice-maker.blade.php (lines 1-150)
Preview HTML:            resources/views/livewire/invoice-maker.blade.php (lines 150-300)
PDF template:            resources/views/pdf/invoice.blade.php
PDF generation:          app/Livewire/InvoiceMaker.php::generatePdf()
```

---

## 🚀 Deployment

```bash
# Production Build
npm run build
composer install --optimize-autoloader --no-dev

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Environment
APP_ENV=production
APP_DEBUG=false
```

---

## 📱 Responsive Breakpoints

```
sm:   640px+   (tablet)
md:   768px+   (small desktop)
lg:   1024px+  (desktop)
xl:   1280px+  (large desktop)
2xl:  1536px+  (extra large)

Default: < 640px (mobile)
```

---

## 🎨 Component Props (InvoiceMaker)

```php
// Data Invoice
$namaUsaha         string   Company name
$nomorInvoice      string   Auto-generated
$tanggalInvoice    date     Invoice date
$namaPenerima      string   Recipient (optional)
$alamat            string   Address (optional)

// Options
$modeQuantity      bool     true = with qty, false = without
$useDiskon         bool     Enable discount
$usePpn            bool     Enable PPN 11%
$showTerbilang     bool     Show terbilang

// Discount
$diskonTipe        string   'nominal' | 'persen'
$diskonNominal     int      Nominal amount
$diskonPersen      int      Percentage

// Items
$items             array    [['deskripsi', 'qty', 'harga'], ...]

// Footer
$catatan           string   Notes (optional)
$namaTtd           string   Signature name (optional)
```

---

## 🧪 Testing

```bash
# Run All Tests
php artisan test

# Run Specific Test
php artisan test --filter=TerbilangTest

# With Coverage (if configured)
php artisan test --coverage
```

---

## 📦 Dependencies

```json
// composer.json
"laravel/framework": "^12.0"
"livewire/livewire": "^4.1"
"barryvdh/laravel-dompdf": "^3.1"

// package.json
"laravel-vite-plugin": "^1.0"
"vite": "^6.0"
"tailwindcss": "^4.0"
```

---

## 🎯 URLs

```
Homepage:         http://127.0.0.1:8000/
Livewire Assets:  /livewire-*/livewire.js (auto)
Compiled CSS:     /build/assets/app-*.css
Compiled JS:      /build/assets/app-*.js
```

---

## 💡 Pro Tips

```
1. Always use wire:model.live for instant updates
2. Computed properties are cached - use them!
3. Test in browser console: Livewire.find('component-id')
4. npm run dev for hot reload during development
5. Clear cache if something weird: php artisan optimize:clear
6. Browser devtools → Network → See Livewire AJAX calls
7. Use @dump() in blade for quick debugging
8. Keep InvoiceMaker.php under 300 lines
9. Extract complex logic to helper classes
10. Write tests for critical calculations
```

---

## 🆘 Emergency Commands

```bash
# Everything is broken
php artisan optimize:clear
composer dump-autoload
npm run build
php artisan serve

# Livewire not working
php artisan livewire:publish --assets
php artisan view:clear

# PDF not generating
composer require barryvdh/laravel-dompdf
php artisan config:clear

# Assets not loading
npm run build
php artisan view:clear
```

---

## 📚 Documentation Links

- [README](README.md) - Main docs
- [QUICKSTART](QUICKSTART.md) - Setup guide
- [DOCUMENTATION](DOCUMENTATION.md) - Technical docs
- [ONBOARDING](ONBOARDING.md) - Developer guide
- [CONTRIBUTING](CONTRIBUTING.md) - How to contribute

---

**Print this card or bookmark it!** 🔖

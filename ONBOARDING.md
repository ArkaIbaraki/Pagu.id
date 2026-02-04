# 🚀 Developer Onboarding

Welcome! Guide ini akan membantu Anda familiar dengan codebase dalam waktu singkat.

## 📁 Project Overview

**Invoice & RAB Maker** adalah web tool untuk membuat invoice versi Indonesia tanpa perlu login. Built with Laravel 12 + Livewire 4.

**Goal:** Membuat invoice dalam < 3 menit dengan format yang rapi dan profesional.

## 🎯 Quick Navigation

- **Want to run the app?** → See [QUICKSTART.md](QUICKSTART.md)
- **Want to understand the code?** → See [DOCUMENTATION.md](DOCUMENTATION.md)
- **Want to contribute?** → See [CONTRIBUTING.md](CONTRIBUTING.md)
- **Want to see changes?** → See [CHANGELOG.md](CHANGELOG.md)

## 🏗️ Architecture Overview

```
┌─────────────────────────────────────────┐
│           USER (Browser)                │
└────────────────┬────────────────────────┘
                 │
                 ↓
┌─────────────────────────────────────────┐
│         Livewire Component              │
│                                         │
│  ┌───────────────────────────────────┐ │
│  │ InvoiceMaker.php                  │ │
│  │  • Properties (data)              │ │
│  │  • Methods (actions)              │ │
│  │  • Computed (calculations)        │ │
│  └───────────────────────────────────┘ │
└────────────────┬────────────────────────┘
                 │
                 ↓
┌─────────────────────────────────────────┐
│              Views                      │
│                                         │
│  ┌──────────────┐  ┌─────────────────┐ │
│  │ Form Input   │  │  Live Preview   │ │
│  │ (Left Side)  │  │  (Right Side)   │ │
│  └──────────────┘  └─────────────────┘ │
│                                         │
│  ┌─────────────────────────────────┐   │
│  │     PDF Template                │   │
│  │     (For Export)                │   │
│  └─────────────────────────────────┘   │
└─────────────────────────────────────────┘
                 │
                 ↓
┌─────────────────────────────────────────┐
│            Helpers                      │
│                                         │
│  • Terbilang (Number to Words)         │
│  • (More helpers as needed)            │
└─────────────────────────────────────────┘
```

## 🔑 Key Files to Know

### Core Application
1. **`app/Livewire/InvoiceMaker.php`** (200 lines)
   - Main component
   - All business logic here
   - Start here to understand flow

2. **`resources/views/livewire/invoice-maker.blade.php`** (300 lines)
   - Main view
   - Form + Preview
   - All UI elements

3. **`app/Helpers/Terbilang.php`** (70 lines)
   - Indonesian number-to-words
   - Recursive algorithm
   - Used for "terbilang" feature

### Supporting Files
4. **`resources/views/layouts/app.blade.php`** (40 lines)
   - Base layout
   - Header, footer, meta tags

5. **`resources/views/pdf/invoice.blade.php`** (150 lines)
   - PDF template
   - Inline styles for PDF

6. **`routes/web.php`** (5 lines)
   - Single route to InvoiceMaker

## 🎓 Understanding the Data Flow

### 1. User Types in Form
```
User Input
    ↓
wire:model.live="namaUsaha"
    ↓
InvoiceMaker->namaUsaha property updated
    ↓
View automatically re-renders
    ↓
Preview shows new value
```

**Time:** Instant (debounced ~150ms)

### 2. Calculation Flow
```
User changes item price
    ↓
wire:model.live="items.0.harga"
    ↓
Property updated
    ↓
Computed property recalculates
    • subtotal()
    • diskonValue()
    • afterDiskon()
    • ppnValue()
    • total()
    • totalTerbilang()
    ↓
View shows updated totals
```

**Note:** Computed properties are cached!

### 3. PDF Generation
```
User clicks "Export PDF"
    ↓
wire:click="generatePdf"
    ↓
InvoiceMaker->generatePdf() called
    ↓
Validation
    ↓
Prepare data array
    ↓
Load PDF view with data
    ↓
DomPDF generates PDF
    ↓
Stream download to browser
```

**Time:** ~2-5 seconds

## 🧩 Component Breakdown

### InvoiceMaker Component

**Properties (State):**
```php
// User Input
$namaUsaha        // string
$nomorInvoice     // string (auto-gen)
$tanggalInvoice   // date
$namaPenerima     // string
$alamat           // string

// Options
$modeQuantity     // boolean
$useDiskon        // boolean
$usePpn           // boolean
$showTerbilang    // boolean

// Items
$items = [
    [
        'deskripsi' => '',
        'qty' => 1,
        'harga' => 0
    ]
]
```

**Methods (Actions):**
```php
mount()                    // Initialize
addItem()                  // Add item to array
removeItem($index)         // Remove item
regenerateInvoiceNumber()  // New invoice number
generatePdf()              // Export to PDF
```

**Computed Properties (Calculations):**
```php
subtotal()       // Sum of all items
diskonValue()    // Discount amount
afterDiskon()    // After discount
ppnValue()       // PPN 11%
total()          // Final total
totalTerbilang() // Indonesian words
```

## 💡 Common Tasks

### Task 1: Add New Input Field

**Steps:**
1. Add property to component
2. Add input in view
3. Add to preview
4. Add to PDF template

**Example: Add "NPWP" field**

```php
// 1. InvoiceMaker.php
public $npwp = '';

// 2. invoice-maker.blade.php (form)
<input type="text" wire:model.live="npwp" placeholder="NPWP">

// 3. invoice-maker.blade.php (preview)
<div>NPWP: {{ $npwp }}</div>

// 4. pdf/invoice.blade.php
<div>NPWP: {{ $npwp }}</div>
```

### Task 2: Change Calculation Logic

**Example: Change PPN from 11% to 12%**

```php
// InvoiceMaker.php
#[Computed]
public function ppnValue()
{
    if (!$this->usePpn) {
        return 0;
    }
    
    // Change 11 to 12
    return ($this->afterDiskon * 12) / 100;
}

// Also update label in views
// "PPN 11%" → "PPN 12%"
```

### Task 3: Add Validation

```php
// InvoiceMaker.php
public function generatePdf()
{
    // Add validation
    if (empty($this->namaUsaha)) {
        session()->flash('error', 'Nama usaha harus diisi!');
        return;
    }
    
    // Rest of code...
}
```

## 🔍 Debugging Tips

### View Livewire State
```blade
{{-- Add to view for debugging --}}
<pre>{{ json_encode($items, JSON_PRETTY_PRINT) }}</pre>
```

### Check Computed Values
```blade
{{-- See what computed returns --}}
<div>Subtotal: {{ $this->subtotal }}</div>
<div>Total: {{ $this->total }}</div>
```

### Laravel Logs
```bash
tail -f storage/logs/laravel.log
```

### Browser Console
- Check for Livewire errors
- Network tab for AJAX calls
- Console for JS errors

## 🧪 Testing Checklist

Before committing:
- [ ] Add item → preview updates?
- [ ] Remove item → preview updates?
- [ ] Change mode → layout changes?
- [ ] Toggle diskon → total changes?
- [ ] Toggle PPN → total changes?
- [ ] Terbilang shows correctly?
- [ ] PDF generates?
- [ ] Print works?
- [ ] Mobile responsive?
- [ ] No console errors?

## 🎨 Styling Guidelines

### Tailwind Classes
```blade
{{-- Form Input --}}
<input class="w-full px-3 py-2 border border-gray-300 rounded-md">

{{-- Button Primary --}}
<button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

{{-- Card --}}
<div class="bg-white rounded-lg shadow-lg p-6">
```

### Responsive
```blade
{{-- Mobile first --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- 1 col on mobile, 2 cols on large screen --}}
</div>
```

## 🚨 Common Pitfalls

### ❌ Don't Do This:
```blade
{{-- Calling method without $this --}}
{{ total() }}  <!-- WRONG -->

{{-- Modifying computed in view --}}
{{ $this->total = 100 }}  <!-- WRONG -->

{{-- Using wrong wire directive --}}
wire:model="name"  <!-- Missing .live for instant update -->
```

### ✅ Do This:
```blade
{{-- Proper computed call --}}
{{ $this->total }}  <!-- CORRECT -->

{{-- Computed are read-only --}}
<!-- They auto-update based on dependencies -->

{{-- Live update --}}
wire:model.live="name"  <!-- CORRECT -->
```

## 📚 Learning Resources

### Laravel
- [Laravel Docs](https://laravel.com/docs)
- [Laracasts](https://laracasts.com)

### Livewire
- [Livewire Docs](https://livewire.laravel.com)
- [Livewire Tips](https://livewire-tips.com)

### Tailwind
- [Tailwind Docs](https://tailwindcss.com/docs)
- [Tailwind UI](https://tailwindui.com)

## 🎯 Next Steps

1. **Run the app** - Follow QUICKSTART.md
2. **Make small change** - Change button color
3. **Add console.log** - See data flow
4. **Read InvoiceMaker.php** - Understand logic
5. **Try adding field** - NPWP or Phone
6. **Contribute!** - See CONTRIBUTING.md

## 💬 Getting Help

Stuck? Try:
1. Check DOCUMENTATION.md
2. Read code comments
3. Check Laravel/Livewire docs
4. Open an issue
5. Ask in discussions

## 🎉 Welcome Aboard!

You're now ready to contribute to Invoice & RAB Maker!

**First Issue Ideas:**
- Add favicon
- Improve mobile layout
- Add tooltips
- Improve error messages
- Add keyboard shortcuts

Happy coding! 🚀

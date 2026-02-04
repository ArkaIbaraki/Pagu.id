# 📚 Dokumentasi Kode

## Struktur Project

```
pagu.id/
├── app/
│   ├── Helpers/
│   │   ├── Terbilang.php          # Class konversi angka ke kata
│   │   └── helpers.php            # Helper function global
│   └── Livewire/
│       └── InvoiceMaker.php       # Main component
├── resources/
│   ├── css/
│   │   └── app.css                # Tailwind config
│   ├── js/
│   │   └── app.js                 # Alpine.js config
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php      # Main layout
│       ├── livewire/
│       │   └── invoice-maker.blade.php  # Main view
│       └── pdf/
│           └── invoice.blade.php  # PDF template
└── routes/
    └── web.php                    # Routes
```

---

## Component Structure

### InvoiceMaker.php

**Properties:**
```php
// Data Invoice
public $namaUsaha         // Nama usaha/pribadi
public $nomorInvoice      // Auto-generated
public $tanggalInvoice    // Date picker
public $namaPenerima      // Optional
public $alamat            // Optional

// Mode & Opsi
public $modeQuantity      // true/false
public $useDiskon         // Checkbox
public $usePpn            // Checkbox
public $showTerbilang     // Checkbox

// Diskon
public $diskonTipe        // 'nominal' / 'persen'
public $diskonNominal     // Numeric
public $diskonPersen      // Numeric

// Items
public $items = []        // Array of items

// Footer
public $catatan           // Textarea
public $namaTtd           // Text
```

**Methods:**
- `mount()` - Initialize component
- `regenerateInvoiceNumber()` - Generate new invoice number
- `addItem()` - Add new item to array
- `removeItem($index)` - Remove item from array
- `generatePdf()` - Export to PDF

**Computed Properties:**
- `subtotal()` - Calculate total from all items
- `diskonValue()` - Calculate discount amount
- `afterDiskon()` - Subtotal - discount
- `ppnValue()` - Calculate PPN 11%
- `total()` - Final total
- `totalTerbilang()` - Convert to Indonesian words

---

## Helper: Terbilang

### Usage
```php
use App\Helpers\Terbilang;

// Method 1: Using class
$result = Terbilang::rupiah(1500000);
// Output: "Satu Juta Lima Ratus Ribu Rupiah"

// Method 2: Using helper function
$result = terbilang(1500000);
// Output: "Satu Juta Lima Ratus Ribu Rupiah"
```

### Algorithm
Konversi dilakukan secara rekursif:
1. Handle angka negatif
2. Handle 0-11 (base case)
3. Handle belasan (12-19)
4. Handle puluhan (20-99)
5. Handle ratusan (100-999)
6. Handle ribuan, jutaan, miliaran, triliunan

---

## View Structure

### invoice-maker.blade.php

**Layout:**
```
┌─────────────────────────┬─────────────────────────┐
│     FORM INPUT          │     LIVE PREVIEW        │
│                         │                         │
│  - Data Invoice         │  - Header Invoice       │
│  - Mode Item            │  - Tabel Items          │
│  - Items                │  - Perhitungan          │
│  - Opsi Diskon/PPN      │  - Terbilang            │
│  - Footer               │  - Footer               │
└─────────────────────────┴─────────────────────────┘
│           ACTION BUTTONS (Print & PDF)            │
└───────────────────────────────────────────────────┘
```

**Responsive:**
- Desktop: 2 kolom side-by-side
- Mobile: 1 kolom stack (form di atas, preview di bawah)

---

## PDF Template

### invoice.blade.php

**Structure:**
```html
<style>
  /* Inline CSS untuk PDF */
</style>

<div class="header">
  <!-- Nama Usaha, No Invoice, Tanggal -->
</div>

<div class="kepada">
  <!-- Data Penerima -->
</div>

<table>
  <!-- Items Table -->
</table>

<div class="calculations">
  <!-- Subtotal, Diskon, PPN, Total -->
</div>

<div class="terbilang">
  <!-- Terbilang -->
</div>

<div class="signature">
  <!-- Tanda Tangan -->
</div>
```

**Font:** Arial (standard, work everywhere)
**Size:** A4 (default)

---

## Livewire Wire Directives

### Used in Project

**`wire:model.live`**
- Real-time data binding
- Update preview instantly
- Used for: inputs, selects, checkboxes

**`wire:click`**
- Handle button clicks
- Used for: addItem, removeItem, generatePdf

**`wire:loading`**
- Show loading state
- Used for: PDF generation overlay

**`wire:target`**
- Specify which action to track
- Used with wire:loading

---

## Tailwind Classes Used

### Layout
- `grid` + `grid-cols-*` - Grid layout
- `flex` - Flexbox
- `space-x-*` / `space-y-*` - Spacing
- `gap-*` - Grid gap

### Components
- `rounded-lg` - Border radius
- `shadow-lg` - Box shadow
- `border` + `border-*` - Borders
- `bg-*` - Background colors

### Typography
- `text-*` - Font sizes
- `font-*` - Font weights
- `text-*-*` - Text colors

### Responsive
- `lg:*` - Large screen (1024px+)
- `sm:*` - Small screen (640px+)

---

## Workflow

### User Flow
```
1. Load page
   ↓
2. Auto-generate invoice number
   ↓
3. Fill form (reactive)
   ↓
4. See live preview (right side)
   ↓
5. Click Print or Export PDF
   ↓
6. Get invoice
```

### Data Flow
```
View (Input)
   ↓ wire:model.live
Component (Properties)
   ↓ Computed
Calculations
   ↓
View (Preview)
```

### PDF Generation Flow
```
Click Export PDF
   ↓
Validate data
   ↓
Prepare data array
   ↓
Load PDF view
   ↓
Generate PDF (DomPDF)
   ↓
Stream download
```

---

## Extensibility

### Add New Field

1. **Component** (`InvoiceMaker.php`):
```php
public $namaField = '';
```

2. **View** (`invoice-maker.blade.php`):
```blade
<input type="text" wire:model.live="namaField">

<!-- Preview -->
<div>{{ $namaField }}</div>
```

3. **PDF** (`pdf/invoice.blade.php`):
```html
<div>{{ $namaField }}</div>
```

### Add New Calculation

1. **Component**:
```php
#[Computed]
public function myCalculation()
{
    return $this->subtotal * 0.1;
}
```

2. **View**:
```blade
{{ $this->myCalculation }}
```

### Add New Helper

1. **Create helper** (`app/Helpers/MyHelper.php`):
```php
class MyHelper {
    public static function myMethod() {
        // logic
    }
}
```

2. **Register** (`app/Helpers/helpers.php`):
```php
function myHelper() {
    return MyHelper::myMethod();
}
```

---

## Performance Notes

### Optimization
- ✅ Computed properties cached
- ✅ `wire:model.live` efficient (debounced)
- ✅ Assets minified in production
- ✅ No database queries (stateless)

### Considerations
- Items array dalam memory (limit ~100 items OK)
- PDF generation sinkron (bisa async jika perlu)
- No session/database (data hilang saat refresh)

---

## Security

### Current State
- ✅ No authentication (by design)
- ✅ No data persistence
- ✅ CSRF protection (Livewire)
- ✅ XSS protection (Blade)

### Recommendations for Production
- Rate limiting untuk PDF generation
- Input validation/sanitization
- File upload limits (jika add feature)

---

## Testing

### Manual Testing Checklist
- [ ] Generate invoice number
- [ ] Add multiple items
- [ ] Remove items
- [ ] Toggle mode quantity
- [ ] Add discount (nominal & persen)
- [ ] Toggle PPN
- [ ] Toggle terbilang
- [ ] Print preview
- [ ] Export PDF
- [ ] Responsive mobile

### Unit Test Ideas
```php
test('terbilang converts numbers correctly', function() {
    expect(terbilang(1000))->toBe('Seribu Rupiah');
});

test('invoice calculates total correctly', function() {
    // Test calculations
});
```

---

## Future Enhancements

### Possible Features
1. Templates (multiple invoice styles)
2. Logo upload
3. Save draft (localStorage)
4. Multi-language
5. History (database)
6. Share link
7. Email invoice
8. RAB mode (detailed breakdown)
9. Recurring invoice
10. Client database

### Tech Debt
- Add comprehensive tests
- TypeScript for JS
- Component extraction (smaller components)
- State management (if complex)

---

Dokumentasi ini akan di-update seiring development. 🚀

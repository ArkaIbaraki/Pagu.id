# 📸 Screenshots & Features Showcase

> **Note:** Screenshots akan ditambahkan setelah deployment

## 🎯 Main Interface

### Desktop View
```
┌─────────────────────────────────────────────────────────┐
│          📄 Invoice & RAB Maker - Indonesia            │
│     Tool gratis untuk membuat invoice versi Indonesia   │
├───────────────────┬─────────────────────────────────────┤
│                   │                                     │
│   FORM INPUT      │      LIVE PREVIEW                   │
│                   │                                     │
│ • Nama Usaha      │  ┌───────────────────────────────┐ │
│ • Nomor Invoice   │  │ NAMA USAHA                    │ │
│ • Tanggal         │  │ Invoice: INV-20260203-A1B2    │ │
│ • Penerima        │  │ Tanggal: 3 Februari 2026      │ │
│                   │  └───────────────────────────────┘ │
│ Mode Item:        │                                     │
│ ○ Dengan Qty      │  Item 1: Konsultasi Sistem        │
│ ● Tanpa Qty       │  Rp 5.000.000                      │
│                   │                                     │
│ [+ Tambah Item]   │  TOTAL: Rp 5.000.000               │
│                   │  Terbilang: Lima Juta Rupiah       │
│ ☑ PPN 11%         │                                     │
│ ☑ Terbilang       │  [🖨️ Print]  [📄 Export PDF]      │
│                   │                                     │
└───────────────────┴─────────────────────────────────────┘
```

### Mobile View
```
┌─────────────────────────┐
│  📄 Invoice Maker       │
├─────────────────────────┤
│                         │
│   FORM INPUT            │
│   (Full Width)          │
│                         │
├─────────────────────────┤
│                         │
│   LIVE PREVIEW          │
│   (Full Width)          │
│                         │
│   [Print] [PDF]         │
│                         │
└─────────────────────────┘
```

## ✨ Features Demo

### 1. Mode Quantity
**Dengan Quantity:**
```
┌────────────────────────────────────────────┐
│ Item 1                              [Hapus]│
│ Deskripsi: Laptop ASUS ROG                 │
│ Qty: [2]  Harga: [10.000.000]             │
│                                            │
│ Preview:                                   │
│ Laptop ASUS ROG  2  Rp 10.000.000         │
│ Subtotal: Rp 20.000.000                   │
└────────────────────────────────────────────┘
```

**Tanpa Quantity:**
```
┌────────────────────────────────────────────┐
│ Item 1                              [Hapus]│
│ Deskripsi: Konsultasi Web Development      │
│ Harga: [15.000.000]                        │
│                                            │
│ Preview:                                   │
│ Konsultasi Web Development                 │
│ Rp 15.000.000                              │
└────────────────────────────────────────────┘
```

### 2. Terbilang (Highlight Feature!) 🇮🇩
```
Input Total: Rp 1.500.000

Output Terbilang:
┌────────────────────────────────────────────┐
│ Terbilang:                                 │
│ Satu Juta Lima Ratus Ribu Rupiah          │
└────────────────────────────────────────────┘
```

**Contoh Lain:**
- `5.250.000` → "Lima Juta Dua Ratus Lima Puluh Ribu Rupiah"
- `123.456.789` → "Seratus Dua Puluh Tiga Juta Empat Ratus Lima Puluh Enam Ribu Tujuh Ratus Delapan Puluh Sembilan Rupiah"
- `1.000.000.000` → "Satu Miliar Rupiah"

### 3. Perhitungan Real-time
```
Subtotal:        Rp  10.000.000
Diskon (10%):  - Rp   1.000.000
                ─────────────────
Setelah Diskon:  Rp   9.000.000
PPN 11%:       + Rp     990.000
                ─────────────────
TOTAL:           Rp   9.990.000
                 ═════════════════
Terbilang: Sembilan Juta Sembilan Ratus Sembilan Puluh Ribu Rupiah
```

### 4. PDF Output Preview
```
┌───────────────────────────────────────┐
│                                       │
│  PT. CONTOH JAYA                      │
│  Invoice: INV-20260203-A1B2           │
│  Tanggal: 3 Februari 2026             │
│  ───────────────────────────────────  │
│                                       │
│  Kepada:                              │
│  PT. Client Sejahtera                 │
│  Jl. Sudirman No. 123, Jakarta        │
│                                       │
│  ───────────────────────────────────  │
│  Deskripsi         Qty  Harga    Sub  │
│  ───────────────────────────────────  │
│  Web Development    1   15.000.000    │
│  Hosting 1 Tahun    1    3.000.000    │
│  ───────────────────────────────────  │
│                                       │
│              Subtotal:  18.000.000    │
│              PPN 11%:    1.980.000    │
│              ───────────────────────  │
│              TOTAL:     19.980.000    │
│              ═══════════════════════  │
│                                       │
│  Terbilang:                           │
│  Sembilan Belas Juta Sembilan Ratus   │
│  Delapan Puluh Ribu Rupiah            │
│                                       │
│  Catatan:                             │
│  Pembayaran dapat dilakukan melalui   │
│  transfer bank.                       │
│                                       │
│                    Hormat kami,       │
│                                       │
│                    [TTD Area]         │
│                    ─────────────      │
│                    Budi Santoso       │
│                                       │
└───────────────────────────────────────┘
```

## 🎨 UI Components

### Form Elements
- ✅ Text input - Clean, modern style
- ✅ Number input - With step controls
- ✅ Date picker - Native HTML5
- ✅ Textarea - Multi-line input
- ✅ Radio buttons - Mode selection
- ✅ Checkboxes - Toggle options
- ✅ Buttons - Primary & secondary
- ✅ Loading states - Smooth transitions

### Color Scheme
```
Primary:   #2563EB (Blue 600)
Success:   #16A34A (Green 600)
Danger:    #DC2626 (Red 600)
Warning:   #F59E0B (Amber 500)
Gray:      #6B7280 (Gray 500)
Background: #F9FAFB (Gray 50)
```

### Typography
- **Headings:** Bold, clear hierarchy
- **Body:** 14px-16px, readable
- **Numbers:** Monospace dalam tabel
- **Terbilang:** Italic, emphasized

## 📱 Responsive Breakpoints

```
Mobile:   < 640px   (Stack layout)
Tablet:   640-1024px (Optimized)
Desktop:  > 1024px   (Side-by-side)
```

## 🎬 User Journey

### Quick Demo Flow
```
1. Land on homepage
   ↓
2. See pre-filled invoice number
   ↓
3. Enter business name
   ↓
4. Add items (real-time preview)
   ↓
5. Toggle options (instant update)
   ↓
6. See terbilang auto-generate
   ↓
7. Click Export PDF
   ↓
8. Download ready-to-use invoice
```

### Time to First Invoice
**Target: < 2 minutes**
- 0:00 - Load page
- 0:10 - Enter business name
- 0:30 - Add 2-3 items
- 0:45 - Toggle PPN
- 1:00 - Preview check
- 1:30 - Export PDF
- 2:00 - Done! ✅

## 🆚 Comparison

### Before (Manual Invoice)
```
⏱️ Time: 15-30 minutes
❌ Need template
❌ Manual calculation
❌ Copy-paste errors
❌ Formatting issues
❌ No terbilang automation
```

### After (Invoice Maker)
```
⏱️ Time: 2-5 minutes
✅ No template needed
✅ Auto calculation
✅ Error-free
✅ Consistent format
✅ Auto terbilang 🇮🇩
```

## 🎯 Use Cases

### 1. Freelancer
```
Project: Web Development
Items:
- Design UI/UX: Rp 5.000.000
- Development: Rp 15.000.000
- Testing: Rp 3.000.000
Total: Rp 23.000.000
```

### 2. Small Business
```
Project: Penjualan Produk
Items:
- Mouse Wireless (10x @ 150.000)
- Keyboard Mechanical (5x @ 500.000)
Diskon: 5%
PPN: 11%
Total: Rp 2.886.938
```

### 3. Consultant
```
Project: Konsultasi Bisnis
Items:
- Konsultasi Strategi: Rp 10.000.000
- Laporan Analisis: Rp 5.000.000
Total: Rp 15.000.000
```

## 📊 Statistics (Projected)

```
Invoice Generation Time: < 3 min
Error Rate: Near 0%
User Satisfaction: High
Learning Curve: Minimal
Mobile Usage: ~40%
PDF Downloads: ~80%
Print Usage: ~20%
```

## 🎁 Benefits

### For Users
- ⚡ Fast - Create invoice dalam menit
- 🎯 Accurate - No calculation errors
- 📱 Accessible - Any device, anywhere
- 🆓 Free - No subscription
- 🇮🇩 Local - Format Indonesia

### For Business
- 💼 Professional - Clean, standardized format
- ⏰ Time-saving - 10x faster than manual
- 🔄 Consistent - Same format every time
- 📄 Shareable - PDF ready to send

---

## 📸 How to Add Screenshots

Untuk menambahkan screenshot:

1. Take screenshots saat aplikasi berjalan
2. Simpan di folder `/screenshots`
3. Update README.md dengan link image
4. Commit & push

Format nama file:
- `desktop-main.png`
- `mobile-preview.png`
- `pdf-output.png`
- `feature-terbilang.png`

---

**Coming Soon:** Real screenshots dan demo video! 🎥

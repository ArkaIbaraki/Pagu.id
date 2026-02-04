# 📸 Screenshots & Features

Dokumentasi visual dari Pagu.id - Invoice & RAB Maker dengan penjelasan fitur-fiturnya.

---

## 🏠 Landing Page

### Hero Section
**URL:** `/`

Landing page dengan desain modern dan card-based selection:
- **Navbar** dengan logo "Pagu.id" dan navigation links
- **Hero Title** dengan gradient text
- **Feature Cards** untuk Invoice dan RAB dengan icon, description, dan benefits
- **Info Section** dengan 3 benefit cards: ⚡ Cepat, 🆓 Gratis, 🇮🇩 Format Indonesia

**Features Highlighted:**
- Mobile-responsive dengan hamburger menu
- Hover animations pada cards
- Clean gradient backgrounds
- Call-to-action buttons ("Buat Invoice" / "Buat RAB")

---

## 📄 Invoice Maker

### URL: `/invoice`

### 1. Header Customization

**Gaya Header Invoice:**
- Radio buttons: "Tampilkan Nama Usaha" atau "Title INVOICE Saja"
- Conditional input: Nama Usaha/Pribadi (hanya muncul jika pilih "Nama Usaha")

**Logo/Kop Perusahaan:**
- Checkbox: "Gunakan Logo/Kop Perusahaan"
- Textarea untuk paste Base64 image
- Link helper ke converter: https://www.base64-image.de/
- Preview logo di header (kiri atas sebelum title)

### 2. Data Dasar Invoice

**Left Panel - Form Input:**
- Nomor Invoice (auto-generated: `INV-20260204-D846`)
- Button 🔄 untuk regenerate nomor
- Tanggal Invoice (date picker)
- Nama Penerima (optional)
- Alamat (optional, textarea)

### 3. Mode Item

**Toggle Mode:**
- Radio: "Dengan Quantity" atau "Tanpa Quantity"

**Mode Dengan Quantity:**
```
Item 1
[Deskripsi item/jasa________________]
[Qty___] [Harga Satuan___________]
[✕ Hapus]
```

**Mode Tanpa Quantity:**
```
Item 1
[Deskripsi item/jasa________________]
[Harga__________________________]
[✕ Hapus]
```

**Actions:**
- Button "+ Tambah Item" (hijau)
- Button "✕ Hapus" untuk setiap item (kecuali item pertama)

### 4. Perhitungan

**Diskon (Optional):**
- Checkbox: "Gunakan Diskon"
- Radio: "Nominal" atau "Persen"
- Input field sesuai pilihan

**PPN (Optional):**
- Checkbox: "Tambah PPN 11%"

**Terbilang:**
- Checkbox: "Tampilkan Terbilang"

### 5. Footer Invoice

**Form Fields:**
- Catatan (textarea, optional)
- Nama Penanda Tangan (optional)

### 6. Live Preview (Right Panel)

**Header Display:**
```
[Logo Kop]          (jika ada)

        INVOICE      (centered, atau Nama Usaha)
_____________________________________________

No. Invoice: INV-20260204-D846    Tanggal: 04 February 2026
Pelanggan: PT. Contoh Indonesia
Alamat: Jl. Sudirman No. 123, Jakarta Pusat
```

**Table Items:**

*Mode Dengan Quantity:*
```
┌────┬───────────────┬─────┬──────────┬──────────────┐
│ No │ Keterangan    │ Qty │  Harga   │ Jumlah (Rp)  │
├────┼───────────────┼─────┼──────────┼──────────────┤
│ 1  │ Product A     │ 10  │ Rp 50.000│  Rp 500.000  │
│ 2  │ Product B     │  5  │ Rp 100.000│ Rp 500.000  │
└────┴───────────────┴─────┴──────────┴──────────────┘
```

*Mode Tanpa Quantity:*
```
┌────┬───────────────┬──────────────┐
│ No │ Keterangan    │ Jumlah (Rp)  │
├────┼───────────────┼──────────────┤
│ 1  │ Jasa Konsultasi│ Rp 500.000  │
│ 2  │ Service Fee   │  Rp 500.000  │
└────┴───────────────┴──────────────┘
```

**Summary Table:**
```
                     Subtotal    Rp 1.000.000
                     PPN 11%      Rp 110.000
═════════════════════════════════════════════
                     Total       Rp 1.110.000
═════════════════════════════════════════════
```

**Terbilang:**
```
Terbilang: Satu Juta Seratus Sepuluh Ribu Rupiah
```

**Action Buttons:**
- 🖨️ Print (blue button)
- 📄 Export PDF (red button)

**Tips Banner:**
```
💡 Tips: Semua perubahan akan langsung terlihat di preview.
         Data tidak disimpan di server.
```

---

## 📊 RAB Maker (Rencana Anggaran Biaya)

### URL: `/rab`

### 1. Header Data Proyek

**Left Panel - Form Input:**
- Nama Proyek
- Nomor RAB (auto-generated: `RAB-20260204-XXXX`)
- Button 🔄 untuk regenerate
- Tanggal RAB (date picker)
- Lokasi Proyek
- Nama Pemilik Proyek

### 2. Item Rincian (Volume-Based)

**Item Structure:**
```
Item 1
[Deskripsi/Uraian Pekerjaan_______]
[Volume] [Satuan▼] [Harga Satuan_]
                    Subtotal: Rp 0
[✕ Hapus]
```

**Satuan Dropdown:**
- unit
- m² (meter persegi)
- m³ (meter kubik)
- meter
- kg
- set
- ls (lump sum)

**Calculation:**
```
Jumlah = Volume × Harga Satuan
```

### 3. Footer RAB

**Form Fields:**
- Catatan (textarea, optional)
- Nama Pembuat
- Nama Penyetuju

### 4. Live Preview (Right Panel)

**Header Display:**
```
    RENCANA ANGGARAN BIAYA
        Contoh Proyek
_____________________________________________

No. RAB: RAB-20260204-A123       Tanggal: 04 February 2026
Lokasi: Jakarta
Pemilik: PT. Contoh Indonesia
```

**Table Rincian:**
```
┌────┬──────────────┬────────┬────────┬─────────────┬──────────────┐
│ No │   Uraian     │ Volume │ Satuan │    Harga    │  Jumlah (Rp) │
├────┼──────────────┼────────┼────────┼─────────────┼──────────────┤
│ 1  │ Item A       │   100  │   m²   │ Rp 10.000   │  Rp 1.000.000│
│ 2  │ Item B       │    50  │   unit │ Rp 20.000   │  Rp 1.000.000│
│ 3  │ Item C       │    75  │   kg   │ Rp 15.000   │  Rp 1.125.000│
└────┴──────────────┴────────┴────────┴─────────────┴──────────────┘

                             TOTAL ANGGARAN: Rp 3.125.000
```

**Signature Section:**
```
Catatan: Harga sudah termasuk material dan upah

Jakarta, 04 February 2026

Pembuat,                    Penyetuju,


_____________              _____________
[Nama Pembuat]            [Nama Penyetuju]
```

---

## 📱 Responsive Design

### Mobile View (< 1024px)

**Navigation:**
- Hamburger menu (☰) button
- Dropdown menu dengan slide animation
- Active link highlighting

**Layout:**
- Form dan Preview menjadi 1 kolom (stacked)
- Preview sticky di atas on scroll
- Touch-friendly buttons dan inputs
- Optimized spacing untuk mobile

### Desktop View (≥ 1024px)

**Layout:**
- 2 kolom side-by-side (Form | Preview)
- Preview sticky pada scroll
- Larger font sizes
- More whitespace

---

## 🖨️ Print & PDF Export

### Print View

**Features:**
- Clean print layout tanpa navbar/buttons
- Optimized margins
- Professional typography
- All calculations preserved
- Logo/kop included (jika ada)

### PDF Export

**Features:**
- Filename: `invoice-INV-XXXXXXX.pdf` atau `rab-RAB-XXXXXXX.pdf`
- A4 size optimized
- Inline CSS untuk konsistensi
- Base64 image support untuk logo
- Professional border dan spacing
- Ready to email atau print

**PDF Structure:**
```
[Header with Logo]
[Title: INVOICE / RENCANA ANGGARAN BIAYA]
[Info Section]
[Items Table]
[Summary/Total]
[Terbilang (invoice only)]
[Catatan]
[Signature Space]
```

---

## 🎨 UI/UX Highlights

### Color Scheme
- **Primary:** Blue (#3B82F6) untuk Invoice
- **Accent:** Green (#10B981) untuk RAB
- **Danger:** Red (#EF4444) untuk delete actions
- **Background:** Gradient dari purple ke pink

### Interactions
- **Hover Effects:** Transform scale, shadow elevation
- **Active States:** Border color changes
- **Loading States:** Livewire wire:loading indicators
- **Validation:** Real-time error messages

### Typography
- **Headers:** Bold, large size (text-2xl to text-4xl)
- **Labels:** Font-semibold, text-sm
- **Values:** Font-medium, adequate spacing
- **Monospace:** For invoice/RAB numbers

---

## ✨ Key Features Visual Summary

| Feature | Invoice | RAB | Visual Indicator |
|---------|---------|-----|------------------|
| Auto Number | ✅ | ✅ | 🔢 INV/RAB-YYYYMMDD |
| Live Preview | ✅ | ✅ | 👁️ Side-by-side |
| PDF Export | ✅ | ✅ | 📄 Red button |
| Print | ✅ | ✅ | 🖨️ Blue button |
| Terbilang | ✅ | ❌ | 🇮🇩 Toggle on/off |
| Logo Support | ✅ | ❌ | 🖼️ Base64 image |
| Quantity Mode | ✅ | ❌ | 🔢 Toggle |
| Volume Calc | ❌ | ✅ | 📏 Volume × Harga |
| Discount | ✅ | ❌ | 💰 % or Nominal |
| PPN 11% | ✅ | ❌ | 🧾 Checkbox |
| Signatures | ✅ | ✅ | ✍️ Space provided |

---

*Last Updated: February 4, 2026*

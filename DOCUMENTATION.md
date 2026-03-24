# Pagu.id - Invoice & RAB Maker Indonesia

**Pembuat Invoice & RAB Indonesia yang gratis, tanpa login, dan siap pakai.**

## 🎯 Tentang Pagu.id

Pagu.id adalah web tool yang memudahkan siapa saja untuk membuat **Invoice** dan **RAB (Rencana Anggaran Biaya)** sesuai standar Indonesia, tanpa perlu login, tanpa biaya, dan tanpa ribet.

### Fitur Utama

✅ **Invoice & RAB Maker** - Buat invoice dan RAB dengan mudah
✅ **Mode Item Fleksibel** - Pilih dengan atau tanpa quantity (per-invoice)
✅ **Perhitungan Otomatis** - Subtotal, diskon, PPN dihitung real-time
✅ **Terbilang Otomatis** - Ubah angka total ke teks Indonesia (ciri khas invoice Indonesia)
✅ **Live Preview** - Lihat hasil dengan real-time saat mengetik
✅ **Print & PDF Export** - Export atau print langsung dari preview
✅ **History/Riwayat** - Simpan multiple invoices di localStorage
✅ **Dark Mode** - Mode gelap untuk kenyamanan mata
✅ **Responsive Design** - Bekerja sempurna di desktop, tablet, dan mobile
✅ **Logo Upload** - Upload logo perusahaan Anda
✅ **Customizable** - Sesuaikan dengan brand Anda

---

## 🚀 Quick Start

### Instalasi

```bash
# Clone atau copy project ini
cd pagu-id

# Install dependencies
npm install

# Run development server
npm run dev
```

Buka [http://localhost:3000](http://localhost:3000) di browser Anda.

### Build untuk Production

```bash
npm run build
npm run start
```

---

## 📋 Format Invoice & RAB

### Invoice Format
```
                          INVOICE

Invoice No  : 001/INV/II/2026              Tanggal : 01 Februari 2026
Pelanggan   : Sekolah Taruna Bhakti
Alamat      : Jl. Pekapuran Kel. Curug Kec. Cimanggis Kota Depok

┌─────┬──────────────────────────────┬──────────────┐
│ No  │ Keterangan                   │ Jumlah (Rp)  │
├─────┼──────────────────────────────┼──────────────┤
│ 1   │ Jasa Pindah / Relokasi       │ 5.150.000    │
│ 2   │ Material Relokasi            │ 11.750.000   │
├─────┼──────────────────────────────┼──────────────┤
│     │ Subtotal                     │ 16.900.000   │
│     │ PPN 11%                      │ 1.859.000    │
│     │ Total                        │ 18.759.000   │
│     │ Terbilang: Delapan Belas ... │              │
└─────┴──────────────────────────────┴──────────────┘

Format Saya
_______________
Teguh Nirmolo
```

### RAB Format
```
                PEKERJAAN RELOKASI SHUNTRIP

┌──────────────────────┬─────┬─────┬──────────────┬──────────────┐
│ URAIAN PEKERJAAN     │ SAT │ VOL │ HARGA SATUAN │ JUMLAH       │
├──────────────────────┼─────┼─────┼──────────────┼──────────────┤
│                      │     │     │              │ JASA         │
│ Bongkar Shuntrip ... │ Set │ 2   │ 250.000      │ 500.000      │
│ ...                  │     │     │              │              │
│                      │     │     │              │ 5.150.000    │
├──────────────────────┼─────┼─────┼──────────────┼──────────────┤
│                      │     │     │              │ MATERIAL     │
│ KABEL JTR            │ M   │ 150 │ 75.000       │ 11.250.000   │
│ ...                  │     │     │              │              │
│ Total (MATERIAL+JASA)│     │     │              │ 16.900.000   │
│ PPN 11%              │     │     │              │ 1.859.000    │
│ JUMLAH TOTAL         │     │     │              │ 18.759.000   │
└──────────────────────┴─────┴─────┴──────────────┴──────────────┘
```

---

## 💾 Penggunaan

### 1. Membuat Invoice/RAB Baru
- Klik tombol **"+ Invoice"** atau **"+ RAB"**
- Form akan otomatis terbuka dengan nomor invoice yang sudah ter-generate

### 2. Isi Data Perusahaan
- **Logo**: Upload logo perusahaan Anda (opsional)
- **Nama Perusahaan**: Nama bisnis/individu
- **Alamat**: Alamat lengkap
- **Telepon & Email**: (opsional)

Jika upload logo, field perusahaan akan auto-filled dari logo metadata (jika tersedia).

### 3. Isi Data Pelanggan
- **Nama Pelanggan**: Penerima invoice
- **Alamat Pelanggan**: Alamat lengkap

### 4. Tambah Item
**Pilih mode item dulu:**
- **Dengan Quantity**: Quantity + Satuan + Harga Satuan (untuk RAB atau invoice detail)
- **Tanpa Quantity**: Hanya Deskripsi + Harga (untuk invoice singkat)

Setiap invoice hanya boleh satu mode (all-or-nothing).

### 5. Pengaturan Perhitungan
- **Diskon**: Masukkan nominal (Rp) atau persen (%)
- **PPN 11%**: Toggle untuk termasuk atau tidak
- **Terbilang**: Toggle untuk tampilkan teks bilangan
- **Bulatkan Desimal**: Pilih antara 2 desimal atau pembulatan

### 6. Catatan & Tanda Tangan
- **Catatan**: Pesan untuk pelanggan (opsional)
- **Nama Penanda Tangan**: Nama yang ditampilkan di tanda tangan

### 7. Simpan & Export
- Klik **"💾 Simpan"** untuk simpan ke history (localStorage)
- Klik **"🖨️ Print"** untuk print langsung
- Klik **"📄 Export PDF"** untuk download PDF

---

## 🔢 Nomor Invoice Format

Format nomor invoice mengikuti standar Indonesia:

```
XXX / INV / RN / YYYY

XXX  = Nomor urut (001, 002, 003, dll)
INV  = Literal "INV"
RN   = Bulan dalam angka Romawi (I, II, III, IV, ..., XII)
YYYY = Tahun (2026, 2027, dll)
```

**Contoh:**
- Januari 2026: `001/INV/I/2026`, `002/INV/I/2026`, dll
- Februari 2026: `001/INV/II/2026`, `002/INV/II/2026`, dll
- Maret 2026: `001/INV/III/2026`, dll

**Counter di-reset otomatis setiap bulan baru.**

---

## 📝 Terbilang (Fitur Spesial Indonesia)

Terbilang otomatis mengubah angka total ke kata-kata Indonesia:

```
1.000          → Satu Ribu Rupiah
5.150.000      → Lima Juta Seratus Lima Puluh Ribu Rupiah
18.759.000     → Delapan Belas Juta Tujuh Ratus Lima Puluh Sembilan Ribu Rupiah
```

**Fitur:**
- ✅ Max nilai: 999 Miliar
- ✅ Auto-generate (bukan input manual)
- ✅ Reaktif mengikuti total
- ✅ Toggle on/off di pengaturan

---

## 🎨 Dark Mode

Klik tombol **🌙** di top-right untuk toggle dark mode. Preferensi disimpan di localStorage.

---

## 💾 Data & Privacy

- **Semua data disimpan di localStorage browser Anda** (bukan di server)
- **Tidak ada data yang dikirim ke cloud/server**
- **Data hilang jika clear browser cache**
- **Setiap device punya riwayat sendiri**

### Backup Data
Untuk backup riwayat, buka DevTools → Application → Local Storage → Cari `pagu_invoice_history`.

---

## 📦 Tech Stack

- **Framework**: Next.js 16.1.6 (React 19, TypeScript)
- **Styling**: Tailwind CSS v4
- **State Management**: Zustand
- **PDF Export**: html2canvas + jsPDF
- **Print**: Native browser print API

---

## 📊 Project Structure

```
src/
├── app/
│   ├── page.tsx             # Main page
│   ├── layout.tsx           # Root layout
│   ├── globals.css          # Global styles
│   └── print.css            # Print styles
├── components/
│   ├── dark-mode-provider.tsx  # Dark mode provider
│   ├── invoice-form.tsx        # Form input component
│   └── invoice-preview.tsx     # Preview component
├── lib/
│   └── utils/
│       ├── terbilang.ts       # Terbilang converter
│       ├── invoice-number.ts  # Invoice numbering logic
│       ├── calculations.ts    # Calculation helpers
│       └── export.ts          # Export/print helpers
├── store/
│   └── invoice.ts             # Zustand store
└── types/
    └── index.ts               # TypeScript types
```

---

## 🐛 Known Limitations & Future Features

### Phase 1 (MVP) ✅ Completed
- ✅ Invoice & RAB maker
- ✅ Item flexibility (with/without qty)
- ✅ Auto calculations
- ✅ Terbilang converter
- ✅ Live preview
- ✅ Print & PDF export
- ✅ History/localStorage
- ✅ Dark mode
- ✅ Responsive design

### Phase 2 (Future) 📋
- 🔜 Upload signature image
- 🔜 More RAB categories
- 🔜 Invoice templates
- 🔜 Batch invoice creation
- 🔜 Cloud sync (optional)
- 🔜 Multi-language support
- 🔜 API untuk integrasi

### Out of Scope ❌
- ❌ Login/user accounts
- ❌ Multi-user collaboration
- ❌ Multi-currency
- ❌ Public API
- ❌ Email integration
- ❌ Payment gateway

---

## 📄 License

Pagu.id adalah open-source tool gratis untuk semua orang.

---

## 💬 Support & Feedback

Untuk bug reports atau feature requests, silakan buat issue di repository ini.

---

**Selamat membuat invoice! 🎉**

Made with ❤️ for Indonesian businesses

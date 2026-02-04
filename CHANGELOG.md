# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-02-04

### 🎉 Major Update - Invoice & RAB Separation

#### ✨ Added
- **Landing Page** dengan hero section dan card-based selection
- **Navbar Navigation** responsif dengan mobile hamburger menu dan active state
- **RAB Maker** - Tool terpisah untuk membuat Rencana Anggaran Biaya:
  - Volume-based calculations (Volume × Harga Satuan)
  - Support berbagai satuan (unit, m², m³, meter, kg, set, ls, dll)
  - Header: Nama Proyek, No RAB, Tanggal, Lokasi, Pemilik
  - Footer: Nama Pembuat & Penyetuju dengan space tanda tangan
  - PDF export dengan format profesional
- **Invoice Header Customization**:
  - Radio button: Pilih Nama Usaha atau Title "INVOICE" saja
  - Support logo/kop perusahaan dengan Base64 image
  - Logo preview di browser dan export ke PDF
- **Responsive Table Display**:
  - Mode quantity: Kolom No, Keterangan, Qty, Harga, Jumlah (Rp)
  - Mode non-quantity: Kolom No, Keterangan, Jumlah (Rp)
  - Dynamic colspan adjustment di summary table
- **Header Info Layout Update**:
  - Format baru: No. Invoice (kiri) dan Tanggal (kanan) dalam satu baris
  - Pelanggan dan Alamat ditampilkan vertikal di bawah

#### 🔄 Changed
- Routes structure: `/` untuk landing page, `/invoice` dan `/rab` untuk tools
- UI improvements dengan gradient backgrounds dan hover animations
- PDF templates optimized untuk kedua mode quantity
- Mobile-first responsive design enhancement

#### 🐛 Fixed
- Type casting untuk semua operasi matematika (prevent string multiplication errors)
- PDF filename sanitization (remove `/` and `\` characters)
- Colspan calculations untuk summary table
- Image rendering in PDF using Base64 encoding
- Error handling untuk missing variables in PDF generation

#### 🛠️ Technical
- Added `app/Livewire/RabMaker.php` component
- Added `resources/views/livewire/rab-maker.blade.php` view
- Added `resources/views/pdf/rab.blade.php` template
- Added `resources/views/home.blade.php` landing page
- Updated `routes/web.php` with new route structure
- Added `useKopPerusahaan` and `kopPerusahaan` properties to InvoiceMaker
- Enhanced `generatePdf()` method with complete data array

---

## [1.0.0] - 2026-02-03

### 🎉 Initial Release

#### ✨ Added
- **Invoice Maker** - Core functionality untuk membuat invoice Indonesia
- **Livewire Integration** - Reactive components dengan Livewire 4
- **Terbilang Feature** - Konversi angka ke kata-kata Indonesia (e.g., "Satu Juta Lima Ratus Ribu Rupiah")
- **Dual Item Mode**:
  - Mode dengan Quantity (Deskripsi, Qty, Harga, Subtotal)
  - Mode tanpa Quantity (Deskripsi, Harga)
- **Auto-generate Invoice Number** - Format: `INV-YYYYMMDD-XXXX`
- **Real-time Calculations**:
  - Subtotal otomatis
  - Diskon (nominal atau persen)
  - PPN 11%
  - Total akhir
- **Live Preview** - Side-by-side preview yang update real-time
- **Export Features**:
  - Print langsung dari browser
  - Export to PDF dengan format rapi
- **Optional Fields**:
  - Nama penerima
  - Alamat
  - Catatan
  - Tanda tangan
- **Toggle Features**:
  - Toggle diskon
  - Toggle PPN
  - Toggle terbilang
- **Responsive Design** - Works on desktop, tablet, dan mobile
- **No Login Required** - Public tool, langsung pakai
- **Tailwind CSS** - Modern styling dengan utility-first CSS

#### 📚 Documentation
- README.md - Comprehensive documentation
- QUICKSTART.md - Quick start guide
- DOCUMENTATION.md - Technical documentation
- CONTRIBUTING.md - Contributing guidelines

#### 🛠️ Technical
- Laravel 12
- Livewire 4
- Blade templating
- Tailwind CSS
- DomPDF untuk PDF generation
- Vite untuk asset bundling

---

## [Unreleased]

### Planned Features
- Logo upload capability
- Multiple invoice templates
- Save draft to localStorage
- Export to Excel
- Email invoice feature
- Invoice history (with database)
- Multi-currency support
- Digital signature integration
- Tax variations (selain PPN 11%)
- Item categories
- Recurring invoice
- Client database
- RAB (Rencana Anggaran Biaya) mode
- Dark mode

### Known Issues
- None reported yet

---

## Version History

### How to Read Versions
- **1.0.0** - Major.Minor.Patch
- **Major** - Breaking changes (backward incompatible)
- **Minor** - New features (backward compatible)
- **Patch** - Bug fixes only

### Release Notes

**v1.0.0 - MVP Release**
- First stable release
- Core features complete
- Production ready
- Open for contributions

---

## Support

For questions or issues:
1. Check [DOCUMENTATION.md](DOCUMENTATION.md)
2. Check [QUICKSTART.md](QUICKSTART.md)
3. Open an issue on GitHub
4. Check existing issues first

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

---

**Format:**
- ✨ Added - New features
- 🔄 Changed - Changes in existing functionality
- 🗑️ Deprecated - Soon-to-be removed features
- ❌ Removed - Now removed features
- 🐛 Fixed - Bug fixes
- 🔒 Security - Vulnerability fixes

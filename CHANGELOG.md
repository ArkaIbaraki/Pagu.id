# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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

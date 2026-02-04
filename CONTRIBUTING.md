# 🤝 Contributing Guidelines

Terima kasih sudah tertarik untuk berkontribusi! Project ini dibuat untuk komunitas Indonesia dan semua kontribusi sangat diapresiasi.

## 📋 Code of Conduct

- Bersikap hormat dan profesional
- Fokus pada improvement, bukan kritik pribadi
- Welcome untuk semua level (pemula hingga expert)
- Komunikasi dalam Bahasa Indonesia atau English

## 🚀 Cara Berkontribusi

### 1. Fork & Clone

```bash
# Fork repository di GitHub
# Clone ke local
git clone https://github.com/YOUR_USERNAME/pagu.id.git
cd pagu.id
```

### 2. Setup Development

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
npm run dev
```

### 3. Create Branch

```bash
# Format: feature/nama-fitur atau fix/nama-bug
git checkout -b feature/tambah-logo-upload
```

### 4. Make Changes

- Tulis kode yang clean & readable
- Follow Laravel & Livewire best practices
- Comment untuk logic yang kompleks
- Test manual sebelum commit

### 5. Commit

```bash
# Format commit message yang jelas
git add .
git commit -m "feat: tambah fitur upload logo"
```

**Commit Message Format:**
- `feat:` - New feature
- `fix:` - Bug fix
- `docs:` - Documentation only
- `style:` - Formatting, missing semi colons, etc
- `refactor:` - Code restructuring
- `perf:` - Performance improvements
- `test:` - Adding tests
- `chore:` - Build process or auxiliary tools

### 6. Push & Pull Request

```bash
git push origin feature/tambah-logo-upload
```

Buat Pull Request di GitHub dengan:
- Judul yang jelas
- Deskripsi lengkap
- Screenshot (jika UI change)
- Testing steps

## 🎯 Areas to Contribute

### 🐛 Bug Fixes
- Check [Issues](https://github.com/YOUR_REPO/issues) untuk bug reports
- Reproduce bug
- Fix dan tambahkan test jika mungkin

### ✨ New Features
Fitur yang bisa ditambahkan:
1. **Logo Upload** - Upload logo perusahaan
2. **Templates** - Multiple invoice styles
3. **LocalStorage** - Save draft
4. **Export Excel** - Selain PDF
5. **Email Invoice** - Send via email
6. **History** - Save & load previous invoices
7. **Multi-Currency** - Support USD, EUR, etc
8. **Digital Signature** - E-signature integration
9. **Tax Variations** - Selain PPN 11%
10. **Item Categories** - Group items

### 📖 Documentation
- Improve README
- Add code comments
- Create tutorials
- Translate documentation

### 🎨 Design
- UI/UX improvements
- Responsive fixes
- Accessibility (a11y)
- Dark mode

### 🧪 Testing
- Unit tests
- Feature tests
- Browser tests
- Performance tests

## 📝 Development Guidelines

### Code Style

**PHP:**
- Follow PSR-12
- Use type hints
- Write descriptive variable names
- Extract complex logic to methods

```php
// Good ✅
public function calculateTotalWithTax(int $subtotal, float $taxRate): int
{
    return $subtotal + ($subtotal * $taxRate / 100);
}

// Bad ❌
public function calc($s, $t) {
    return $s + ($s * $t / 100);
}
```

**Blade:**
- Use components when possible
- Keep logic minimal
- Proper indentation
- Descriptive class names

```blade
{{-- Good ✅ --}}
<div class="invoice-header">
    <h1>{{ $namaUsaha }}</h1>
</div>

{{-- Bad ❌ --}}
<div class="ih"><h1>{{$namaUsaha}}</h1></div>
```

**JavaScript:**
- ES6+ syntax
- Descriptive names
- Comment complex logic

**CSS/Tailwind:**
- Use utility classes
- Consistent spacing
- Mobile-first approach

### File Organization

```
app/
├── Helpers/           # Helper classes
├── Livewire/          # Livewire components
└── Services/          # Business logic (jika perlu)

resources/
├── css/               # Styles
├── js/                # Scripts
└── views/
    ├── components/    # Reusable components
    ├── layouts/       # Layouts
    └── livewire/      # Livewire views
```

### Testing

Manual testing minimal:
1. Add/remove items
2. Toggle all options
3. Preview update real-time
4. Print works
5. PDF generates correctly
6. Mobile responsive

Automated testing (bonus):
```bash
php artisan test
```

## 🔍 Review Process

### Before Submitting PR

- [ ] Code follows guidelines
- [ ] Tested manually
- [ ] No console errors
- [ ] Documentation updated
- [ ] Commit messages clear

### Review Criteria

Reviewer akan check:
1. **Functionality** - Feature works as expected
2. **Code Quality** - Clean, readable, maintainable
3. **Performance** - No significant slowdown
4. **Security** - No vulnerabilities
5. **UX** - Good user experience
6. **Documentation** - Properly documented

### Feedback

- Feedback adalah untuk improve code, bukan pribadi
- Diskusi welcome jika ada disagreement
- Revisi mungkin diminta sebelum merge

## 🏷️ Semantic Versioning

Project menggunakan [SemVer](https://semver.org/):

- **MAJOR** (1.x.x) - Breaking changes
- **MINOR** (x.1.x) - New features (backward compatible)
- **PATCH** (x.x.1) - Bug fixes

## 🎁 Recognition

Contributors akan:
- ✅ Listed di README
- ✅ Credit di release notes
- ✅ Eternal gratitude 🙏

## 💬 Communication

- **Issues** - Bug reports & feature requests
- **Discussions** - General questions & ideas
- **Pull Requests** - Code contributions

## 📜 License

By contributing, you agree that your contributions will be licensed under the same MIT License that covers this project.

---

## Quick Reference

### Common Tasks

**Add new field:**
1. Add property di `InvoiceMaker.php`
2. Add input di `invoice-maker.blade.php`
3. Add di preview section
4. Add di `pdf/invoice.blade.php`

**Fix calculation bug:**
1. Locate method di `InvoiceMaker.php`
2. Fix logic
3. Test all scenarios
4. Update tests

**Improve UI:**
1. Edit `invoice-maker.blade.php`
2. Update Tailwind classes
3. Test responsive
4. Rebuild: `npm run build`

**Update documentation:**
1. Edit relevant .md file
2. Clear & concise
3. Examples helpful
4. PR welcome!

---

Terima kasih sudah berkontribusi! 🚀🇮🇩

# Contributing to Pagu.id

Terima kasih sudah ingin berkontribusi ke Pagu.id! Panduan ini akan membantu Anda memulai.

## ⚖️ Kode Etik

Dengan berpartisipasi dalam project ini, Anda setuju untuk menjunjung tinggi kode etik kami:

- Bersikaplah ramah dan saling menghormati
- Hindari bahasa yang ofensif atau diskriminatif
- Hormati pendapat orang lain, meski berbeda
- Laporkan perilaku buruk kepada maintainer

## ❓ Bagaimana Berkontribusi?

### 🐛 Melaporkan Bug

Sebelum melaporkan bug:

1. **Cari di existing issues** - Kemungkinan sudah dilaporkan
2. **Periksa dokumentasi** - Mungkin sudah dijelaskan
3. **Buat contoh minimal** - Untuk easier debugging

Buat issue dengan template berikut:

```markdown
**Deskripsi Bug**
Penjelasan singkat bug apa

**Cara Reproduce**
1. Buka ...
2. Klik ...
3. Lihat error

**Expected Behavior**
Apa yang seharusnya terjadi

**Actual Behavior**
Apa yang terjadi sebenarnya

**Environment**
- OS: Windows 10
- Browser: Chrome 120
- Node: 18.17.0

**Screenshots**
Attach screenshot jika diperlukan
```

### ✨ Membuat Feature Request

Jelaskan:

Use Case - Kenapa fitur ini perlu ada
Manfaat - Bagaimana ini membantu user
Alternatif - Sudah coba cara lain?
Contoh - Implementasi yang diharapkan

#### 💻 Development Setup
1. Fork & Clone
```bash
# Fork di GitHub, kemudian:
git clone https://github.com/YOUR_USERNAME/pagu-id.git
cd pagu-id
```
2. Create Branch
```bash
git checkout -b feature/nama-fitur
git checkout -b fix/nama-bug
git checkout -b docs/nama-doc
```
Format nama branch:

- feature/describe-feature
- fix/describe-bug
- docs/describe-doc
- refactor/describe-refactor
- perf/describe-improvement

3. Install Dependencies
```bash
npm install
```

4. Development
```bash
# Start dev server
npm run dev

# Type checking
npm run type-check

# Formatting
npm run format

# Linting
npm run lint
```

5. Commit
Gunakan Conventional Commits:
```bash
git commit -m "feat: add dark mode toggle"
git commit -m "fix: invoice text visibility in dark mode"
git commit -m "docs: update installation guide"
git commit -m "refactor: extract invoice calculations"
git commit -m "perf: optimize invoice preview rendering"
```
Format:
```
<type>(<scope>): <subject>

<body>

<footer>
```
Types:
- feat - New feature
- fix - Bug fix
- docs - Documentation
- style - Code style (formatting)
- refactor - Code refactoring
- perf - Performance improvement
- test - Tests
- chore - Build/dependencies
6. Push & Create PR
```bash
git push origin feature/nama-fitur
```
Buka GitHub dan klik "Create Pull Request"

### Pull Request Guidelines

#### Before Submitting
 1. Branch dibuat dari main
 2. Commit messages menggunakan conventional commits
 3. Code sudah di-format (npm run format)
 4. Tidak ada console.log atau debug code
 5. Tests sudah di-add/update
 6. Documentation sudah di-update
 7. Tidak ada breaking changes

#### PR Description Template
```
## Description
Jelaskan apa yang diubah dan kenapa

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Breaking change
- [ ] Documentation update

## Related Issues
Closes #(issue number)

## How Has This Been Tested?
Jelaskan testing approach

## Screenshots (if applicable)
Before & after screenshots

## Checklist
- [ ] Code follows style guide
- [ ] Self-review ✓
- [ ] Comments untuk complex logic
- [ ] Documentation updated
- [ ] No new warnings
- [ ] Tests passing
```

#### Comments & Documentation
```
/**
 * Converts a number to Indonesian text representation
 * @param num - Number to convert
 * @returns Text representation in Indonesian
 * @example
 * numberToTerbilang(1234) // "Seribu Dua Ratus Tiga Puluh Empat rupiah"
 * @throws Error if input is negative
 */
export function numberToTerbilang(num: number): string {
  if (num < 0) {
    throw new Error('Input must be non-negative');
  }
  // ... implementation
}
```

### 🗂️ Documentation
Saat menambah fitur, update:

- README.md - Dokumentasi umum
- Code Comments - Penjelasan logic
- JSDoc - Function documentation
- Update relevant sections

Documentation Format
```
## Judul Fitur

Penjelasan singkat

### Cara Menggunakan

\`\`\`typescript
// Contoh code
\`\`\`

### API Reference

| Param | Type | Description |
|-------|------|-------------|
| name | string | Nama item |

### Notes
- Important notes
- Limitations
```

### Performance Considerations
- Hindari re-renders yang tidak perlu
- Gunakan useMemo untuk expensive calculations
- Optimize images
- Code splitting untuk components besar
- Monitor bundle size
```bash
npm run analyze  # Analyze bundle size
```

## Recognition
Contributors akan di-recognize di:

- README.md
- Release notes
- Project website

---

Terima kasih atas kontribusinya! 🙏

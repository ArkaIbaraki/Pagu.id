# 📄 Pagu.id - Invoice & RAB Maker Indonesia
Sebuah web tool tanpa login untuk membuat Invoice & RAB (Rencana Anggaran Biaya) yang disesuaikan dengan praktik umum di Indonesia. Bisa dipakai siapa saja secara langsung tanpa ribet desain atau template.

<p align="center">
  <a href="https://nextjs.org">
    <img src="https://img.shields.io/badge/Next.js-16.1.6-black?logo=next.js&logoColor=white" alt="Next.js">
  </a>
  <a href="https://www.typescriptlang.org">
    <img src="https://img.shields.io/badge/TypeScript-5.0+-blue?logo=typescript&logoColor=white" alt="TypeScript">
  </a>
  <a href="https://tailwindcss.com">
    <img src="https://img.shields.io/badge/Tailwind%20CSS-v4-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  </a>
  <a href="LICENSE">
    <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
  </a>
</p>

---

## 📚 Dokumentasi

- 📖 **[Technical Documentation](src/docs/DOCUMENTATION.md)** - Struktur kode & arsitektur
- 🤝 **[Contributing Guidelines](src/docs/CONTRIBUTING.md)** - Cara berkontribusi
- 📝 **[Changelog](src/docs/CHANGELOG.md)** - Version history & updates

---

## ✨ Fitur Utama

### 📋 Invoice Maker
- Header fleksibel (nama usaha atau title)
- Logo/Kop perusahaan (base64)
- Mode item dengan/tanpa quantity
- Diskon nominal atau persen
- PPN otomatis 11%
- Terbilang (angka ke huruf)
- Export PDF & Print

### 📐 RAB Maker
- Input proyek lengkap
- Rincian biaya dengan volume & satuan
- Perhitungan otomatis
- Tanda tangan pembuat & penyetuju
- Export PDF & Print

### 🌟 Fitur Tambahan
- 📱 Responsive Design
- 💾 Auto-Save & History (10 dokumen)
- 🔒 Privacy-First (client-side only)
- ⚡ No Login Required
- 🎨 Professional UI

## 🛠️ Teknologi yang Digunakan

- Next.js 16 - React framework
- React 19 - UI library
- TypeScript 5 - Type safety
- Tailwind CSS v4 - Styling
- Zustand 4 - State management
- html2canvas - Canvas conversion
- jsPDF - PDF generation


## 📦 Instalasi
1. Clone Repository

```bash
git clone https://github.com/ArkaIbaraki/pagu-id.git
cd pagu-id
```
2. Install Dependencies
```bash
npm install
```
3. Jalankan Development Server
```bash
npm run dev
```
Buka browser ke http://localhost:3000

## 🎮 Penggunaan

### Invoice Maker
1. Buka http://localhost:3000/invoice
2. Pilih gaya header (nama usaha atau title)
3. (Opsional) Upload logo/kop perusahaan
4. Isi data invoice
5. Tambah item dengan harga
6. (Opsional) Tambah diskon dan PPN
7. Preview otomatis di sebelah kanan
8. Export PDF atau Print

### RAB Maker
1. Buka http://localhost:3000/rab
2. Isi data proyek (nama, nomor, tanggal, lokasi)
3. Tambah rincian biaya
4. Isi nama pembuat dan penyetuju
5. Lihat total otomatis
6. Export PDF atau Print

## 🚀 Deployment

### Vercel (Recommended)
```bash
npm i -g vercel
vercel
```
### Docker
```bash
docker build -t pagu-id .
docker run -p 3000:3000 pagu-id
```
### Self-Hosted
```bash
npm run build
npm start
```

## 🔍 Struktur Project
```
pagu-id/
├── src/
│   ├── app/
│   │   ├── layout.tsx              # Root layout
│   │   ├── globals.css             # Global styles
│   │   ├── page.tsx                # Home page
│   │   ├── invoice/
│   │   │   └── page.tsx
│   │   └── rab/
│   │       └── page.tsx
│   ├── components/
│   │   ├── invoice-form.tsx
│   │   ├── invoice-preview.tsx
│   │   ├── rab-form.tsx
│   │   ├── rab-preview.tsx
│   │   └── dark-mode-provider.tsx
|   ├── docs/
│   |   ├── README.md
│   |   ├── CONTRIBUTING.md
│   |   ├── CHANGELOG.md
│   |   └── SECURITY.md
|   ├── lib/
│   |   └── utils/
│   |       ├── terbilang.ts
|   |       ├── invoice-number.ts
│   |       └── export.ts
│   ├── store/
│   │   ├── invoice.ts
│   │   └── rab.ts
│   └── types/
│       └── index.ts
│   
├── public/
├── package.json
├── tsconfig.json
├── next.config.ts
├── tailwind.config.ts
└── postcss.config.mjs
```
## ⚙️ Konfigurasi

### Tailwind CSS
Edit tailwind.config.ts untuk customize warna:
```bash
theme: {
  extend: {
    colors: {
      primary: '#your-color',
    }
  }
}
```

## Testing

### Setup Testing
```bash
npm install --save-dev @testing-library/react @testing-library/jest-dom
```
### Run test
```bash
npm test
```

## Kontribusi
Kami menerima kontribusi dari komunitas! Lihat CONTRIBUTING.md untuk guidelines.

Quick Start untuk Contributors
1. Fork repository
2. Create branch (git checkout -b feature/amazing-feature)
3. Commit changes (git commit -m 'feat: add amazing feature')
4. Push ke branch (git push origin feature/amazing-feature)
5. Open Pull Request

## Changelog

Lihat CHANGELOG.md untuk history rilis.

## Security

Lihat SECURITY.md untuk security policy.

Jika menemukan security vulnerability, email security@arkas.my.id (jangan di-public issue)

## License

MIT License - lihat LICENSE file untuk detail.

## Support 
- 📧 Email: support@arkas.my.id
- 🐛 Issues: [GitHub Issues](https://github.com/ArkaIbaraki/Pagu.id/issues)
- 💬 Discussions: [GitHub Discussions](https://github.com/ArkaIbaraki/Pagu.id/discussions)

## Acknowledgments
- Built with ❤️ from Indonesia
- Thanks to [Next.js](https://nextjs.org/), [React](https://react.dev/), [Tailwind CSS](https://tailwindcss.com/)
- Inspired by modern invoice makers

## Authors
- Pagu.id Team - [GitHub](https://github.com/ArkaIbaraki)
  
---

Pagu.id - Dibuat dengan ❤️ untuk komunitas Indonesia

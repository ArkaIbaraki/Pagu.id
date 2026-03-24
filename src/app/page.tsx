'use client';

import Link from 'next/link';
import { useState, useEffect } from 'react';

export default function HomePage() {
  const [mounted, setMounted] = useState(false);

  useEffect(() => {
    setMounted(true);
  }, []);

  if (!mounted) return null;

  return (
    <div className="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
      <div className="max-w-4xl w-full">
        {/* Header */}
        <div className="text-center mb-12">
          <h1 className="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
            📊 Pagu.id
          </h1>
          <p className="text-lg text-gray-600">
            Pembuat Invoice & RAB Profesional dengan Format Indonesia
          </p>
        </div>

        {/* Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
          {/* Invoice Card */}
          <Link href="/invoice">
            <div className="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 cursor-pointer transform hover:scale-105 transition-transform">
              <div className="text-5xl mb-4">📋</div>
              <h2 className="text-2xl font-bold text-gray-900 mb-3">
                Invoice Maker
              </h2>
              <p className="text-gray-600 mb-6">
                Buat invoice profesional dengan fitur lengkap:
              </p>
              <ul className="text-sm text-gray-700 space-y-2 mb-6">
                <li>✅ Header dengan Nama Usaha atau Title</li>
                <li>✅ Logo/Kop Perusahaan</li>
                <li>✅ Mode dengan/tanpa Quantity</li>
                <li>✅ Diskon (Nominal & Persen)</li>
                <li>✅ PPN Otomatis</li>
                <li>✅ Terbilang (Angka ke Huruf)</li>
                <li>✅ Export PDF & Print</li>
              </ul>
              <button className="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition-colors">
                Buat Invoice →
              </button>
            </div>
          </Link>

          {/* RAB Card */}
          <Link href="/rab">
            <div className="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 cursor-pointer transform hover:scale-105 transition-transform">
              <div className="text-5xl mb-4">📐</div>
              <h2 className="text-2xl font-bold text-gray-900 mb-3">
                RAB Maker
              </h2>
              <p className="text-gray-600 mb-6">
                Buat Rencana Anggaran Biaya (RAB) untuk proyek:
              </p>
              <ul className="text-sm text-gray-700 space-y-2 mb-6">
                <li>✅ Input Nama & Nomor Proyek</li>
                <li>✅ Volume & Satuan Fleksibel</li>
                <li>✅ Harga per Satuan</li>
                <li>✅ Perhitungan Otomatis</li>
                <li>✅ Data Pembuat & Penyetuju</li>
                <li>✅ Export PDF & Print</li>
                <li>✅ Format Profesional</li>
              </ul>
              <button className="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold transition-colors">
                Buat RAB →
              </button>
            </div>
          </Link>
        </div>

        {/* Features */}
        <div className="bg-white rounded-2xl shadow-lg p-8 mb-12">
          <h3 className="text-2xl font-bold text-gray-900 mb-6">
            🌟 Fitur Unggulan
          </h3>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div className="flex items-start space-x-4">
              <div className="text-2xl">⚡</div>
              <div>
                <h4 className="font-semibold text-gray-900 mb-1">
                  Gratis & Cepat
                </h4>
                <p className="text-sm text-gray-600">
                  Tidak perlu login, semua proses di browser Anda
                </p>
              </div>
            </div>
            <div className="flex items-start space-x-4">
              <div className="text-2xl">🔒</div>
              <div>
                <h4 className="font-semibold text-gray-900 mb-1">
                  Aman & Privat
                </h4>
                <p className="text-sm text-gray-600">
                  Data tidak tersimpan di server, hanya di perangkat Anda
                </p>
              </div>
            </div>
            <div className="flex items-start space-x-4">
              <div className="text-2xl">📱</div>
              <div>
                <h4 className="font-semibold text-gray-900 mb-1">
                  Mobile Friendly
                </h4>
                <p className="text-sm text-gray-600">
                  Bekerja sempurna di desktop, tablet, dan smartphone
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Footer */}
        <div className="text-center text-gray-600 text-sm">
          <p>
            Dibuat dengan ❤️ untuk memudahkan bisnis Anda
          </p>
          <p className="mt-2">
            © 2026 Pagu.id - Invoice & RAB Maker
          </p>
        </div>
      </div>
    </div>
  );
}
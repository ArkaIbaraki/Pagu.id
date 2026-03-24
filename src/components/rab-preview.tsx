'use client';

import { useRef } from 'react';
import { useRabStore } from '@/store/rab';
import { formatCurrency } from '@/lib/utils/terbilang';
import { exportToPDF, printInvoice } from '@/lib/utils/export';

export function RabPreview() {
  const previewRef = useRef<HTMLDivElement>(null);
  const store = useRabStore();

  const handleExportPdf = async () => {
    if (!store.namaProyek) {
      alert('Nama proyek harus diisi!');
      return;
    }

    const hasItem = store.items.some((item) => item.deskripsi.trim());
    if (!hasItem) {
      alert('Minimal harus ada 1 item dengan deskripsi!');
      return;
    }

    if (!previewRef.current) return;

    try {
      await exportToPDF(previewRef.current, `rab-${store.nomorRab}`);
    } catch (error) {
      alert('Error generating PDF: ' + error);
    }
  };

  return (
    <div className="lg:sticky lg:top-6 lg:self-start overflow-auto max-h-[90vh]">
      <div
        ref={previewRef}
        className="bg-white rounded-lg shadow-lg p-4 sm:p-6 md:p-8 text-gray-900"
        style={{ fontSize: '0.9rem' }}
        id="rab-preview"
      >
        {/* Header */}
        <div className="border-b-2 border-gray-300 pb-4 mb-6">
          <h2 className="text-xl sm:text-2xl font-bold text-gray-900 text-center">
            RENCANA ANGGARAN BIAYA
          </h2>
        </div>

        {/* Project Info */}
        <div className="mb-6 text-sm grid grid-cols-2 gap-4">
          <div>
            <span className="font-semibold text-gray-900">Nama Proyek</span>
            <span className="block text-gray-900 font-medium">{store.namaProyek || '-'}</span>
          </div>
          <div>
            <span className="font-semibold text-gray-900">Nomor RAB</span>
            <span className="block text-gray-900 font-medium">{store.nomorRab}</span>
          </div>
          <div>
            <span className="font-semibold text-gray-900">Tanggal</span>
            <span className="block text-gray-900 font-medium">
              {new Date(store.tanggalRab).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
              })}
            </span>
          </div>
          <div>
            <span className="font-semibold text-gray-900">Lokasi</span>
            <span className="block text-gray-900 font-medium">{store.lokasi || '-'}</span>
          </div>
          <div>
            <span className="font-semibold text-gray-900">Pemilik</span>
            <span className="block text-gray-900 font-medium">{store.namaPemilik || '-'}</span>
          </div>
        </div>

        {/* Items Table */}
        <div className="mb-4 border-t border-gray-300 pt-4">
          <table className="w-full text-xs border-collapse">
            <thead>
              <tr className="border-b-2 border-gray-900">
                <th className="text-left py-2 px-2 font-bold text-gray-900 w-12">No</th>
                <th className="text-left py-2 px-2 font-bold text-gray-900">Deskripsi</th>
                <th className="text-center py-2 px-2 font-bold text-gray-900 w-16">Volume</th>
                <th className="text-center py-2 px-2 font-bold text-gray-900 w-16">Satuan</th>
                <th className="text-right py-2 px-2 font-bold text-gray-900 w-28">Harga/Satuan</th>
                <th className="text-right py-2 px-2 font-bold text-gray-900 w-28">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              {store.items.map((item, idx) => {
                const subtotal = item.volume * item.hargaSatuan;
                return (
                  <tr key={idx} className="border-b border-gray-300">
                    <td className="text-center py-2 px-2 text-gray-900">{idx + 1}</td>
                    <td className="py-2 px-2 text-gray-900">{item.deskripsi || '-'}</td>
                    <td className="text-center py-2 px-2 text-gray-900">{item.volume}</td>
                    <td className="text-center py-2 px-2 text-gray-900">{item.satuan}</td>
                    <td className="text-right py-2 px-2 text-gray-900">
                      {formatCurrency(item.hargaSatuan)}
                    </td>
                    <td className="text-right py-2 px-2 font-semibold text-gray-900">
                      {formatCurrency(subtotal)}
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>

        {/* Total */}
        <div className="mb-4 flex justify-end">
          <div className="w-full space-y-2">
            <div className="flex justify-end border-t-2 border-gray-900">
              <span className="w-32 text-right py-2 px-2 font-bold text-lg text-gray-900">
                TOTAL
              </span>
              <span className="w-32 text-right py-2 px-2 font-bold text-lg text-gray-900">
                {formatCurrency(store.total())}
              </span>
            </div>
          </div>
        </div>

        {/* Notes */}
        {store.catatan && (
          <div className="mb-4 text-sm border-t border-gray-300 pt-2">
            <span className="font-semibold text-gray-900">Catatan:</span>
            <span className="block text-gray-900">{store.catatan}</span>
          </div>
        )}

        {/* Signatures */}
        <div className="mt-8 grid grid-cols-2 gap-4 text-center text-sm">
          {store.namaPembuat && (
            <div>
              <span className="font-semibold block mb-2 text-gray-900">Dibuat Oleh</span>
              <div className="h-12 my-2"></div>
              <span className="text-gray-900">{store.namaPembuat}</span>
            </div>
          )}
          {store.namaPenyetuju && (
            <div>
              <span className="font-semibold block mb-2 text-gray-900">Disetujui Oleh</span>
              <div className="h-12 my-2"></div>
              <span className="text-gray-900">{store.namaPenyetuju}</span>
            </div>
          )}
        </div>
      </div>

      {/* Action Buttons */}
      <div className="mt-4 flex space-x-3">
        <button
          onClick={() => printInvoice()}
          className="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition-colors duration-200 flex items-center justify-center"
        >
          <span className="mr-2">🖨️</span> Print
        </button>
        <button
          onClick={handleExportPdf}
          className="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-colors duration-200 flex items-center justify-center"
        >
          <span className="mr-2">📄</span> Export PDF
        </button>
      </div>

      {/* Info Box */}
      <div className="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800">
        <strong>💡 Tips:</strong> RAB untuk perencanaan anggaran proyek konstruksi
      </div>

      <style>{`
        @media print {
          body * {
            visibility: hidden;
          }

          #rab-preview,
          #rab-preview * {
            visibility: visible;
          }

          #rab-preview {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
          }
        }
      `}</style>
    </div>
  );
}
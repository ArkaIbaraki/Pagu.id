'use client';

import { useRef } from 'react';
import { useInvoiceStore } from '@/store/invoice';
import { formatCurrency, numberToTerbilang } from '@/lib/utils/terbilang';
import { exportToPDF, printInvoice } from '@/lib/utils/export';

export function InvoicePreview() {
  const previewRef = useRef<HTMLDivElement>(null);
  const store = useInvoiceStore();

  const handleExportPdf = async () => {
    if (store.headerStyle === 'nama' && !store.namaUsaha) {
      alert('Nama usaha harus diisi!');
      return;
    }

    const hasItem = store.items.some((item) => item.deskripsi.trim());
    if (!hasItem) {
      alert('Minimal harus ada 1 item dengan deskripsi!');
      return;
    }

    if (!previewRef.current) return;

    try {
      await exportToPDF(previewRef.current, `invoice-${store.nomorInvoice}`);
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
        id="invoice-preview"
      >
        {/* Header */}
        <div className="mb-6 pb-4 border-b-2 border-gray-300">
          {store.useKopPerusahaan && store.kopPerusahaan && (
            <div className="mb-3">
              <img
                src={store.kopPerusahaan}
                alt="Kop"
                className="h-16 object-contain"
              />
            </div>
          )}

          {store.headerStyle === 'title' ? (
            <h1 className="text-3xl font-bold text-center text-gray-900">INVOICE</h1>
          ) : (
            <h1 className="text-3xl font-bold text-center text-gray-900">
              {store.namaUsaha || 'NAMA USAHA'}
            </h1>
          )}
        </div>

        {/* Invoice Info */}
        <div className="mb-6 text-sm border-b border-gray-300 pb-4">
          <div className="flex justify-between mb-2">
            <div>
              <span className="font-semibold text-gray-900">Invoice No</span>
              <span className="block text-gray-900 font-medium">{store.nomorInvoice}</span>
            </div>
            <div className="text-right">
              <span className="font-semibold text-gray-900">Tanggal</span>
              <span className="block text-gray-900 font-medium">
                {new Date(store.tanggalInvoice).toLocaleDateString('id-ID', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric',
                })}
              </span>
            </div>
          </div>
          {store.namaPenerima && (
            <div className="mb-2">
              <span className="font-semibold text-gray-900">Pelanggan</span>
              <span className="block text-gray-900 font-medium">{store.namaPenerima}</span>
            </div>
          )}
          {store.alamat && (
            <div>
              <span className="font-semibold text-gray-900">Alamat</span>
              <span className="block text-gray-900 font-medium">{store.alamat}</span>
            </div>
          )}
        </div>

        {/* Items Table */}
        <div className="mb-4">
          <table className="w-full text-xs border-collapse">
            <thead>
              <tr className="border-b-2 border-gray-900">
                <th className="text-left py-2 px-2 font-bold text-gray-900 w-12">No</th>
                <th className="text-left py-2 px-2 font-bold text-gray-900">Keterangan</th>
                {store.modeQuantity && (
                  <>
                    <th className="text-center py-2 px-2 font-bold text-gray-900 w-16">Qty</th>
                    <th className="text-right py-2 px-2 font-bold text-gray-900 w-28">Harga</th>
                  </>
                )}
                <th className="text-right py-2 px-2 font-bold text-gray-900 w-32">
                  Jumlah (Rp)
                </th>
              </tr>
            </thead>
            <tbody>
              {store.items.map((item, idx) => (
                <tr key={idx} className="border-b border-gray-300">
                  <td className="text-center py-2 px-2 text-gray-900">{idx + 1}</td>
                  <td className="py-2 px-2 text-gray-900">{item.deskripsi || '-'}</td>
                  {store.modeQuantity && (
                    <>
                      <td className="text-center py-2 px-2 text-gray-900">{item.qty}</td>
                      <td className="text-right py-2 px-2 text-gray-900">
                        {formatCurrency(item.harga)}
                      </td>
                    </>
                  )}
                  <td className="text-right py-2 px-2 font-semibold text-gray-900">
                    {formatCurrency(
                      store.modeQuantity ? item.qty * item.harga : item.harga
                    )}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* Summary */}
        <div className="mb-4">
          <table className="w-full text-sm border-collapse">
            <tbody>
              <tr className="border-b border-gray-300">
                <td
                  className="py-2 px-2"
                  colSpan={store.modeQuantity ? 3 : 1}
                ></td>
                <td className="text-right py-2 px-2 font-semibold text-gray-900">Subtotal</td>
                <td className="text-right py-2 px-2 w-32 font-semibold text-gray-900">
                  {formatCurrency(store.subtotal())}
                </td>
              </tr>

              {store.useDiskon && store.diskonValue() > 0 && (
                <tr className="border-b border-gray-300">
                  <td
                    className="py-2 px-2"
                    colSpan={store.modeQuantity ? 3 : 1}
                  ></td>
                  <td className="text-right py-2 px-2 font-semibold text-gray-900">Diskon</td>
                  <td className="text-right py-2 px-2 w-32 font-semibold text-gray-900">
                    {formatCurrency(store.diskonValue())}
                  </td>
                </tr>
              )}

              {store.usePpn && (
                <tr className="border-b border-gray-300">
                  <td
                    className="py-2 px-2"
                    colSpan={store.modeQuantity ? 3 : 1}
                  ></td>
                  <td className="text-right py-2 px-2 font-semibold text-gray-900">PPN 11%</td>
                  <td className="text-right py-2 px-2 w-32 font-semibold text-gray-900">
                    {formatCurrency(store.ppnValue())}
                  </td>
                </tr>
              )}

              <tr className="border-t-2 border-b-2 border-gray-900">
                <td
                  className="py-2 px-2"
                  colSpan={store.modeQuantity ? 3 : 1}
                ></td>
                <td className="text-right py-2 px-2 font-bold text-gray-900">Total</td>
                <td className="text-right py-2 px-2 w-32 font-bold text-lg text-gray-900">
                  {formatCurrency(store.total())}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        {store.showTerbilang && (
          <div className="text-sm mb-6 border-t-2 border-gray-300 pt-2">
            <span className="font-semibold text-gray-900">Terbilang :</span>
            <span className="italic text-gray-900"> {numberToTerbilang(store.total())}</span>
          </div>
        )}

        {store.catatan && (
          <div className="mb-6 text-sm">
            <div className="text-gray-900 font-medium mb-1">Catatan:</div>
            <div className="text-gray-900">{store.catatan}</div>
          </div>
        )}

        {store.namaTtd && (
          <div className="mt-8 text-right">
            <div className="text-sm text-gray-600 mb-12">Hormat Saya,</div>
            <div className="text-sm font-semibold text-gray-900 border-t border-gray-400 inline-block px-4 pt-1">
              {store.namaTtd}
            </div>
          </div>
        )}
      </div>

      {/* Action Buttons */}
      <div className="mt-4 flex space-x-3">
        <button
          onClick={() => printInvoice()}
          className="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors duration-200 flex items-center justify-center"
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
      <div className="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800">
        <strong>💡 Tips:</strong> Semua perubahan akan langsung terlihat di preview. Data tidak disimpan di server.
      </div>

      <style>{`
        @media print {
          body * {
            visibility: hidden;
          }

          #invoice-preview,
          #invoice-preview * {
            visibility: visible;
          }

          #invoice-preview {
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
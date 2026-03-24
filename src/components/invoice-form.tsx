'use client';

import { useInvoiceStore } from '@/store/invoice';

export function InvoiceForm() {
  const store = useInvoiceStore();

  return (
    <div className="bg-white rounded-lg shadow-lg p-4 sm:p-6 max-h-[90vh] overflow-y-auto text-gray-900">
      <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-4">
        📝 Data Invoice
      </h2>

      {/* Header Style */}
      <div className="p-3 bg-blue-50 border border-blue-200 rounded-lg mb-4">
        <label className="block text-sm font-medium text-gray-900 mb-2">
          Gaya Header Invoice
        </label>
        <div className="flex space-x-4">
          <label className="flex items-center cursor-pointer">
            <input
              type="radio"
              checked={store.headerStyle === 'nama'}
              onChange={() => store.setHeaderStyle('nama')}
              className="mr-2"
            />
            <span className="text-sm text-gray-900">Tampilkan Nama Usaha</span>
          </label>
          <label className="flex items-center cursor-pointer">
            <input
              type="radio"
              checked={store.headerStyle === 'title'}
              onChange={() => store.setHeaderStyle('title')}
              className="mr-2"
            />
            <span className="text-sm text-gray-900">Title "INVOICE" Saja</span>
          </label>
        </div>
      </div>

      {/* Kop Perusahaan */}
      <div className="p-3 bg-purple-50 border border-purple-200 rounded-lg mb-4">
        <label className="flex items-center cursor-pointer mb-2">
          <input
            type="checkbox"
            checked={store.useKopPerusahaan}
            onChange={(e) => store.setUseKopPerusahaan(e.target.checked)}
            className="mr-2"
          />
          <span className="text-sm font-medium text-gray-900">
            Gunakan Logo/Kop Perusahaan
          </span>
        </label>
        {store.useKopPerusahaan && (
          <div className="space-y-2 mt-2">
            <p className="text-xs text-gray-700">Konversi gambar ke Base64:</p>
            <textarea
              value={store.kopPerusahaan}
              onChange={(e) => store.setKopPerusahaan(e.target.value)}
              rows={2}
              className="w-full px-3 py-2 border border-gray-300 rounded-md text-xs font-mono resize-none text-gray-900 bg-white"
              placeholder="Paste base64 image (misal: data:image/png;base64,iVBORw0KGgo...)"
            />
            <p className="text-xs text-gray-600">
              💡{' '}
              <a
                href="https://www.base64-image.de/"
                target="_blank"
                rel="noopener noreferrer"
                className="text-blue-600 hover:underline"
              >
                Convert image to Base64 →
              </a>
            </p>
          </div>
        )}
      </div>

      {/* Nama Usaha */}
      {store.headerStyle === 'nama' && (
        <input
          type="text"
          value={store.namaUsaha}
          onChange={(e) => store.setNamaUsaha(e.target.value)}
          className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-4 text-gray-900 bg-white"
          placeholder="PT. Contoh Jaya / Budi Santoso"
        />
      )}

      {/* Number & Date */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label className="block text-sm font-medium text-gray-900 mb-1">
            Nomor Invoice
          </label>
          <div className="flex space-x-2">
            <input
              type="text"
              value={store.nomorInvoice}
              onChange={(e) => store.setNomorInvoice(e.target.value)}
              className="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
            />
            <button
              onClick={() => store.regenerateInvoiceNumber()}
              className="px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-sm whitespace-nowrap transition-colors"
              title="Generate nomor baru"
            >
              🔄
            </button>
          </div>
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-900 mb-1">
            Tanggal
          </label>
          <input
            type="date"
            value={store.tanggalInvoice}
            onChange={(e) => store.setTanggalInvoice(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
          />
        </div>
      </div>

      {/* Penerima & Alamat */}
      <input
        type="text"
        value={store.namaPenerima}
        onChange={(e) => store.setNamaPenerima(e.target.value)}
        className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-3 text-gray-900 bg-white"
        placeholder="Nama Penerima (Opsional)"
      />

      <textarea
        value={store.alamat}
        onChange={(e) => store.setAlamat(e.target.value)}
        rows={2}
        className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-4 text-gray-900 bg-white"
        placeholder="Alamat (Opsional)"
      />

      {/* Mode Item */}
      <div className="mb-4 p-4 bg-blue-50 rounded-lg">
        <label className="block text-sm font-medium text-gray-900 mb-2">
          Mode Item
        </label>
        <div className="space-y-2">
          <label className="flex items-center cursor-pointer">
            <input
              type="radio"
              checked={store.modeQuantity}
              onChange={() => store.setModeQuantity(true)}
              className="mr-2"
            />
            <span className="text-sm text-gray-900">
              Dengan Quantity (Deskripsi, Qty, Harga, Subtotal)
            </span>
          </label>
          <label className="flex items-center cursor-pointer">
            <input
              type="radio"
              checked={!store.modeQuantity}
              onChange={() => store.setModeQuantity(false)}
              className="mr-2"
            />
            <span className="text-sm text-gray-900">Tanpa Quantity (Deskripsi, Harga)</span>
          </label>
        </div>
      </div>

      {/* Items */}
      <div className="mb-6">
        <div className="flex justify-between items-center mb-3">
          <h3 className="text-lg font-semibold text-gray-900">Item / Jasa</h3>
          <button
            onClick={() => store.addItem()}
            className="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm transition-colors"
          >
            + Tambah Item
          </button>
        </div>

        <div className="space-y-3">
          {store.items.map((item, index) => (
            <div key={index} className="border border-gray-200 rounded-lg p-3 bg-gray-50">
              <div className="flex justify-between items-start mb-2">
                <span className="text-sm font-medium text-gray-900">
                  Item {index + 1}
                </span>
                {store.items.length > 1 && (
                  <button
                    onClick={() => store.removeItem(index)}
                    className="text-red-600 hover:text-red-800 text-sm transition-colors"
                  >
                    ✕ Hapus
                  </button>
                )}
              </div>

              <div className="space-y-2">
                <input
                  type="text"
                  value={item.deskripsi}
                  onChange={(e) =>
                    store.updateItem(index, {
                      ...item,
                      deskripsi: e.target.value,
                    })
                  }
                  className="w-full px-2 py-1 border border-gray-300 rounded text-sm text-gray-900 bg-white"
                  placeholder="Deskripsi item / jasa"
                />

                {store.modeQuantity ? (
                  <div className="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <input
                      type="number"
                      value={item.qty}
                      onChange={(e) =>
                        store.updateItem(index, {
                          ...item,
                          qty: parseFloat(e.target.value) || 1,
                        })
                      }
                      className="w-full px-2 py-1 border border-gray-300 rounded text-sm text-gray-900 bg-white"
                      placeholder="Qty"
                      min="1"
                    />
                    <input
                      type="number"
                      value={item.harga}
                      onChange={(e) =>
                        store.updateItem(index, {
                          ...item,
                          harga: parseFloat(e.target.value) || 0,
                        })
                      }
                      className="w-full px-2 py-1 border border-gray-300 rounded text-sm sm:col-span-2 text-gray-900 bg-white"
                      placeholder="Harga satuan"
                      min="0"
                    />
                  </div>
                ) : (
                  <input
                    type="number"
                    value={item.harga}
                    onChange={(e) =>
                      store.updateItem(index, {
                        ...item,
                        harga: parseFloat(e.target.value) || 0,
                      })
                    }
                    className="w-full px-2 py-1 border border-gray-300 rounded text-sm text-gray-900 bg-white"
                    placeholder="Harga"
                    min="0"
                  />
                )}
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Diskon */}
      <div className="border border-gray-200 rounded-lg p-4 mb-4">
        <label className="flex items-center cursor-pointer mb-3">
          <input
            type="checkbox"
            checked={store.useDiskon}
            onChange={(e) => store.setUseDiskon(e.target.checked)}
            className="mr-2"
          />
          <span className="font-medium text-gray-900">Gunakan Diskon</span>
        </label>

        {store.useDiskon && (
          <div className="space-y-2">
            <div className="flex space-x-2">
              <label className="flex items-center cursor-pointer">
                <input
                  type="radio"
                  checked={store.diskonTipe === 'nominal'}
                  onChange={() => store.setDiskonTipe('nominal')}
                  className="mr-1"
                />
                <span className="text-sm text-gray-900">Nominal</span>
              </label>
              <label className="flex items-center cursor-pointer">
                <input
                  type="radio"
                  checked={store.diskonTipe === 'persen'}
                  onChange={() => store.setDiskonTipe('persen')}
                  className="mr-1"
                />
                <span className="text-sm text-gray-900">Persen</span>
              </label>
            </div>

            {store.diskonTipe === 'nominal' ? (
              <input
                type="number"
                value={store.diskonNominal}
                onChange={(e) =>
                  store.setDiskonNominal(parseFloat(e.target.value) || 0)
                }
                className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
                placeholder="Jumlah diskon"
                min="0"
              />
            ) : (
              <input
                type="number"
                value={store.diskonPersen}
                onChange={(e) =>
                  store.setDiskonPersen(parseFloat(e.target.value) || 0)
                }
                className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
                placeholder="Persen diskon"
                min="0"
                max="100"
              />
            )}
          </div>
        )}
      </div>

      {/* PPN */}
      <div className="border border-gray-200 rounded-lg p-4 mb-4">
        <label className="flex items-center cursor-pointer">
          <input
            type="checkbox"
            checked={store.usePpn}
            onChange={(e) => store.setUsePpn(e.target.checked)}
            className="mr-2"
          />
          <span className="font-medium text-gray-900">Tambah PPN 11%</span>
        </label>
      </div>

      {/* Terbilang */}
      <div className="border border-gray-200 rounded-lg p-4 mb-4">
        <label className="flex items-center cursor-pointer">
          <input
            type="checkbox"
            checked={store.showTerbilang}
            onChange={(e) => store.setShowTerbilang(e.target.checked)}
            className="mr-2"
          />
          <span className="font-medium text-gray-900">Tampilkan Terbilang</span>
        </label>
      </div>

      {/* Footer */}
      <textarea
        value={store.catatan}
        onChange={(e) => store.setCatatan(e.target.value)}
        rows={2}
        className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-3 text-gray-900 bg-white"
        placeholder="Catatan (Opsional)"
      />

      <input
        type="text"
        value={store.namaTtd}
        onChange={(e) => store.setNamaTtd(e.target.value)}
        className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-4 text-gray-900 bg-white"
        placeholder="Nama Penanda Tangan (Opsional)"
      />
    </div>
  );
}
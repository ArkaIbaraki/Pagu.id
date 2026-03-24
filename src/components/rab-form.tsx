'use client';

import { useRabStore } from '@/store/rab';

export function RabForm() {
  const store = useRabStore();

  return (
    <div className="bg-white rounded-lg shadow-lg p-4 sm:p-6 max-h-[90vh] overflow-y-auto text-gray-900">
      <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-4">
        📝 Data RAB
      </h2>

      {/* Project Name */}
      <input
        type="text"
        value={store.namaProyek}
        onChange={(e) => store.setNamaProyek(e.target.value)}
        className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-4 text-gray-900 bg-white"
        placeholder="Pembangunan Rumah 2 Lantai"
      />

      {/* Number & Date */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label className="block text-sm font-medium text-gray-900 mb-1">
            Nomor RAB
          </label>
          <div className="flex space-x-2">
            <input
              type="text"
              value={store.nomorRab}
              onChange={(e) => store.setNomorRab(e.target.value)}
              className="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
            />
            <button
              onClick={() => store.regenerateRabNumber()}
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
            value={store.tanggalRab}
            onChange={(e) => store.setTanggalRab(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
          />
        </div>
      </div>

      {/* Location & Owner */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <input
          type="text"
          value={store.lokasi}
          onChange={(e) => store.setLokasi(e.target.value)}
          className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
          placeholder="Lokasi Proyek (Opsional)"
        />
        <input
          type="text"
          value={store.namaPemilik}
          onChange={(e) => store.setNamaPemilik(e.target.value)}
          className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
          placeholder="Nama Pemilik (Opsional)"
        />
      </div>

      {/* Items */}
      <div className="mb-6">
        <div className="flex justify-between items-center mb-3">
          <h3 className="text-lg font-semibold text-gray-900">Rincian Biaya</h3>
          <button
            onClick={() => store.addItem()}
            className="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm transition-colors"
          >
            + Tambah Item
          </button>
        </div>

        <div className="space-y-3">
          {store.items.map((item, index) => (
            <div key={index} className="border border-gray-200 rounded-lg p-4 bg-gray-50">
              <div className="flex justify-between items-start mb-3">
                <span className="font-semibold text-gray-900">Item {index + 1}</span>
                {store.items.length > 1 && (
                  <button
                    onClick={() => store.removeItem(index)}
                    className="text-red-600 hover:text-red-800 text-sm transition-colors"
                  >
                    ✕ Hapus
                  </button>
                )}
              </div>

              <div className="space-y-3">
                <input
                  type="text"
                  value={item.deskripsi}
                  onChange={(e) =>
                    store.updateItem(index, {
                      ...item,
                      deskripsi: e.target.value,
                    })
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
                  placeholder="Deskripsi Pekerjaan"
                />

                <div className="grid grid-cols-1 sm:grid-cols-3 gap-2">
                  <div>
                    <label className="block text-xs text-gray-700 mb-1">
                      Volume
                    </label>
                    <input
                      type="number"
                      value={item.volume}
                      onChange={(e) =>
                        store.updateItem(index, {
                          ...item,
                          volume: parseFloat(e.target.value) || 0,
                        })
                      }
                      className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
                      step="0.01"
                      min="0"
                    />
                  </div>
                  <div>
                    <label className="block text-xs text-gray-700 mb-1">
                      Satuan
                    </label>
                    <select
                      value={item.satuan}
                      onChange={(e) =>
                        store.updateItem(index, {
                          ...item,
                          satuan: e.target.value,
                        })
                      }
                      className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
                    >
                      <option>unit</option>
                      <option>m2</option>
                      <option>m3</option>
                      <option>meter</option>
                      <option>kg</option>
                      <option>set</option>
                      <option>ls</option>
                    </select>
                  </div>
                  <div>
                    <label className="block text-xs text-gray-700 mb-1">
                      Harga/Satuan
                    </label>
                    <input
                      type="number"
                      value={item.hargaSatuan}
                      onChange={(e) =>
                        store.updateItem(index, {
                          ...item,
                          hargaSatuan: parseFloat(e.target.value) || 0,
                        })
                      }
                      className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
                      placeholder="Harga"
                      min="0"
                    />
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Notes */}
      <textarea
        value={store.catatan}
        onChange={(e) => store.setCatatan(e.target.value)}
        rows={2}
        className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-4 text-gray-900 bg-white"
        placeholder="Catatan (Opsional)"
      />

      {/* Creator & Approver */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <input
          type="text"
          value={store.namaPembuat}
          onChange={(e) => store.setNamaPembuat(e.target.value)}
          className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
          placeholder="Dibuat Oleh (Opsional)"
        />
        <input
          type="text"
          value={store.namaPenyetuju}
          onChange={(e) => store.setNamaPenyetuju(e.target.value)}
          className="w-full px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-900 bg-white"
          placeholder="Disetujui Oleh (Opsional)"
        />
      </div>

      {/* Info Box */}
      <div className="p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800 mb-4">
        <strong>💡 Tips:</strong> RAB digunakan untuk perencanaan anggaran proyek
      </div>
    </div>
  );
}
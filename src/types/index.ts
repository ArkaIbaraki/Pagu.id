export interface InvoiceItem {
  deskripsi: string;
  qty: number;
  harga: number;
}

export interface RabItem {
  deskripsi: string;
  volume: number;
  satuan: string;
  hargaSatuan: number;
}

export interface InvoiceData {
  // Header
  headerStyle: "nama" | "title";
  namaUsaha: string;
  useKopPerusahaan: boolean;
  kopPerusahaan: string;

  // Invoice Info
  nomorInvoice: string;
  tanggalInvoice: string;
  namaPenerima: string;
  alamat: string;

  // Mode
  modeQuantity: boolean;

  // Items
  items: InvoiceItem[];

  // Discount
  useDiskon: boolean;
  diskonTipe: "nominal" | "persen";
  diskonNominal: number;
  diskonPersen: number;

  // PPN
  usePpn: boolean;

  // Terbilang
  showTerbilang: boolean;

  // Footer
  catatan: string;
  namaTtd: string;
}

export interface RabData {
  namaProyek: string;
  nomorRab: string;
  tanggalRab: string;
  lokasi: string;
  namaPemilik: string;

  items: RabItem[];

  catatan: string;
  namaPembuat: string;
  namaPenyetuju: string;
}
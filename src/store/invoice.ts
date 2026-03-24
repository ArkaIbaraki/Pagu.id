'use client';

import { create } from 'zustand';
import { persist } from 'zustand/middleware';
import { InvoiceData, InvoiceItem } from '@/types';

interface InvoiceState extends InvoiceData {
  // Dark Mode
  isDark: boolean;
  setDarkMode: (isDark: boolean) => void;

  // History
  history: InvoiceData[];
  addToHistory: () => void;
  loadFromHistory: (index: number) => void;
  clearHistory: () => void;

  // Actions
  setHeaderStyle: (style: 'nama' | 'title') => void;
  setNamaUsaha: (name: string) => void;
  setUseKopPerusahaan: (use: boolean) => void;
  setKopPerusahaan: (kop: string) => void;

  setNomorInvoice: (no: string) => void;
  regenerateInvoiceNumber: () => void;
  setTanggalInvoice: (date: string) => void;
  setNamaPenerima: (name: string) => void;
  setAlamat: (alamat: string) => void;

  setModeQuantity: (mode: boolean) => void;

  addItem: () => void;
  removeItem: (index: number) => void;
  updateItem: (index: number, item: InvoiceItem) => void;

  setUseDiskon: (use: boolean) => void;
  setDiskonTipe: (tipe: 'nominal' | 'persen') => void;
  setDiskonNominal: (value: number) => void;
  setDiskonPersen: (value: number) => void;

  setUsePpn: (use: boolean) => void;
  setShowTerbilang: (show: boolean) => void;

  setCatatan: (text: string) => void;
  setNamaTtd: (name: string) => void;

  // Computed
  subtotal: () => number;
  diskonValue: () => number;
  afterDiskon: () => number;
  ppnValue: () => number;
  total: () => number;

  reset: () => void;
}

const generateInvoiceNumber = () => {
  const date = new Date().toISOString().slice(0, 10).replace(/-/g, '');
  const random = Math.random().toString(36).substring(2, 6).toUpperCase();
  return `INV-${date}-${random}`;
};

const initialState: InvoiceData = {
  headerStyle: 'nama',
  namaUsaha: '',
  useKopPerusahaan: false,
  kopPerusahaan: '',

  nomorInvoice: generateInvoiceNumber(),
  tanggalInvoice: new Date().toISOString().slice(0, 10),
  namaPenerima: '',
  alamat: '',

  modeQuantity: true,

  items: [{ deskripsi: '', qty: 1, harga: 0 }],

  useDiskon: false,
  diskonTipe: 'nominal',
  diskonNominal: 0,
  diskonPersen: 0,

  usePpn: false,
  showTerbilang: true,

  catatan: '',
  namaTtd: '',
};

export const useInvoiceStore = create<InvoiceState>()(
  persist(
    (set, get) => ({
      ...initialState,
      isDark: false,
      history: [],

      setDarkMode: (isDark) => set({ isDark }),

      addToHistory: () => {
        set((state) => {
          const invoiceData: InvoiceData = {
            headerStyle: state.headerStyle,
            namaUsaha: state.namaUsaha,
            useKopPerusahaan: state.useKopPerusahaan,
            kopPerusahaan: state.kopPerusahaan,
            nomorInvoice: state.nomorInvoice,
            tanggalInvoice: state.tanggalInvoice,
            namaPenerima: state.namaPenerima,
            alamat: state.alamat,
            modeQuantity: state.modeQuantity,
            items: state.items,
            useDiskon: state.useDiskon,
            diskonTipe: state.diskonTipe,
            diskonNominal: state.diskonNominal,
            diskonPersen: state.diskonPersen,
            usePpn: state.usePpn,
            showTerbilang: state.showTerbilang,
            catatan: state.catatan,
            namaTtd: state.namaTtd,
          };
          return {
            history: [invoiceData, ...state.history].slice(0, 10),
          };
        });
      },

      loadFromHistory: (index) => {
        const state = get();
        if (index >= 0 && index < state.history.length) {
          const data = state.history[index];
          set({
            headerStyle: data.headerStyle,
            namaUsaha: data.namaUsaha,
            useKopPerusahaan: data.useKopPerusahaan,
            kopPerusahaan: data.kopPerusahaan,
            nomorInvoice: data.nomorInvoice,
            tanggalInvoice: data.tanggalInvoice,
            namaPenerima: data.namaPenerima,
            alamat: data.alamat,
            modeQuantity: data.modeQuantity,
            items: data.items,
            useDiskon: data.useDiskon,
            diskonTipe: data.diskonTipe,
            diskonNominal: data.diskonNominal,
            diskonPersen: data.diskonPersen,
            usePpn: data.usePpn,
            showTerbilang: data.showTerbilang,
            catatan: data.catatan,
            namaTtd: data.namaTtd,
          });
        }
      },

      clearHistory: () => set({ history: [] }),

      setHeaderStyle: (style) => set({ headerStyle: style }),
      setNamaUsaha: (name) => set({ namaUsaha: name }),
      setUseKopPerusahaan: (use) => set({ useKopPerusahaan: use }),
      setKopPerusahaan: (kop) => set({ kopPerusahaan: kop }),

      setNomorInvoice: (no) => set({ nomorInvoice: no }),
      regenerateInvoiceNumber: () =>
        set({ nomorInvoice: generateInvoiceNumber() }),
      setTanggalInvoice: (date) => set({ tanggalInvoice: date }),
      setNamaPenerima: (name) => set({ namaPenerima: name }),
      setAlamat: (alamat) => set({ alamat }),

      setModeQuantity: (mode) => set({ modeQuantity: mode }),

      addItem: () =>
        set((state) => ({
          items: [...state.items, { deskripsi: '', qty: 1, harga: 0 }],
        })),

      removeItem: (index) =>
        set((state) => ({
          items: state.items.filter((_, i) => i !== index),
        })),

      updateItem: (index, item) =>
        set((state) => {
          const newItems = [...state.items];
          newItems[index] = item;
          return { items: newItems };
        }),

      setUseDiskon: (use) => set({ useDiskon: use }),
      setDiskonTipe: (tipe) => set({ diskonTipe: tipe }),
      setDiskonNominal: (value) => set({ diskonNominal: value }),
      setDiskonPersen: (value) => set({ diskonPersen: value }),

      setUsePpn: (use) => set({ usePpn: use }),
      setShowTerbilang: (show) => set({ showTerbilang: show }),

      setCatatan: (text) => set({ catatan: text }),
      setNamaTtd: (name) => set({ namaTtd: name }),

      subtotal: () => {
        const state = get();
        return state.items.reduce((total, item) => {
          if (state.modeQuantity) {
            return total + item.qty * item.harga;
          }
          return total + item.harga;
        }, 0);
      },

      diskonValue: () => {
        const state = get();
        if (!state.useDiskon) return 0;
        if (state.diskonTipe === 'nominal') {
          return state.diskonNominal;
        }
        return (state.subtotal() * state.diskonPersen) / 100;
      },

      afterDiskon: () => {
        const state = get();
        return state.subtotal() - state.diskonValue();
      },

      ppnValue: () => {
        const state = get();
        if (!state.usePpn) return 0;
        return (state.afterDiskon() * 11) / 100;
      },

      total: () => {
        const state = get();
        return state.afterDiskon() + state.ppnValue();
      },

      reset: () => set(initialState),
    }),
    {
      name: 'invoice-store',
    }
  )
);
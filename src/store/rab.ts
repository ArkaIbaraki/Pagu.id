'use client';

import { create } from 'zustand';
import { persist } from 'zustand/middleware';
import { RabData, RabItem } from '@/types';

interface RabState extends RabData {
  // History
  history: RabData[];
  addToHistory: () => void;
  loadFromHistory: (index: number) => void;
  clearHistory: () => void;

  // Actions
  setNamaProyek: (name: string) => void;
  setNomorRab: (no: string) => void;
  regenerateRabNumber: () => void;
  setTanggalRab: (date: string) => void;
  setLokasi: (lokasi: string) => void;
  setNamaPemilik: (name: string) => void;

  addItem: () => void;
  removeItem: (index: number) => void;
  updateItem: (index: number, item: RabItem) => void;

  setCatatan: (text: string) => void;
  setNamaPembuat: (name: string) => void;
  setNamaPenyetuju: (name: string) => void;

  // Computed
  total: () => number;

  reset: () => void;
}

const generateRabNumber = () => {
  const date = new Date().toISOString().slice(0, 10).replace(/-/g, '');
  const random = Math.random().toString(36).substring(2, 6).toUpperCase();
  return `RAB-${date}-${random}`;
};

const initialState: RabData = {
  namaProyek: '',
  nomorRab: generateRabNumber(),
  tanggalRab: new Date().toISOString().slice(0, 10),
  lokasi: '',
  namaPemilik: '',

  items: [{ deskripsi: '', volume: 1, satuan: 'unit', hargaSatuan: 0 }],

  catatan: '',
  namaPembuat: '',
  namaPenyetuju: '',
};

export const useRabStore = create<RabState>()(
  persist(
    (set, get) => ({
      ...initialState,
      history: [],

      addToHistory: () => {
        set((state) => {
          const rabData: RabData = {
            namaProyek: state.namaProyek,
            nomorRab: state.nomorRab,
            tanggalRab: state.tanggalRab,
            lokasi: state.lokasi,
            namaPemilik: state.namaPemilik,
            items: state.items,
            catatan: state.catatan,
            namaPembuat: state.namaPembuat,
            namaPenyetuju: state.namaPenyetuju,
          };
          return {
            history: [rabData, ...state.history].slice(0, 10),
          };
        });
      },

      loadFromHistory: (index) => {
        const state = get();
        if (index >= 0 && index < state.history.length) {
          const data = state.history[index];
          set({
            namaProyek: data.namaProyek,
            nomorRab: data.nomorRab,
            tanggalRab: data.tanggalRab,
            lokasi: data.lokasi,
            namaPemilik: data.namaPemilik,
            items: data.items,
            catatan: data.catatan,
            namaPembuat: data.namaPembuat,
            namaPenyetuju: data.namaPenyetuju,
          });
        }
      },

      clearHistory: () => set({ history: [] }),

      setNamaProyek: (name) => set({ namaProyek: name }),
      setNomorRab: (no) => set({ nomorRab: no }),
      regenerateRabNumber: () => set({ nomorRab: generateRabNumber() }),
      setTanggalRab: (date) => set({ tanggalRab: date }),
      setLokasi: (lokasi) => set({ lokasi }),
      setNamaPemilik: (name) => set({ namaPemilik: name }),

      addItem: () =>
        set((state) => ({
          items: [
            ...state.items,
            { deskripsi: '', volume: 1, satuan: 'unit', hargaSatuan: 0 },
          ],
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

      setCatatan: (text) => set({ catatan: text }),
      setNamaPembuat: (name) => set({ namaPembuat: name }),
      setNamaPenyetuju: (name) => set({ namaPenyetuju: name }),

      total: () => {
        const state = get();
        return state.items.reduce((total, item) => {
          return total + item.volume * item.hargaSatuan;
        }, 0);
      },

      reset: () => set(initialState),
    }),
    {
      name: 'rab-store',
    }
  )
);
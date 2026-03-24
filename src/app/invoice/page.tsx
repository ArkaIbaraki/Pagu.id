'use client';

import Link from 'next/link';
import { useState, useEffect } from 'react';
import { useInvoiceStore } from '@/store/invoice';
import { InvoiceForm } from '@/components/invoice-form';
import { InvoicePreview } from '@/components/invoice-preview';

export default function InvoicePage() {
  const [mounted, setMounted] = useState(false);
  const isDark = useInvoiceStore((state) => state.isDark);
  const setDarkMode = useInvoiceStore((state) => state.setDarkMode);
  const history = useInvoiceStore((state) => state.history);
  const loadFromHistory = useInvoiceStore((state) => state.loadFromHistory);
  const clearHistory = useInvoiceStore((state) => state.clearHistory);

  useEffect(() => {
    setMounted(true);
  }, []);

  if (!mounted) return null;

  const handleToggleDarkMode = () => {
    setDarkMode(!isDark);
  };

  return (
    <div className="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
      {/* Header */}
      <div className="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-40">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
          <div className="flex items-center space-x-4">
            <Link
              href="/"
              className="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors"
            >
              ← Kembali
            </Link>
            <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
              📋 Invoice Maker
            </h1>
          </div>

          {/* Controls */}
          <div className="flex items-center space-x-4">
            {/* Dark Mode Toggle */}
            <button
              onClick={handleToggleDarkMode}
              className="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-yellow-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
              title={isDark ? 'Light Mode' : 'Dark Mode'}
            >
              {isDark ? '☀️' : '🌙'}
            </button>

            {/* History Dropdown */}
            {history.length > 0 && (
              <div className="relative group">
                <button className="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                  📋 History ({history.length})
                </button>
                <div className="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                  <div className="p-3 max-h-64 overflow-y-auto">
                    {history.map((item, idx) => (
                      <button
                        key={idx}
                        onClick={() => loadFromHistory(idx)}
                        className="w-full text-left px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded text-sm text-gray-700 dark:text-gray-300 mb-1"
                      >
                        <div className="font-semibold">{item.nomorInvoice}</div>
                        <div className="text-xs text-gray-500 dark:text-gray-400">
                          {item.namaUsaha || 'No Name'}
                        </div>
                      </button>
                    ))}
                    <button
                      onClick={clearHistory}
                      className="w-full text-left px-3 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded text-sm mt-2 border-t border-gray-200 dark:border-gray-700"
                    >
                      🗑️ Clear History
                    </button>
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>

      {/* Content */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
          {/* Form */}
          <InvoiceForm />

          {/* Preview */}
          <InvoicePreview />
        </div>
      </div>
    </div>
  );
}
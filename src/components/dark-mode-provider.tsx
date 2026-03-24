'use client';

import { useEffect, useState } from 'react';
import { useInvoiceStore } from '@/store/invoice';

export function DarkModeProvider({ children }: { children: React.ReactNode }) {
  const [mounted, setMounted] = useState(false);
  const isDark = useInvoiceStore((state) => state.isDark);
  const setDarkMode = useInvoiceStore((state) => state.setDarkMode);

  useEffect(() => {
    setMounted(true);
    // Load dark mode preference from localStorage
    const savedDarkMode = localStorage.getItem('isDark');
    if (savedDarkMode !== null) {
      const isDarkMode = JSON.parse(savedDarkMode);
      setDarkMode(isDarkMode);
      applyDarkMode(isDarkMode);
    }
  }, [setDarkMode]);

  const applyDarkMode = (dark: boolean) => {
    if (dark) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  };

  useEffect(() => {
    // Save dark mode preference
    localStorage.setItem('isDark', JSON.stringify(isDark));
    applyDarkMode(isDark);
  }, [isDark]);

  if (!mounted) return null;

  return <>{children}</>;
}
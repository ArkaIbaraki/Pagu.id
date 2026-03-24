import type { Metadata } from 'next';
import { DarkModeProvider } from '@/components/dark-mode-provider';
import './globals.css';

export const metadata: Metadata = {
  title: 'Pagu.id - Invoice & RAB Maker',
  description: 'Pembuat Invoice & RAB Profesional dengan Format Indonesia',
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id" suppressHydrationWarning>
      <body className="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-200">
        <DarkModeProvider>
          {children}
        </DarkModeProvider>
      </body>
    </html>
  );
}
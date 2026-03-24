'use client';

import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';

function applyPdfSafeColorOverrides() {
  const rootStyle = document.documentElement.style;

  // Tailwind v4 color tokens are oklch-based by default; html2canvas cannot parse some of them.
  const safeColorTokens: Record<string, string> = {
    '--color-white': '#ffffff',
    '--color-gray-50': '#f9fafb',
    '--color-gray-100': '#f3f4f6',
    '--color-gray-200': '#e5e7eb',
    '--color-gray-300': '#d1d5db',
    '--color-gray-400': '#9ca3af',
    '--color-gray-500': '#6b7280',
    '--color-gray-600': '#4b5563',
    '--color-gray-700': '#374151',
    '--color-gray-800': '#1f2937',
    '--color-gray-900': '#111827',
    '--color-blue-50': '#eff6ff',
    '--color-blue-200': '#bfdbfe',
    '--color-blue-600': '#2563eb',
    '--color-blue-700': '#1d4ed8',
    '--color-blue-800': '#1e40af',
    '--color-red-600': '#dc2626',
    '--color-red-700': '#b91c1c',
    '--color-green-50': '#f0fdf4',
    '--color-green-200': '#bbf7d0',
    '--color-green-600': '#16a34a',
    '--color-green-700': '#15803d',
    '--color-green-800': '#166534',
  };

  const previousValues = Object.fromEntries(
    Object.keys(safeColorTokens).map((token) => [token, rootStyle.getPropertyValue(token)])
  );

  Object.entries(safeColorTokens).forEach(([token, value]) => {
    rootStyle.setProperty(token, value);
  });

  return () => {
    Object.entries(previousValues).forEach(([token, value]) => {
      if (value) {
        rootStyle.setProperty(token, value);
      } else {
        rootStyle.removeProperty(token);
      }
    });
  };
}

export async function exportToPDF(
  element: HTMLDivElement,
  filename: string = 'document'
) {
  const restoreColors = applyPdfSafeColorOverrides();

  try {
    const canvas = await html2canvas(element, {
      scale: 2,
      allowTaint: true,
      useCORS: true,
    });

    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF('p', 'mm', 'a4');
    const imgWidth = 210;
    const imgHeight = (canvas.height * imgWidth) / canvas.width;

    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

    // Handle multi-page documents
    let heightLeft = imgHeight - 297;
    let position = 0;

    while (heightLeft > 0) {
      position = heightLeft - imgHeight;
      pdf.addPage();
      pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
      heightLeft -= 297;
    }

    const safeFilename = filename.replace(/[\/\\:*?"<>|]/g, '-');
    pdf.save(`${safeFilename}.pdf`);
  } catch (error) {
    console.error('PDF Export Error:', error);
    throw error;
  } finally {
    restoreColors();
  }
}

export function printInvoice() {
  window.print();
}
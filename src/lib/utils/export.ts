'use client';

import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';

export async function exportToPDF(
  element: HTMLDivElement,
  filename: string = 'document'
) {
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
  }
}

export function printInvoice() {
  window.print();
}
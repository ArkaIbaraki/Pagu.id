/**
 * Generate invoice number with format: XXX/INV/RN/YYYY
 * XXX = iteration (001, 002, etc)
 * RN = roman numeral of month (I, II, III, etc)
 * YYYY = year
 */

const romanNumerals = [
  'I',
  'II',
  'III',
  'IV',
  'V',
  'VI',
  'VII',
  'VIII',
  'IX',
  'X',
  'XI',
  'XII',
];

function getRomanMonth(month: number): string {
  return romanNumerals[month - 1];
}

export function getNextInvoiceNumber(lastNumber: string | null, currentDate: Date): string {
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth() + 1;
  const romanMonth = getRomanMonth(month);

  if (!lastNumber) {
    return `001/INV/${romanMonth}/${year}`;
  }

  // Parse last number: XXX/INV/RN/YYYY
  const parts = lastNumber.split('/');
  const lastYear = parseInt(parts[3]);
  const lastMonth = parts[2];

  // If different month or year, reset counter
  if (lastMonth !== romanMonth || lastYear !== year) {
    return `001/INV/${romanMonth}/${year}`;
  }

  // Same month/year, increment counter
  const lastCounter = parseInt(parts[0]);
  const newCounter = String(lastCounter + 1).padStart(3, '0');

  return `${newCounter}/INV/${romanMonth}/${year}`;
}

export function getInvoiceNumberFormonth(date: Date): string {
  const month = date.getMonth() + 1;
  const year = date.getFullYear();
  const romanMonth = getRomanMonth(month);
  return `001/INV/${romanMonth}/${year}`;
}

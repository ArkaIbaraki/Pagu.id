const ones = [
  '',
  'satu',
  'dua',
  'tiga',
  'empat',
  'lima',
  'enam',
  'tujuh',
  'delapan',
  'sembilan',
];

const tens = [
  '',
  '',
  'dua puluh',
  'tiga puluh',
  'empat puluh',
  'lima puluh',
  'enam puluh',
  'tujuh puluh',
  'delapan puluh',
  'sembilan puluh',
];

const scales = [
  '',
  'ribu',
  'juta',
  'miliar',
  'triliun',
  'kuadriliun',
  'kuintiliun',
];

function convertTwoDigits(num: number): string {
  if (num === 0) return '';
  if (num < 10) return ones[num];
  if (num < 20) {
    if (num === 10) return 'sepuluh';
    return 'sepuluh' + (num > 10 ? ' ' + ones[num - 10] : '');
  }
  return tens[Math.floor(num / 10)] + (num % 10 ? ' ' + ones[num % 10] : '');
}

function convertThreeDigits(num: number): string {
  if (num === 0) return '';

  let result = '';

  const hundreds = Math.floor(num / 100);
  if (hundreds > 0) {
    result = (hundreds === 1 ? 'seratus' : ones[hundreds] + ' ratus');
  }

  const remainder = num % 100;
  if (remainder > 0) {
    if (result) result += ' ';
    if (remainder < 10) {
      result += ones[remainder];
    } else if (remainder === 10) {
      result += 'sepuluh';
    } else if (remainder < 20) {
      result += 'sepuluh ' + ones[remainder - 10];
    } else {
      result += tens[Math.floor(remainder / 10)];
      if (remainder % 10) {
        result += ' ' + ones[remainder % 10];
      }
    }
  }

  return result;
}

export function numberToTerbilang(num: number): string {
  if (num === 0) return 'nol';

  const isNegative = num < 0;
  num = Math.abs(Math.floor(num));

  const groups: string[] = [];
  let groupIndex = 0;

  while (num > 0) {
    const group = num % 1000;
    if (group !== 0) {
      const groupText = convertThreeDigits(group);
      const scaled =
        groupIndex === 0 ? groupText : groupText + ' ' + scales[groupIndex];
      groups.unshift(scaled);
    }
    num = Math.floor(num / 1000);
    groupIndex++;
  }

  let result = groups.join(' ');

  // Clean up spacing
  result = result.replace(/\s+/g, ' ').trim();

  if (isNegative) {
    result = 'minus ' + result;
  }

  return result.charAt(0).toUpperCase() + result.slice(1) + ' rupiah';
}

export function formatCurrency(value: number): string {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(value);
}
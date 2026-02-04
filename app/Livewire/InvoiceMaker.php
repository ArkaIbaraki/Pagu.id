<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceMaker extends Component
{
    // Data Invoice
    public $namaUsaha = '';
    public $nomorInvoice;
    public $tanggalInvoice;
    public $namaPenerima = '';
    public $alamat = '';
    
    // Header Style
    public $headerStyle = 'nama'; // 'nama' atau 'title'
    public $useKopPerusahaan = false; // pakai kop/logo atau tidak
    public $kopPerusahaan = ''; // URL logo/kop
    
    // Mode & Opsi
    public $modeQuantity = true; // true = dengan qty, false = tanpa qty
    public $useDiskon = false;
    public $usePpn = false;
    public $showTerbilang = true;
    
    // Diskon
    public $diskonTipe = 'nominal'; // nominal atau persen
    public $diskonNominal = 0;
    public $diskonPersen = 0;
    
    // Items
    public $items = [];
    
    // Footer
    public $catatan = '';
    public $namaTtd = '';
    
    public function mount()
    {
        // Generate nomor invoice otomatis
        $this->nomorInvoice = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $this->tanggalInvoice = date('Y-m-d');
        
        // Add default item
        $this->addItem();
    }
    
    public function regenerateInvoiceNumber()
    {
        $this->nomorInvoice = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
    
    public function addItem()
    {
        $this->items[] = [
            'deskripsi' => '',
            'qty' => 1,
            'harga' => 0
        ];
    }
    
    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Re-index array
    }
    
    #[Computed]
    public function subtotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            if ($this->modeQuantity) {
                $total += (float)($item['qty'] ?? 1) * (float)($item['harga'] ?? 0);
            } else {
                $total += (float)($item['harga'] ?? 0);
            }
        }
        return $total;
    }
    
    #[Computed]
    public function diskonValue()
    {
        if (!$this->useDiskon) {
            return 0;
        }
        
        if ($this->diskonTipe === 'nominal') {
            return (float)($this->diskonNominal ?? 0);
        } else {
            return ($this->subtotal * (float)($this->diskonPersen ?? 0)) / 100;
        }
    }
    
    #[Computed]
    public function afterDiskon()
    {
        return $this->subtotal - $this->diskonValue;
    }
    
    #[Computed]
    public function ppnValue()
    {
        if (!$this->usePpn) {
            return 0;
        }
        
        return ($this->afterDiskon * 11) / 100;
    }
    
    #[Computed]
    public function total()
    {
        return $this->afterDiskon + $this->ppnValue;
    }
    
    #[Computed]
    public function totalTerbilang()
    {
        return terbilang($this->total);
    }
    
    public function generatePdf()
    {
        // Simple validation
        if ($this->headerStyle === 'nama' && empty($this->namaUsaha)) {
            session()->flash('error', 'Nama usaha harus diisi!');
            return;
        }
        
        // Check if at least one item has description
        $hasItem = false;
        foreach ($this->items as $item) {
            if (!empty($item['deskripsi'])) {
                $hasItem = true;
                break;
            }
        }
        
        if (!$hasItem) {
            session()->flash('error', 'Minimal harus ada 1 item dengan deskripsi!');
            return;
        }
        
        $data = [
            'namaUsaha' => $this->namaUsaha,
            'headerStyle' => $this->headerStyle,
            'useKopPerusahaan' => $this->useKopPerusahaan,
            'kopPerusahaan' => $this->kopPerusahaan,
            'nomorInvoice' => $this->nomorInvoice,
            'tanggalInvoice' => $this->tanggalInvoice,
            'namaPenerima' => $this->namaPenerima,
            'alamat' => $this->alamat,
            'modeQuantity' => $this->modeQuantity,
            'items' => $this->items,
            'subtotal' => $this->subtotal,
            'useDiskon' => $this->useDiskon,
            'diskonValue' => $this->diskonValue,
            'afterDiskon' => $this->afterDiskon,
            'usePpn' => $this->usePpn,
            'ppnValue' => $this->ppnValue,
            'total' => $this->total,
            'showTerbilang' => $this->showTerbilang,
            'totalTerbilang' => $this->totalTerbilang,
            'catatan' => $this->catatan,
            'namaTtd' => $this->namaTtd,
        ];
        
        $pdf = Pdf::loadView('pdf.invoice', $data);
        $filename = 'invoice-' . str_replace(['/', '\\'], '-', $this->nomorInvoice) . '.pdf';
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }
    
    public function render()
    {
        return view('livewire.invoice-maker')->layout('layouts.app');
    }
}

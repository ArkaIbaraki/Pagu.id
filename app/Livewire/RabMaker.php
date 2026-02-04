<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Barryvdh\DomPDF\Facade\Pdf;

class RabMaker extends Component
{
    // Data RAB
    public $namaProyek = '';
    public $nomorRab;
    public $tanggalRab;
    public $lokasi = '';
    public $namaPemilik = '';
    
    // Items RAB (lebih detail)
    public $items = [];
    
    // Footer
    public $catatan = '';
    public $namaPembuat = '';
    public $namaPenyetuju = '';
    
    public function mount()
    {
        // Generate nomor RAB otomatis
        $this->nomorRab = 'RAB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $this->tanggalRab = date('Y-m-d');
        
        // Add default item
        $this->addItem();
    }
    
    public function regenerateRabNumber()
    {
        $this->nomorRab = 'RAB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
    
    public function addItem()
    {
        $this->items[] = [
            'deskripsi' => '',
            'volume' => 1,
            'satuan' => 'unit',
            'hargaSatuan' => 0
        ];
    }
    
    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
    
    #[Computed]
    public function total()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += (float)($item['volume'] ?? 1) * (float)($item['hargaSatuan'] ?? 0);
        }
        return $total;
    }
    
    public function generatePdf()
    {
        // Simple validation
        if (empty($this->namaProyek)) {
            session()->flash('error', 'Nama proyek harus diisi!');
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
            'namaProyek' => $this->namaProyek,
            'nomorRab' => $this->nomorRab,
            'tanggalRab' => $this->tanggalRab,
            'lokasi' => $this->lokasi,
            'namaPemilik' => $this->namaPemilik,
            'items' => $this->items,
            'total' => $this->total,
            'catatan' => $this->catatan,
            'namaPembuat' => $this->namaPembuat,
            'namaPenyetuju' => $this->namaPenyetuju,
        ];
        
        $pdf = Pdf::loadView('pdf.rab', $data)->setPaper('a4', 'portrait');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'rab-' . $this->nomorRab . '.pdf');
    }
    
    public function render()
    {
        return view('livewire.rab-maker')->layout('layouts.app');
    }
}

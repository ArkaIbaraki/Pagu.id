<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\InvoiceMaker;
use App\Livewire\RabMaker;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/invoice', InvoiceMaker::class)->name('invoice.maker');
Route::get('/rab', RabMaker::class)->name('rab.maker');

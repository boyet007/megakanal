<?php

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('index');
});

Route::get('/form-pesan', function () {
    $nomor = Pesanan::getOrderNumber();
    return view('pesan', compact('nomor'));
});

Route::post('/pesan', function (Request $request) {
    $request->validate([
        'nm_supplier' => 'required|string|max:50',
    ]);

    Pesanan::create([
        'no_pesanan' => $request->no_pesanan,
        'tanggal' => $request->tanggal,
        'nm_supplier' => $request->nm_supplier,
        'nm_produk' => $request->nm_produk,
        'total' => $request->total,
    ]);

    return redirect('/')->with('success', 'Order berhasil disimpan.');
});

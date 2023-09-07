@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-5 p-2" style="border:1px solid black;">
        <form action="/pesan" method="POST">
            @csrf
            <div class="row mb-1">
                <label for="noPesanan" class="col-sm-4 col-form-label">No Pesanan</label>
                <div class="col-sm-8">
                    <input type="text" name="no_pesanan" readonly class="form-control" id="noPesanan" value="{{ $nomor }}">
                </div>
            </div>
            <div class="row mb-1">
                <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                <div class="col-sm-8">
                    <input type="text" readonly name="tanggal" class="form-control" id="tanggal" value="{{ request('tanggal') }}">
                </div>
            </div>
            <div class="row mb-1">
                <label for="nmSupplier" class="col-sm-4 col-form-label">Nama Supplier</label>
                <div class="col-sm-8">
                    <input type="text" name="nm_supplier" class="form-control @error('nm_supplier') is-invalid @enderror" value="{{ old('nm_supplier') }}" id="nmSupplier">
                    @error('nm_supplier')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-1">
                <label for="nmProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                <div class="col-sm-8">
                    <input type="text" name="nm_produk" readonly class="form-control" id="nmProduk" value="{{ request('nm_produk') }}">
                </div>
            </div>
            <div class="row mb-1">
                <label for="total" class="col-sm-4 col-form-label">Total</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="total" readonly class="form-control text-end" id="total" value="{{ request('total') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

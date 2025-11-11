@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="card">
    <div class="flex justify-between">
        <h2>➕ Tambah Produk Baru</h2>
        <a href="{{ route('products.index') }}" class="btn">Kembali</a>
    </div>
    
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Kode Produk *</label>
            <input type="text" name="code" value="{{ old('code') }}" required placeholder="Contoh: BRG001">
            @error('code')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Sabun Mandi">
            @error('name')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" placeholder="Contoh: Kebutuhan Rumah">
            @error('category')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Harga *</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" required placeholder="15000">
                @error('price')
                    <small style="color: #e74c3c;">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Stok *</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required placeholder="100">
                @error('stock')
                    <small style="color: #e74c3c;">{{ $message }}</small>
                @enderror
            </div>
        </div>
        
        <div class="text-right">
            <button type="submit" class="btn btn-success">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="card">
    <div class="flex justify-between">
        <h2>✏️ Edit Produk</h2>
        <a href="{{ route('products.index') }}" class="btn">Kembali</a>
    </div>
    
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Kode Produk *</label>
            <input type="text" name="code" value="{{ old('code', $product->code) }}" required>
            @error('code')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="category" value="{{ old('category', $product->category) }}">
            @error('category')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Harga *</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                @error('price')
                    <small style="color: #e74c3c;">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Stok *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
                @error('stock')
                    <small style="color: #e74c3c;">{{ $message }}</small>
                @enderror
            </div>
        </div>
        
        <div class="text-right">
            <button type="submit" class="btn btn-success">Update Produk</button>
        </div>
    </form>
</div>
@endsection

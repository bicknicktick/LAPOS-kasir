@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="card">
    <div class="flex justify-between">
        <h2>📦 Daftar Produk</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success">+ Tambah Produk</a>
    </div>
    
    @if($products->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category ?? '-' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; background: {{ $product->stock < 10 ? '#ffebee' : '#e8f5e9' }}; color: {{ $product->stock < 10 ? '#c62828' : '#2e7d32' }}; border-radius: 4px;">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center" style="padding: 2rem; color: #999;">Belum ada produk. Tambahkan produk terlebih dahulu.</p>
    @endif
</div>
@endsection

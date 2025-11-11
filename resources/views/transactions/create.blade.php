@extends('layouts.app')

@section('title', 'Kasir')

@section('content')
<div class="card">
    <h2>💰 Kasir</h2>
    
    <form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
        @csrf
        
        <!-- Pencarian Produk -->
        <div class="form-group">
            <label>Cari Produk (Nama / Kode)</label>
            <input type="text" id="searchProduct" placeholder="Ketik untuk mencari produk...">
        </div>
        
        <div id="searchResults" style="margin-bottom: 1rem;"></div>
        
        <!-- Daftar Produk Terpilih -->
        <div style="margin: 2rem 0;">
            <h3>Keranjang Belanja</h3>
            <table id="cartTable">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th style="width: 150px;">Qty</th>
                        <th>Subtotal</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <tr id="emptyCart">
                        <td colspan="5" class="text-center">Keranjang masih kosong</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><strong>TOTAL:</strong></td>
                        <td colspan="2"><strong id="totalAmount">Rp 0</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <!-- Pembayaran -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="payment_method" id="paymentMethod" required>
                    <option value="tunai">Tunai</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Jumlah Bayar</label>
                <input type="number" name="paid_amount" id="paidAmount" step="0.01" required>
            </div>
        </div>
        
        <div id="changeAmount" style="margin: 1rem 0; padding: 1rem; background: #f8f9fa; border-radius: 4px; display: none;">
            <strong>Kembalian: <span id="changeValue">Rp 0</span></strong>
        </div>
        
        <div class="text-right">
            <button type="submit" class="btn btn-success" id="submitBtn" disabled>Proses Transaksi</button>
        </div>
    </form>
</div>

@push('styles')
<style>
    #searchResults {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: none;
    }
    
    .search-item {
        padding: 0.75rem;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .search-item:hover {
        background: #f8f9fa;
    }
    
    .search-item:last-child {
        border-bottom: none;
    }
    
    .qty-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .qty-control button {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        border-radius: 4px;
    }
    
    .qty-control button:hover {
        background: #f8f9fa;
    }
    
    .qty-control input {
        width: 60px;
        text-align: center;
        padding: 0.25rem;
    }
</style>
@endpush

@push('scripts')
<script>
    let cart = [];
    let products = @json($products);
    
    // Format currency
    function formatRupiah(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
    }
    
    // Search product
    document.getElementById('searchProduct').addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const resultsDiv = document.getElementById('searchResults');
        
        if (query.length < 2) {
            resultsDiv.style.display = 'none';
            return;
        }
        
        const filtered = products.filter(p => 
            p.name.toLowerCase().includes(query) || 
            p.code.toLowerCase().includes(query)
        );
        
        if (filtered.length > 0) {
            resultsDiv.innerHTML = filtered.map(p => `
                <div class="search-item" onclick="addToCart(${p.id})">
                    <strong>${p.name}</strong> (${p.code})<br>
                    <small>Harga: ${formatRupiah(p.price)} | Stok: ${p.stock}</small>
                </div>
            `).join('');
            resultsDiv.style.display = 'block';
        } else {
            resultsDiv.innerHTML = '<div class="search-item">Produk tidak ditemukan</div>';
            resultsDiv.style.display = 'block';
        }
    });
    
    // Add to cart
    function addToCart(productId) {
        const product = products.find(p => p.id === productId);
        if (!product) return;
        
        const existingItem = cart.find(item => item.product_id === productId);
        
        if (existingItem) {
            if (existingItem.quantity < product.stock) {
                existingItem.quantity++;
            } else {
                alert('Stok tidak mencukupi');
                return;
            }
        } else {
            cart.push({
                product_id: productId,
                name: product.name,
                price: product.price,
                quantity: 1,
                stock: product.stock
            });
        }
        
        document.getElementById('searchProduct').value = '';
        document.getElementById('searchResults').style.display = 'none';
        
        renderCart();
    }
    
    // Remove from cart
    function removeFromCart(productId) {
        cart = cart.filter(item => item.product_id !== productId);
        renderCart();
    }
    
    // Update quantity
    function updateQuantity(productId, quantity) {
        const item = cart.find(item => item.product_id === productId);
        if (!item) return;
        
        if (quantity < 1) {
            removeFromCart(productId);
            return;
        }
        
        if (quantity > item.stock) {
            alert('Stok tidak mencukupi');
            return;
        }
        
        item.quantity = quantity;
        renderCart();
    }
    
    // Render cart
    function renderCart() {
        const tbody = document.getElementById('cartItems');
        const emptyCart = document.getElementById('emptyCart');
        
        if (cart.length === 0) {
            emptyCart.style.display = 'table-row';
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('totalAmount').textContent = formatRupiah(0);
            return;
        }
        
        emptyCart.style.display = 'none';
        
        tbody.innerHTML = cart.map(item => {
            const subtotal = item.price * item.quantity;
            return `
                <tr>
                    <td>${item.name}</td>
                    <td>${formatRupiah(item.price)}</td>
                    <td>
                        <div class="qty-control">
                            <button type="button" onclick="updateQuantity(${item.product_id}, ${item.quantity - 1})">-</button>
                            <input type="number" value="${item.quantity}" 
                                   onchange="updateQuantity(${item.product_id}, parseInt(this.value))"
                                   min="1" max="${item.stock}">
                            <button type="button" onclick="updateQuantity(${item.product_id}, ${item.quantity + 1})">+</button>
                        </div>
                        <input type="hidden" name="items[${item.product_id}][product_id]" value="${item.product_id}">
                        <input type="hidden" name="items[${item.product_id}][quantity]" value="${item.quantity}">
                    </td>
                    <td>${formatRupiah(subtotal)}</td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="removeFromCart(${item.product_id})">Hapus</button>
                    </td>
                </tr>
            `;
        }).join('');
        
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        document.getElementById('totalAmount').textContent = formatRupiah(total);
        document.getElementById('submitBtn').disabled = false;
        
        calculateChange();
    }
    
    // Calculate change
    function calculateChange() {
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const paid = parseFloat(document.getElementById('paidAmount').value) || 0;
        const method = document.getElementById('paymentMethod').value;
        
        if (method === 'tunai' && paid > 0) {
            const change = paid - total;
            document.getElementById('changeAmount').style.display = 'block';
            document.getElementById('changeValue').textContent = formatRupiah(Math.max(0, change));
        } else {
            document.getElementById('changeAmount').style.display = 'none';
        }
    }
    
    document.getElementById('paidAmount').addEventListener('input', calculateChange);
    document.getElementById('paymentMethod').addEventListener('change', calculateChange);
    
    // Form validation
    document.getElementById('transactionForm').addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert('Keranjang masih kosong');
            return;
        }
        
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const paid = parseFloat(document.getElementById('paidAmount').value);
        
        if (paid < total) {
            e.preventDefault();
            alert('Jumlah pembayaran kurang dari total');
            return;
        }
    });
</script>
@endpush
@endsection

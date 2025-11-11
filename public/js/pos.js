// POS System JavaScript
let cart = {};
let products = {};
let isRedenominated = false;
let paymentMethod = 'tunai';

// Currency formatter
function formatCurrency(amount) {
    if (isRedenominated) {
        amount = amount / 1000;
        return 'Rp ' + amount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    } else {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
}

// Parse currency input - ALWAYS in redenominated format (user inputs 100 for Rp 100.000)
function parseCurrency(value) {
    if (typeof value === 'string') {
        value = value.replace(/[^\d.,]/g, '').replace(/\./g, '').replace(',', '.');
    }
    value = parseFloat(value) || 0;
    
    // ALWAYS multiply by 1000 because input is always in redenominated format
    return value * 1000;
}

// Search products
document.getElementById('searchProduct').addEventListener('input', function(e) {
    const query = e.target.value;
    if (query.length < 2) {
        document.getElementById('searchResults').innerHTML = '';
        return;
    }
    
    fetch(`/products/search/api?q=${query}`)
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(product => {
                products[product.id] = product;
                
                const stockClass = product.stock < 10 ? 'stock-low' : '';
                const stockBadge = product.stock < 10 ? '<span class="stock-badge low">' + product.stock + '</span>' : '<span class="stock-badge">' + product.stock + '</span>';
                
                html += `
                    <div class="product-card" onclick="addToCart(${product.id})">
                        ${stockBadge}
                        <svg class="product-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6.142 4.56L9.75 8.25m4.5 0-.142 3.81m5.892.69-6-1.871M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        <div class="product-name">${product.name}</div>
                        <div class="product-code">${product.code}</div>
                        <div class="product-price">${formatCurrency(product.price)}</div>
                    </div>
                `;
            });
            document.getElementById('searchResults').innerHTML = html || '<p style="text-align: center; color: var(--text-muted); padding: 20px;">No products found</p>';
        });
});

// Add to cart
function addToCart(productId) {
    const product = products[productId];
    if (!product) return;
    
    if (cart[productId]) {
        if (cart[productId].quantity >= product.stock) {
            alert('Stock limit reached!');
            return;
        }
        cart[productId].quantity++;
    } else {
        cart[productId] = {
            ...product,
            quantity: 1
        };
    }
    
    updateCart();
    document.getElementById('searchProduct').value = '';
    document.getElementById('searchResults').innerHTML = '';
    document.getElementById('searchProduct').focus();
}

// Update cart display
function updateCart() {
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    let html = '';
    let count = 0;
    let subtotal = 0;
    
    for (let id in cart) {
        const item = cart[id];
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        count += item.quantity;
        
        html += `
            <div class="cart-item">
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">${formatCurrency(item.price)} × ${item.quantity} = ${formatCurrency(itemTotal)}</div>
                </div>
                <div class="cart-item-controls">
                    <button class="qty-btn" onclick="decreaseQty(${id})">−</button>
                    <input type="number" class="qty-input" value="${item.quantity}" min="1" max="${item.stock}" onchange="updateQty(${id}, this.value)">
                    <button class="qty-btn" onclick="increaseQty(${id})">+</button>
                    <button class="qty-btn remove" onclick="removeFromCart(${id})">×</button>
                </div>
            </div>
        `;
    }
    
    if (count === 0) {
        html = `
            <div class="empty-cart">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <div class="empty-cart-text">Cart is empty</div>
            </div>
        `;
    }
    
    cartItems.innerHTML = html;
    cartCount.textContent = count + ' item' + (count !== 1 ? 's' : '');
    
    // Update totals
    const tax = subtotal * 0.1;
    const total = subtotal + tax;
    
    document.getElementById('subtotal').textContent = formatCurrency(subtotal);
    document.getElementById('tax').textContent = formatCurrency(tax);
    document.getElementById('totalAmount').textContent = formatCurrency(total);
    
    updateHiddenInputs();
    checkCanCheckout();
}

// Quantity controls
function increaseQty(id) {
    if (cart[id] && cart[id].quantity < cart[id].stock) {
        cart[id].quantity++;
        updateCart();
    }
}

function decreaseQty(id) {
    if (cart[id] && cart[id].quantity > 1) {
        cart[id].quantity--;
        updateCart();
    }
}

function updateQty(id, value) {
    value = parseInt(value);
    if (cart[id] && value > 0 && value <= cart[id].stock) {
        cart[id].quantity = value;
        updateCart();
    }
}

function removeFromCart(id) {
    delete cart[id];
    updateCart();
}

// Payment methods
document.querySelectorAll('.payment-method').forEach(method => {
    method.addEventListener('click', function() {
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
        this.classList.add('active');
        paymentMethod = this.dataset.method === 'card' ? 'transfer' : 'tunai';
        document.getElementById('paymentMethodInput').value = paymentMethod;
        
        if (paymentMethod === 'transfer') {
            const total = calculateTotal();
            // Input always in redenominated format (divided by 1000)
            document.getElementById('paymentAmount').value = total / 1000;
            calculateChange();
        }
    });
});

// Payment amount input
document.getElementById('paymentAmount').addEventListener('input', calculateChange);

function calculateChange() {
    const total = calculateTotal();
    const paid = parseCurrency(document.getElementById('paymentAmount').value);
    const change = paid - total;
    
    document.getElementById('changeAmount').textContent = change >= 0 ? formatCurrency(change) : formatCurrency(0);
    document.getElementById('paidAmountInput').value = paid;
    
    checkCanCheckout();
}

function calculateTotal() {
    let subtotal = 0;
    for (let id in cart) {
        subtotal += cart[id].price * cart[id].quantity;
    }
    return subtotal + (subtotal * 0.1);
}

function checkCanCheckout() {
    const total = calculateTotal();
    const paid = parseCurrency(document.getElementById('paymentAmount').value || '0');
    const hasItems = Object.keys(cart).length > 0;
    const enoughPayment = paid >= total;
    
    document.getElementById('checkoutBtn').disabled = !hasItems || !enoughPayment;
}

// Update hidden inputs for form submission
function updateHiddenInputs() {
    let html = '';
    for (let id in cart) {
        html += `
            <input type="hidden" name="items[${id}][product_id]" value="${id}">
            <input type="hidden" name="items[${id}][quantity]" value="${cart[id].quantity}">
            <input type="hidden" name="items[${id}][price]" value="${cart[id].price}">
        `;
    }
    
    // Add currency mode
    html += `<input type="hidden" name="currency_mode" value="${isRedenominated ? 'redenominated' : 'standard'}">`;
    
    document.getElementById('cartItemsInput').innerHTML = html;
}

// Redenomination toggle
document.getElementById('redenominationToggle').addEventListener('click', function() {
    isRedenominated = !isRedenominated;
    this.classList.toggle('active');
    
    if (isRedenominated) {
        document.getElementById('currencyInfo').textContent = 'Redenominated: Rp 1';
    } else {
        document.getElementById('currencyInfo').textContent = 'Standard: Rp 1.000';
    }
    
    updateCart();
    calculateChange();
});

// Form submission
document.getElementById('transactionForm').addEventListener('submit', function(e) {
    const total = calculateTotal();
    const paid = parseCurrency(document.getElementById('paymentAmount').value);
    
    if (paid < total) {
        e.preventDefault();
        alert('Payment amount is insufficient!');
        return false;
    }
    
    if (Object.keys(cart).length === 0) {
        e.preventDefault();
        alert('Cart is empty!');
        return false;
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchProduct').focus();
});

<div align="center">

# 🛒 LAPOS - Modern Point of Sale System

<img src="public/favicon.svg" alt="LAPOS Logo" width="120" height="120" />

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

<p align="center">
  <strong>A modern, elegant, and efficient Point of Sale system built with Laravel</strong>
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#installation">Installation</a> •
  <a href="#usage">Usage</a> •
  <a href="#screenshots">Screenshots</a> •
  <a href="#support">Support</a>
</p>

---

### 🌟 Powered by [e.bitzy.id](https://e.bitzy.id)

</div>

## ✨ Features

<table>
<tr>
<td width="50%">

### 💼 Business Features
- 📦 **Product Management** - Add, edit, delete products with stock tracking
- 💰 **POS System** - Fast and intuitive checkout interface
- 📊 **Reports** - Comprehensive sales reporting
- 💳 **Multiple Payment Methods** - Cash and card support
- 🔄 **Currency Redenomination** - Ready for Indonesian Rupiah redenomination

</td>
<td width="50%">

### 🛠 Technical Features
- ⚡ **Lightning Fast** - Optimized for speed
- 📱 **Responsive Design** - Works on all devices
- 🔒 **Secure** - Built with security best practices
- 🎨 **Modern UI** - Clean and professional interface
- 🌐 **API Ready** - RESTful API for integrations

</td>
</tr>
</table>

## 🚀 Installation

### Prerequisites

- PHP >= 8.1
- Composer
- SQLite3
- Node.js & NPM (optional for assets)

### Quick Start

```bash
# Clone the repository
git clone https://github.com/bicknicktick/LAPOS-kasir.git
cd LAPOS-kasir

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database
touch database/database.sqlite

# Run migrations and seeders
php artisan migrate --seed

# Start the development server
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## 💻 Usage

### Default Access
Open your browser and navigate to the homepage. Click "Enter Application" to access the POS system.

### Main Features

#### 🛍️ Point of Sale
1. Search products by name or code
2. Add items to cart
3. Adjust quantities
4. Select payment method
5. Complete checkout

#### 📦 Product Management
- Navigate to **Inventory** to manage products
- Add new products with name, code, price, and stock
- Edit existing products
- Track stock levels with visual indicators

#### 📈 Reports
- View all transactions
- Filter by date
- Export reports
- Print receipts

## 📸 Screenshots

<div align="center">
<table>
<tr>
<td align="center">
<strong>Homepage</strong><br>
<img src="https://via.placeholder.com/300x200?text=Homepage" alt="Homepage" width="300"/>
</td>
<td align="center">
<strong>POS Interface</strong><br>
<img src="https://via.placeholder.com/300x200?text=POS+Interface" alt="POS Interface" width="300"/>
</td>
</tr>
<tr>
<td align="center">
<strong>Product Management</strong><br>
<img src="https://via.placeholder.com/300x200?text=Products" alt="Products" width="300"/>
</td>
<td align="center">
<strong>Reports</strong><br>
<img src="https://via.placeholder.com/300x200?text=Reports" alt="Reports" width="300"/>
</td>
</tr>
</table>
</div>

## 🔧 Configuration

### Environment Variables

Key configuration options in `.env`:

```env
APP_NAME="LAPOS"
APP_ENV=production
APP_DEBUG=false

DB_CONNECTION=sqlite
CURRENCY_REDENOMINATION=false
CURRENCY_SYMBOL=Rp
```

### Currency Redenomination

To enable currency redenomination (remove 3 zeros from Indonesian Rupiah):

```env
CURRENCY_REDENOMINATION=true
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 💖 Support Development

<div align="center">

If you find LAPOS useful, please consider supporting the development:

<a href="https://paypal.me/bitzyid" target="_blank">
  <img src="https://img.shields.io/badge/Donate-PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white" alt="Donate with PayPal" />
</a>

Every contribution helps maintain and improve LAPOS! 

⭐ Don't forget to star this repository if you find it helpful!

</div>

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- Icons from [Heroicons](https://heroicons.com)
- Font: [Inter](https://fonts.google.com/specimen/Inter)

## 📞 Contact

<div align="center">

### Developed with ❤️ by [e.bitzy.id](https://e.bitzy.id)

For support, feature requests, or business inquiries:

📧 Email: support@e.bitzy.id  
🌐 Website: [https://e.bitzy.id](https://e.bitzy.id)  
💰 Donate: [PayPal.me/bitzyid](https://paypal.me/bitzyid)

---

<sub>© 2024 LAPOS - Powered by e.bitzy.id. All rights reserved.</sub>

</div>

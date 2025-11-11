<div align="center">

<img src="public/favicon.svg" alt="LAPOS Logo" width="140" height="140" />

# LAPOS
### 🏪 Modern Point of Sale System

<p align="center">
  <strong>Professional, Clean, and Efficient POS System for Retail Businesses</strong>
</p>

<p align="center">
  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel">
  </a>
  <a href="https://php.net">
    <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
  </a>
  <a href="https://sqlite.org">
    <img src="https://img.shields.io/badge/SQLite-3-003B57?style=flat-square&logo=sqlite&logoColor=white" alt="SQLite">
  </a>
  <a href="LICENSE">
    <img src="https://img.shields.io/badge/License-MIT-16a085?style=flat-square" alt="License">
  </a>
</p>

<p align="center">
  <a href="https://github.com/bicknicktick/LAPOS-kasir/stargazers">
    <img src="https://img.shields.io/github/stars/bicknicktick/LAPOS-kasir?style=social" alt="Stars">
  </a>
  <a href="https://github.com/bicknicktick/LAPOS-kasir/network/members">
    <img src="https://img.shields.io/github/forks/bicknicktick/LAPOS-kasir?style=social" alt="Forks">
  </a>
  <a href="https://github.com/bicknicktick/LAPOS-kasir/issues">
    <img src="https://img.shields.io/github/issues/bicknicktick/LAPOS-kasir?style=flat-square" alt="Issues">
  </a>
</p>

<p align="center">
  <a href="#-features">Features</a> •
  <a href="#-installation">Installation</a> •
  <a href="#-usage">Usage</a> •
  <a href="#-screenshots">Screenshots</a> •
  <a href="#-contributing">Contributing</a> •
  <a href="#-support">Support</a>
</p>

<br>

<p align="center">
  <a href="https://e.bitzy.id">
    <img src="https://img.shields.io/badge/🚀_Powered_by-e.bitzy.id-16a085?style=for-the-badge" alt="Powered by e.bitzy.id">
  </a>
</p>

<p align="center">
  <a href="https://paypal.me/bitzyid">
    <img src="https://img.shields.io/badge/💖_Support_Development-Donate_via_PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white" alt="Donate">
  </a>
</p>

---

</div>

## ✨ Features

<table>
<tr>
<td width="50%">

### 💼 Business Features
- 📦 **Product Management** - Add, edit, delete products with stock tracking
- 💰 **POS System** - Fast and intuitive checkout interface
- 📊 **Reports** - Comprehensive sales reporting with export
- **Export to PDF** - Elegant minimalist report design
- **Export to Excel** - Detailed transaction data
- **Date Filtering** - Custom date range reports
- **Summary Dashboard** - Total revenue, cash, card payments
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

<div align="center">

### 📋 Prerequisites

<table>
  <tr>
    <td align="center">
      <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php" alt="PHP"><br>
      <sub>PHP 8.1 or higher</sub>
    </td>
    <td align="center">
      <img src="https://img.shields.io/badge/Composer-Latest-885630?style=flat-square&logo=composer" alt="Composer"><br>
      <sub>Dependency Manager</sub>
    </td>
    <td align="center">
      <img src="https://img.shields.io/badge/SQLite-3-003B57?style=flat-square&logo=sqlite" alt="SQLite"><br>
      <sub>Database</sub>
    </td>
  </tr>
</table>

</div>

### ⚡ Quick Start

```bash
# 1️⃣ Clone the repository
git clone https://github.com/bicknicktick/LAPOS-kasir.git
cd LAPOS-kasir

# 2️⃣ Install dependencies
composer install

# 3️⃣ Setup environment
cp .env.example .env
php artisan key:generate

# 4️⃣ Create database
touch database/database.sqlite

# 5️⃣ Run migrations & seed data
php artisan migrate --seed

# 6️⃣ Start the server
php artisan serve
```

<div align="center">

🎉 **Done!** Visit `http://localhost:8000` in your browser

<br>

<img src="https://img.shields.io/badge/⏱️_Setup_Time-5_Minutes-16a085?style=for-the-badge" alt="Setup Time">

</div>

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
<td align="center" colspan="2">
<strong>Homepage - Clean & Minimalist</strong><br>
<img src="ui/homepage.png" alt="Homepage" width="600"/>
</td>
</tr>
<tr>
<td align="center">
<strong>POS - Normal Rupiah Format</strong><br>
<img src="ui/transaksi-rupiah-normal.png" alt="Normal Rupiah" width="400"/>
</td>
<td align="center">
<strong>POS - Redenominated Currency</strong><br>
<img src="ui/transaksi-redom.png" alt="Redenominated" width="400"/>
</td>
</tr>
</table>

### Key Features Shown:
- ✅ **Clean Homepage** - Minimalist design without flashy colors
- ✅ **Currency Toggle** - Switch between normal (Rp 1.000) and redenominated (Rp 1.00)
- ✅ **Real-time Search** - Fast product search with stock indicators
- ✅ **Professional Interface** - Clean, functional design like US supermarkets

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

<h3>Love LAPOS? Support the Project!</h3>

<p>Your support helps us maintain and improve LAPOS with new features and updates.</p>

<br>

<a href="https://paypal.me/bitzyid" target="_blank">
  <img src="https://img.shields.io/badge/💳_Donate-PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white" alt="Donate with PayPal" />
</a>

<br><br>

<table>
  <tr>
    <td align="center" width="33%">
      <img src="https://img.shields.io/badge/⭐-Star_on_GitHub-yellow?style=flat-square" alt="Star"><br>
      <sub>Give us a star</sub>
    </td>
    <td align="center" width="33%">
      <img src="https://img.shields.io/badge/🍴-Fork_Project-blue?style=flat-square" alt="Fork"><br>
      <sub>Fork and contribute</sub>
    </td>
    <td align="center" width="33%">
      <img src="https://img.shields.io/badge/💬-Share_Feedback-green?style=flat-square" alt="Feedback"><br>
      <sub>Report issues</sub>
    </td>
  </tr>
</table>

<br>

### 🎁 Why Donate?

- ☕ **Buy me a coffee** - Keep the developer caffeinated
- 🚀 **Faster updates** - More time for development
- 🐛 **Bug fixes** - Priority support for donors
- ✨ **New features** - Your suggestions come first

<br>

<p><em>Every contribution, no matter how small, makes a difference!</em></p>

</div>

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- Icons from [Heroicons](https://heroicons.com)
- Font: [Inter](https://fonts.google.com/specimen/Inter)

## 📞 Contact & Links

<div align="center">

<br>

<table>
  <tr>
    <td align="center">
      <a href="https://e.bitzy.id">
        <img src="https://img.shields.io/badge/🌐_Website-e.bitzy.id-16a085?style=for-the-badge" alt="Website">
      </a>
    </td>
    <td align="center">
      <a href="mailto:support@e.bitzy.id">
        <img src="https://img.shields.io/badge/📧_Email-support@e.bitzy.id-2c3e50?style=for-the-badge" alt="Email">
      </a>
    </td>
  </tr>
  <tr>
    <td align="center">
      <a href="https://github.com/bicknicktick/LAPOS-kasir">
        <img src="https://img.shields.io/badge/💻_GitHub-LAPOS--kasir-181717?style=for-the-badge&logo=github" alt="GitHub">
      </a>
    </td>
    <td align="center">
      <a href="https://paypal.me/bitzyid">
        <img src="https://img.shields.io/badge/💰_Donate-PayPal-00457C?style=for-the-badge&logo=paypal" alt="PayPal">
      </a>
    </td>
  </tr>
</table>

<br>

### 💼 Need Custom Development?

<p>We offer custom POS solutions tailored to your business needs.</p>

<a href="mailto:support@e.bitzy.id?subject=Custom%20POS%20Development">
  <img src="https://img.shields.io/badge/📩_Contact_Us-For_Custom_Solutions-16a085?style=for-the-badge" alt="Contact">
</a>

<br><br>

---

<br>

<p>
  <strong>Developed with ❤️ by <a href="https://e.bitzy.id">e.bitzy.id</a></strong>
</p>

<p>
  <img src="https://img.shields.io/badge/Made_with-Laravel-FF2D20?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Made_with-PHP-777BB4?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Made_with-Love-e74c3c?style=flat-square&logo=heart" alt="Love">
</p>

<br>

<sub>© 2024 LAPOS - Powered by e.bitzy.id. All rights reserved.</sub>

<br><br>

<a href="#lapos">
  <img src="https://img.shields.io/badge/⬆️_Back_to_Top-16a085?style=flat-square" alt="Back to Top">
</a>

</div>

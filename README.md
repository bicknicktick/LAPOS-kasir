<div align="center">
  <img src="public/favicon.svg" alt="LAPOS Logo" width="120" height="120" />

# LAPOS ERP
### 🏪 Enterprise-Grade POS & Micro-Retail Business Engine

<p align="center">
  <strong>Not just a POS. A full-scale Business Engine featuring HRIS, Payroll, Customer CRM, Stock Opname, and NLP AI Analytics. Built for Speed, Scale, and Absolute Data Integrity.</strong>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP"></a>
  <img src="https://img.shields.io/badge/DB-PostgreSQL_|_MySQL-003B57?style=flat-square&logo=postgresql&logoColor=white" alt="Database">
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-16a085?style=flat-square" alt="License"></a>
</p>

<p align="center">
  <a href="#-the-engineering-manifesto">Architecture</a> •
  <a href="#-modul-utama">Modules</a> •
  <a href="#-quick-start">Quick Start</a> •
  <a href="#-security--concurrency">Security</a> •
  <a href="#-troubleshooting">Troubleshooting</a>
</p>

<a href="https://e.bitzy.id"><img src="https://img.shields.io/badge/🚀_Powered_by-e.bitzy.id-16a085?style=for-the-badge" alt="Powered by e.bitzy.id"></a>
</div>

---

## 🏛️ The Engineering Manifesto (Why LAPOS?)

LAPOS is not a standard CRUD application. It is engineered to prevent financial leakage, race conditions, and visual slop.

- 🛡️ **Concurrency Shield:** Every financial mutation and stock deduction is protected by Pessimistic Locking (`lockForUpdate()`) and Database Transactions. Zero race conditions, even during peak operational hours.
- 💰 **Absolute Financial Precision:** We strictly avoid floating-point math errors. All monetary values are handled using minor units or integer math.
- 🎨 **"Quiet Luxury" UI / Anti-AI Slop:** The dashboard utilizes a Neo-Brutalist / Clean Bento Grid design. Zero dependency on heavy chart libraries (No Chart.js/ApexCharts). All data visualizations (Sparklines, Area Charts, Gauges) are built natively using high-performance SVG and CSS.
- 🧠 **Brain/Muscle AI Separation:** Integrated with Gemini API for NLP (Natural Language Processing), but the AI acts strictly as an intent parser. Execution remains locked within TypeScript/PHP deterministic guards.

---

## ✨ Modul Utama

<table>
<tr>
<td width="50%" valign="top">

### 💼 Core Business & Finance

| Modul | Deskripsi |
|-------|-----------|
| 🛒 **POS Engine** | Checkout instan, keyboard-first, idempotent requests. |
| 💳 **Multi-Payment** | Dukungan QRIS statis/dinamis & Diskon/Promo Engine. |
| 🔐 **Cash Register** | Manajemen Shift, rekonsiliasi kasur (Blind Close). |
| 📦 **Inventory** | Mutasi stok ketat, alert stok kritis, & Stock Opname. |
| 👥 **Customer CRM** | Sistem Poin Loyalitas & tracking histori pelanggan. |
| 📊 **Financial Reports**| Income/expense, P&L, ekspor jurnal profesional. |

</td>
<td width="50%" valign="top">

### 🤖 HRIS, AI & Analytics

| Modul | Deskripsi |
|-------|-----------|
| 💰 **Payroll Engine** | Auto-generate payslip terintegrasi potongan kasbon. |
| 🕒 **Attendance Kiosk** | Time tracking publik via PIN (Tanpa login OS). |
| 💸 **Kasbon** | Cash advance dengan cicilan potong gaji otomatis. |
| 📈 **Native Analytics** | Trend penjualan & grafik performa 0-dependency SVG. |
| 🧠 **Qi Chat (AI)** | Eksekusi kasir via chat NLP bahasa gaul/natural. |
| 🏢 **Multi-Branch** | Tenant isolation ketat berbasis RBAC per cabang. |

</td>
</tr>
</table>

---

## 📂 Architectural Pattern

LAPOS memisahkan antara HTTP Delivery dan Business Logic untuk memastikan maintainability jangka panjang:

```text
┌────────────────────────────────────────────────────────────────┐
│  REQUEST LIFECYCLE                                             │
│  ┌──────────┐   ┌──────────────┐   ┌────────────────────────┐ │
│  │ Middleware│──▶│ FormRequest  │──▶│  Thin Controller       │ │
│  │ (Gate)   │   │ (Validation) │   │  ↓                     │ │
│  └──────────┘   └──────────────┘   │  Service → DB::beginTx │ │
│                                     │  ↓ (Pessimistic Lock)  │ │
│                                     │  DTO ← Response        │ │
│                                     └────────────────────────┘ │
└────────────────────────────────────────────────────────────────┘
```

*(Seluruh core logic berada di `app/Services/` dan diikat dengan `app/Domain/DTOs/` untuk eliminasi array mentah yang rawan typo).*

---

## 🚀 Quick Start (Development)

Disarankan menggunakan PHP 8.2+ dan Composer 2.x.

```bash
# 1. Clone & install dependencies
git clone https://github.com/bicknicktick/LAPOS-kasir.git
cd LAPOS-kasir
composer install

# 2. Environment setup
cp .env.example .env
php artisan key:generate

# 3. Database (Default SQLite untuk Dev)
touch database/database.sqlite
php artisan migrate --seed --class=CashierSeeder

# 4. Launch the application
php artisan serve --host=127.0.0.1 --port=8090
```

🎉 Akses sistem di `http://127.0.0.1:8090`

<details>
<summary><strong>🐘 Setup PostgreSQL / MySQL (Production Mandatory)</strong></summary>

Untuk environment Production, WAJIB menggunakan RDBMS tersentralisasi untuk fitur `lockForUpdate()`.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=lapos_erp
DB_USERNAME=postgres
DB_PASSWORD=secret_password
```

Jalankan migrasi: `php artisan migrate --seed`
</details>

---

## 🔑 Autentikasi & Role Akses

Data bootstrap (via `CashierSeeder`) akan membuatkan dua level otorisasi:

| Role | Username | PIN Login | Akses Utama |
|------|----------|-----------|-------------|
| `admin` | Admin | 123456 | Dashboard ERP, HRIS, Finance, Konfigurasi |
| `cashier` | Kasir1 | 111111 | POS Checkout, Manajemen Shift Harian |

> 🔴 **CRITICAL SECURITY WARNING:**
> PIN `123456` dan `111111` HANYA untuk development. Anda WAJIB mereset PIN ini melalui database atau menu Admin segera setelah deploy ke ranah Production!

---

## 🔒 Security & Concurrency Checklist

Sistem ini didesain sesuai spesifikasi keamanan Enterprise:

- [x] **Idempotency Guard:** API Checkout menolak duplikasi request akibat double-click atau network lag.
- [x] **Tenant Middleware:** Scoping data ketat, Cabang A tidak akan pernah bisa melihat transaksi Cabang B.
- [x] **Mass Assignment Block:** Penggunaan FormRequest untuk whitelist input. Dilarang keras menggunakan `$request->all()` di Controller.
- [x] **Rate Limiting:** Proteksi brute-force pada endpoint login dan validasi PIN.

---

## 🤖 Integrasi AI NLP (Qi Chat)

Untuk mengaktifkan asisten pintar **Qi Chat** (Sistem yang mampu menerjemahkan chat *"tambah pengeluaran beli kopi 150rb"* menjadi Actionable Database Mutation):

1. Dapatkan kunci dari Google AI Studio
2. Tambahkan ke file `.env` Anda:
```env
GEMINI_API_KEY="your-gemini-api-key-here"
```

---

## 📸 Antarmuka Sistem (Zero-Dependency UI)

<div align="center">

**🖥️ Executive ERP Dashboard (Quiet Luxury / Neo-Brutalist Mode)**

Built entirely with Native SVGs and CSS Grids. No bulky chart libraries.

<img src="ui/ss001.png" alt="Admin Dashboard ERP" width="800"/>

<br><br>

<table>
<tr>
<td align="center">
<strong>🛒 Fast POS Interface</strong><br>
<img src="ui/ss002.png" alt="POS UI" width="400"/>
</td>
<td align="center">
<strong>🤖 Qi Chat — NLP Agent</strong><br>
<img src="ui/ss003.png" alt="Qi Chat AI" width="400"/>
</td>
</tr>
</table>

</div>

---

## 🚢 Deployment Guide

Untuk rilis produksi (Ubuntu/Nginx/Cloudflare), pastikan merujuk ke dokumen:
- `docs/DEPLOYMENT_CHECKLIST.md` — Panduan hardening VPS & proxy.
- `docs/FINAL_SECURITY_AUDIT.md` — Rotasi secret & rotasi backup.

---

## 📝 Lisensi & Legalitas

Aplikasi ini dilindungi di bawah **MIT License**.

<div align="center">
<br>

<a href="https://paypal.me/bitzyid">
  <img src="https://img.shields.io/badge/💳_Support_Development-PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white" alt="Donate">
</a>

<br><br>

<strong>Architected & Developed with 💻 by <a href="https://e.bitzy.id">e.bitzy.id</a></strong>

<sub>© 2026 LAPOS ERP — Engineered for Scale.</sub>

</div>
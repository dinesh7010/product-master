# 📦 Product Master - Laravel CRUD + QR Code

This Laravel application provides a product master module with full CRUD operations and QR code generation using Laravel, Livewire, TailwindCSS, and Alpine.js.

---

## 🚀 Features

- Product Add/Edit/Delete
- Unique Product Code (8 digit)
- Product Type & Category
- Livewire Datatable Display
- QR Code Generation
- Popup with Scannable Product Info

---

## 🔧 Tech Stack

- Laravel 10+
- Livewire
- Tailwind CSS
- Alpine.js
- Simple QrCode package

---

## 🛠️ Setup Instructions

```bash
git clone https://github.com/your-username/product-master.git
cd product-master

# Install PHP Dependencies
composer install

# Install JS Dependencies
npm install && npm run dev

# Environment Configuration
cp .env.example .env
php artisan key:generate

# Configure your DB in `.env`, then:
php artisan migrate

# Serve the app
php artisan serve

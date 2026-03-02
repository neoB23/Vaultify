
# 🔐 Vaultify

Vaultify is a fast and secure password management web application built with the **TALL Stack** (Tailwind CSS, Alpine.js, Laravel, Livewire). It uses **AES-256 encryption** for data protection and supports **Two-Factor Authentication (2FA)** to ensure maximum account security.

Designed to be simple, minimal, and performance-focused.

---

## 🚀 Features

* 🔒 AES-256 encryption for stored passwords
* 🔐 Two-Factor Authentication (2FA) support
* 👤 Secure authentication system
* 🗂 Card-based password dashboard
* ✏️ Modal-based edit functionality
* 📋 One-click password copy
* 🗑 Secure delete with confirmation
* 📱 Fully responsive minimalist UI

---

## 🛠 Tech Stack

**TALL Stack**

* Laravel
* Livewire
* Alpine.js
* Tailwind CSS

**Security**

* AES-256 Encryption
* Laravel Hashing
* CSRF Protection
* Secure Session Handling

**Database**

* MySQL

---

## 🧠 Security Architecture

* Passwords are encrypted using **AES-256** before being stored in the database.
* User credentials are hashed using Laravel’s secure hashing algorithm.
* 2FA adds an additional verification layer during login.
* Sensitive operations are protected by middleware and validation rules.

---

## 📦 Installation

### 1️⃣ Clone the repository

```bash
git clone https://github.com/your-username/vaultify.git
cd vaultify
```

### 2️⃣ Install dependencies

```bash
composer install
npm install
```

### 3️⃣ Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`.

### 4️⃣ Run migrations

```bash
php artisan migrate
```

### 5️⃣ Start development server

```bash
php artisan serve
npm run dev
```

---

## 📁 Project Structure

```
app/
resources/
routes/
database/
```

---

## 🎯 Goals

Vaultify focuses on:

* Strong encryption
* Minimalist Apple-inspired UI
* Fast user experience
* Clean dashboard interaction
* Secure password storage

---

## 🔮 Future Improvements

* Browser extension integration
* Encrypted password export
* Device session management
* Activity logs
* Biometric authentication

---

## 👨‍💻 Author

Justin Parlan
IT Student | Full-Stack Software Developer

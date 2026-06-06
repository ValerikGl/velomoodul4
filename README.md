# 🚲 Velo – Electric Vehicle Rental Platform

A modern electric vehicle rental platform built with Laravel, Vue.js, Inertia.js and Filament.

## 🌐 Live Demo

**Website:** https://eksam.eu

**Admin Panel:** https://eksam.eu/admin

---

## 📋 Project Overview

Velo is a web application that allows users to browse electric vehicles, make bookings, read company news and contact the company through a contact form.

Administrators can manage vehicles, bookings, blog posts, promotional banners and contact messages through a modern Filament administration panel.

---

## ✨ Features

### Public Website

* Responsive modern design
* Homepage with dynamic content
* Vehicle catalogue
* Vehicle detail pages
* Online booking system
* Blog & news section
* Promotional banners
* Contact form
* Mobile-friendly layout

### Admin Panel

* Secure authentication
* Vehicle management (CRUD)
* Booking management (CRUD)
* Blog management (CRUD)
* Promotional banner management (CRUD)
* Contact message management
* Dashboard statistics
* Image uploads

---

## 🛠 Technologies

### Backend

* Laravel 12
* PHP 8.4
* SQLite
* Filament 4

### Frontend

* Vue 3
* Inertia.js
* Tailwind CSS
* Vite
* Lucide Icons

### Infrastructure

* Ubuntu VPS
* Nginx
* SSL (HTTPS)
* GitHub

---

## 🔒 Security

The project implements:

* Password hashing
* Request validation
* CSRF protection
* Environment variables (.env)
* Secure authentication
* Protected admin panel

---

## 🗄 Database Structure

Main entities:

### Vehicles

Stores rental vehicle information.

### Bookings

Stores customer reservations.

### Blog Posts

Stores news and blog content.

### Offer Banners

Stores homepage promotional banners.

### Contact Messages

Stores messages submitted through the contact form.

### Users

Stores administrator accounts.

---

## 🚀 Installation

### Clone Repository

```bash
git clone https://github.com/ValerikGl/velomoodul4.git
cd velomoodul4
```

### Install Dependencies

```bash
composer install
npm install
```

### Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### Database Setup

```bash
touch database/database.sqlite
```

Configure:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Run migrations:

```bash
php artisan migrate
```

### Storage Link

```bash
php artisan storage:link
```

### Build Frontend

```bash
npm run build
```

### Start Development Server

```bash
php artisan serve
```

---

## 👤 Admin Access

Create administrator account:

```bash
php artisan make:filament-user
```

Admin panel:

```text
/admin
```

---


## 📚 Learning Outcomes

This project demonstrates:

* Laravel MVC architecture
* Database design and migrations
* Authentication and authorization
* CRUD operations
* Vue.js component architecture
* Inertia.js SPA workflow
* File uploads
* Deployment on VPS
* Git version control

---

## 👨‍💻 Author

**Valeri Gladunik**

GitHub:
https://github.com/ValerikGl

---

## 📄 License

Educational project created for vocational school examination purposes.

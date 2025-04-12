# Backend Cross-Platform Sales Management System (Laravel)

Laravel

## Overview

This repository contains the Laravel backend for a Cross-Platform Sales Management System. The system supports web, mobile, and desktop clients with centralized sales and inventory management.

# Features

User Management: Authentication (Sanctum/Passport), roles & permissions

Product Management: CRUD operations, inventory tracking

Order Processing: Sales transactions, invoices, order history

Reporting: Sales analytics, exports (Excel/PDF)

RESTful API: Ready for integration with frontend platforms

# Tech Stack

PHP: 8.0+

Framework: Laravel 11.x

Database: MySQL

API Auth: Laravel Sanctum/Passport

API Docs: Laravel API Documentation Generator/Scribe

## Installation

### Prerequisites

PHP 8.0+

Composer

MySQL

## Setup Steps

Clone the repository:

```bash
git clone https://github.com/ptd-seedam/Backend-Cross-platform-sales-management-system.git
cd Backend-Cross-platform-sales-management-system
```

### Install dependencies:

```bash
Copy
composer install
npm install
```

### Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

Edit .env with your database credentials:

```bash
env
Copy
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### Run migrations and seeders:

```bash
Copy
php artisan migrate --seed
```

### Start the development server:

```bash
php artisan serve
```

## Example deployment script:

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Contact

For support, please contact: [seedam5000@gmail.com]
Project Maintainer: @ptd-seedam

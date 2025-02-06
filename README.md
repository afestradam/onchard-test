# 🏗️ Orchard WordPress Deployment Guide

This repository contains a **custom WordPress theme and plugin**, designed for easy deployment across multiple environments.

---

## 📌 1️⃣ Prerequisites

Before proceeding, ensure you have the following installed:

### **Required Software**
- 🔹 **Local Server (XAMPP, MAMP, or LocalWP)**
- 🔹 **WordPress 6.7.1 (Latest Version)**
- 🔹 **PHP 7.4 or later**
- 🔹 **MySQL 8.0 or later**
- 🔹 **Git (Optional, for cloning the repository)**

---

## 📌 2️⃣ Installation & Setup

### **1️⃣ Clone the Repository**
If using Git, run the following in your WordPress installation folder:
```sh
git clone https://github.com/afestradam/orchard-test.git
```
### **2️⃣ Import the Database**
- Open phpMyAdmin and create a new database named:
```sh
orchard_test
```
- Import the SQL file from the SQL/ folder:
  - Location: SQL/orchard_db_backup.sql
  - In phpMyAdmin, select Import and upload the file.
- Check database credentials in *wp-config.php*:
```php
define('DB_NAME', 'orchard_test');
define('DB_USER', 'root'); // Adjust based on your setup
define('DB_PASSWORD', 'root'); // Adjust based on your setup
define('DB_HOST', 'localhost');
```
### **3️⃣ Activate the Theme and Plugin**
- Log into WordPress (http://localhost/orchard-test/wp-admin).
- Go to "Appearance" > "Themes" and activate Orchard Theme.
- Go to "Plugins" and activate Orchard Plugin.

## 📌 4️⃣ What Does the Plugin Do?

The Orchard Plugin extends WordPress functionality by adding custom features for managing services (instead of products) dynamically.

## 📌 4️⃣ What Does the Plugin Do?

The **Orchard Plugin** extends WordPress functionality by adding **custom features** for managing services dynamically.

### **Key Features**
- **Registers a custom database table (`wp_orchard_products`)** to store services.
- **Provides shortcodes** to display featured and non-featured services dynamically.
- **Includes an admin panel** for managing services directly from WordPress.
- **Implements a dynamic banner system**:
    - Changes the **banner image** based on the **current page**.
    - Uses **menu structure** to determine the correct banner to display.
    - Supports **Advanced Custom Fields (ACF)** to set banner images for each menu item.
- **Integrates Bootstrap for a clean UI experience.**

🔹 **With this plugin, the website dynamically updates its content, services, and banners based on user navigation!**


## 📌 Contributors

We want to thank the people who made this project possible. 💡🚀

| Name | GitHub | Role |
|------|--------|------|
| **Andrés Estrada** | [@afestradam](https://github.com/afestradam) | Developer |



💡 **Want to contribute?** Open an issue or submit a pull request on [GitHub](https://github.com/afestradam/orchard-test).



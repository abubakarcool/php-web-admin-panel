# 🖥️ PHP Web Admin Panel

This is a PHP-based web application that includes a full frontend and backend structure. It features an admin dashboard, Bootstrap-based layout, reusable components, and SQL database setup.

---
---

## ⚙️ Technologies Used

- **PHP**
- **Bootstrap**
- **JavaScript**
- **jQuery**
- **Font Awesome**
- **MySQL**
- **SCSS**
- **Manual routing (no framework)**

---

## 🛠️ How to Run

1. Place project folder in your local server directory (e.g. `htdocs` for XAMPP).
2. Import the database from `sql_database/u434392900_maxdb.sql`.
3. Update your `config.php` file with DB credentials.
4. Start Apache and MySQL.
5. Visit `http://localhost/your-folder-name` in browser.

---

## 📬 Notes

- This project was created 3 years ago — file structure and methods reflect traditional PHP development styles.
- You may want to refactor it using MVC or Laravel if upgrading.

---


## 📁 Folder Structure
```bash
project-root/
│
├── admin/                 # Admin dashboard files (login, users, etc.)
├── coresystem/            # Core system scripts like init.php
├── css/                   # Main CSS files (custom styles)
├── js/                    # JavaScript files for frontend
├── scss/                  # SCSS source files
├── includes/              # Reusable frontend components (header, sidebar, etc.)
├── mail/                  # Contact form handler
├── sql_database/          # SQL dump file for the database
├── vendor/                # Bootstrap, jQuery, Font Awesome, etc.
├── img/                   # Image assets (logo, backgrounds)
├── fonts/                 # Font files (glyphicons, etc.)
│
├── index.php              # Main entry point of the website
├── config.php             # Configuration file (DB credentials, settings)
├── cronjob.php            # Scheduled script (cron jobs)
├── wizard.php             # Wizard-based form or flow
├── wizardwithhash.php     # Wizard with hash-based tracking
├── quartz.php             # Quartz module (purpose-specific)
├── projcss.css            # Project-specific CSS
├── projs.js               # Project-specific JS
├── header.php             # Shared header layout
├── indexold.php           # Previous version of homepage
├── admin.css              # Admin-specific CSS
└── error_log              # (Optional) Error logs (should be ignored)


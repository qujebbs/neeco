
# Company Website CMS (PHP)

A content management system for managing news, staff, promotions, complaints, downloadable files, etc. using PHP and SQL Server.

---

## 🛠️ Full Setup Instructions

### 1. System Requirements

- PHP 8.2.12
- SQL Server (e.g., Microsoft SQL Server 2019)
- Apache with `mod_rewrite` enabled
- Composer
- File permissions correctly set for uploads/logs
- Internet connection to install Composer dependencies

---

### 2. Clone the Repository

```bash
git clone https://github.com/qujebbs/neeco.git
```

### 3. Configure the Database
--You can run Microsoft SQL Server in a Docker container if you don’t want to install it locally:

docker run -e 'ACCEPT_EULA=Y' -e 'SA_PASSWORD=YourStrong!Passw0rd' \
 -p 1433:1433 --name sqlserver \
 -d mcr.microsoft.com/mssql/server:2019-latest

1. Create a new database (e.g., `neeco2area1`) in SQL Server.
2. Import the database schema using SQL Server Management Studio or `sqlcmd` or any database tool.
3. Update the connection credentials in: `src/config/db.php`


    ### Script

    The main script is in `sql-script.sql`.

    ### How to Run

    1. Make sure you have sqlserver installed.
    2. Run the script with your SQL Server Management Studio or `sqlcmd` or any database tool.

### 4. Apache & mod_rewrite Setup

#### a. Enable mod_rewrite in Apache

Ensure this line is uncommented in `httpd.conf`:

```
LoadModule rewrite_module modules/mod_rewrite.so
```

#### b. Allow `.htaccess` overrides in your Apache config:

```apache
<Directory "C:/xampp/htdocs/your-folder/public">
    AllowOverride All
    Require all granted
</Directory>
```

#### c. `.htaccess` file (already included in `/public`):

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```

---

### 5. File Permissions (Linux/Unix)

```bash
chmod -R 755 storage/
chmod -R 755 src/logs/
```

Ensure the web server (e.g., `www-data`, `apache`) can write to those directories.

---

### 6. Initialize the Environment
using Composer:

```bash
composer install
```
NOTE: After installation, move the vendor/ directory to /public
---

### 7. Run the Application

Start Apache and visit:

NOTE: visit this to generate a paseto key:
```
http://localhost/neeco2/generate-key
```

```
http://localhost/neeco2/home
```

---

### 8. Testing Repositories

Use the `tests/` directory for development testing

---

## 📁 Project Structure Overview

```
project-root/
NEECO2/
├── public/              # Public-facing files served by the web server
│   ├── assets/          # Frontend static assets
│   │   ├── css/         # Stylesheets
│   │   ├── fonts/       # Custom fonts
│   │   ├── img/         # Images and icons
│   │   ├── js/          # JavaScript files
│   │   ├── lib/         # Third-party libraries (non-NPM)
│   │   ├── scss/        # SCSS stylesheets (preprocessed)
│   │   ├── uploads/     # Uploaded media from cms accessible publicly
│   │   └── vendor/      # PHP and frontend vendors (e.g., Bootstrap, Paseto)
│   ├── views/           # HTML/PHP templates and static views
│   └── index.php        # Entry point for the application
│
├── src/                 # Application logic and backend code
│   ├── config/          # Configuration files (e.g., database, app settings)
│   ├── filters/         # Query filtering logic
│   ├── handlers/        # Handlers for controlling the overall flow of the application
│   │  └── authHandlers/ # Authentication-specific Handlers (e.g., loginHandler, registerHandler)
│   ├── helpers/         # Helper functions (e.g., utility classes)
│   ├── logs/            # Application logs (error, activity, etc.)
│   ├── middlewares/     # Middleware functions for requests
│   ├── models/          # Data models that represent database structures
│   ├── repositories/    # Database interaction logic (CRUD operations)
│   ├── services/        # service layer (auth and email services)
│   └── utils/           # Shared utilities (file handling, model validator etc.)
│
├── .htaccess            # Apache configuration for clean URLs and access control
├── init.php             # Global app initialization (autoload, config, env)
├── router.php           # Main route dispatcher
│
├── storage/             # paseto key storage  (should be removed and key moved to env)
├── tests/               # unfinished Scripts and files used for testing during development
├── unused files/        # Archived and unused code/files (temporary)
├── utils/               # (dupe utils mainly for debugging, consider merging to utils in src)
│
├── .gitattributes       # Git configuration for text normalization or attributes
├── .gitignore           # Ignored files/folders for Git
├── composer.json        # PHP dependency manager config file
├── composer.lock        # Locked versions of Composer dependencies
├── dump.php             # Utility file for dumping debug data (should be removed or protected in prod)
└── LICENSE              # Project license
```

## 📄 License

This project is for internal company use unless otherwise specified.

# Expense Manager

A PHP and MySQL web application for tracking personal income and expenses. This project demonstrates server-rendered pages, session-based user flows, database-backed CRUD operations, and dashboard/reporting interfaces.

[![PHP Validation](https://github.com/lomeshpawar/expense_manager_project/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/lomeshpawar/expense_manager_project/actions/workflows/php.yml)

## Hosting status

**Repository:** https://github.com/lomeshpawar/expense_manager_project

This is a PHP application and requires a PHP-capable server plus a MySQL/MariaDB database. GitHub Pages cannot execute PHP or connect to its database. The repository does include `.github/workflows/pages.yml`, which builds an informational static preview only; it does not host the PHP application. The latest recorded deployment attempt on 30 October 2026 failed with HTTP 404 because GitHub Pages was not enabled for the repository ([run #41108763128](https://github.com/lomeshpawar/expense_manager_project/actions/runs/41108763128)). To publish the preview, enable Pages in **Settings → Pages**, choose **GitHub Actions** as the source, and rerun the workflow. The full application must still run locally or on a suitable PHP host.

## Features

- User registration, login, and logout
- Add, edit, and delete expense records
- Income tracking
- Dashboard and reports
- Profile management
- Password-change workflow
- MySQL/MariaDB integration
- HTML, CSS, and JavaScript interface

## Technology stack

| Layer | Technology |
|---|---|
| Web backend | PHP |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, JavaScript |
| Local development | XAMPP, WAMP, or equivalent Apache/PHP stack |

## Project structure

```text
expense_manager_project/
├── css/                 # Stylesheets
├── js/                  # Browser-side JavaScript
├── images/              # Static image assets
├── includes/            # Shared PHP components
├── database/            # Database scripts
├── index.php            # Application entry point
├── login.php            # Login
├── register.php         # Registration
├── dashboard.php        # Main dashboard
├── add_expense.php      # Create expense
├── edit_expense.php     # Update expense
├── delete_expense.php   # Delete expense
├── income.php           # Income management
├── reports.php          # Reports
├── profile.php          # User profile
├── change_password.php  # Password change
├── db.php               # Database connection
└── .env.example         # Example configuration
```

## Run locally on Windows

### 1. Install and start XAMPP

Start **Apache** and **MySQL** from the XAMPP Control Panel.

### 2. Place the project in the web root

Copy this repository folder into:

```text
C:\xampp\htdocs\expense_manager_project
```

### 3. Create the database

Open phpMyAdmin at `http://localhost/phpmyadmin`. Create a database named `expense_manager`, then import the SQL schema provided in the `database/` directory. Check the database scripts for the exact table definitions.

### 4. Configure the database connection

The application reads `DB_HOST`, `DB_USER`, `DB_PASSWORD`, and `DB_NAME` environment variables in `db.php`, with local development defaults. Configure the settings for your environment and never commit real database credentials.

### 5. Open the app

Visit:

```text
http://localhost/expense_manager_project/
```

## Deploying online

To host the full app publicly, choose a PHP-compatible host and a supported MySQL/MariaDB instance. Configure database environment variables in the hosting dashboard, import the schema, set up HTTPS, and verify all routes on the deployed host. A static GitHub Pages upload is not a substitute for PHP hosting.

## Security and testing

The `PHP Validation` GitHub Actions workflow runs PHP 8.2 syntax checks (`php -l`) across the tracked PHP source. It does not currently run automated functional or integration tests; the checklist below is a manual smoke test, not an automated test report.

This is an educational portfolio project and should be reviewed before being used with real personal or financial data. Priorities include using `password_hash()` and `password_verify()`, prepared statements for SQL operations, CSRF tokens on state-changing forms, robust server-side validation, and secure session-cookie settings. Do not claim production readiness until these controls have been verified in the code and tested.

Suggested manual smoke test:

1. Register and log in.
2. Add income and expense entries.
3. Edit and delete an expense.
4. Review dashboard and reports.
5. Update profile details and test password change.
6. Log out and confirm authenticated pages are protected.

## Author

**Lomesh Pawar** · [GitHub](https://github.com/lomeshpawar)

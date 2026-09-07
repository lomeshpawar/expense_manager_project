# Expense Manager

A PHP and MySQL web application for managing personal income and expenses through a simple browser-based interface.

## Overview

Expense Manager provides a small full-stack web application for recording income, adding and editing expenses, viewing account activity, and managing user sessions.

## Features

- User registration and login
- Session-based authentication
- Add, edit, and delete expenses
- Record income
- Dashboard for financial activity
- Profile management
- Password-change flow
- MySQL database integration
- Responsive styling and client-side JavaScript

## Technology Stack

- **Backend:** PHP
- **Database:** MySQL / MariaDB
- **Frontend:** HTML, CSS, JavaScript
- **Local development:** XAMPP, WAMP, or another PHP-compatible web server

## Project Structure

```text
expense_manager_project/
├── css/              # Stylesheets
├── database/         # Database scripts/schema
├── images/           # Project images/assets
├── includes/         # Shared PHP components
├── js/               # Client-side JavaScript
├── add_expense.php   # Create expense
├── edit_expense.php  # Update expense
├── delete_expense.php# Delete expense
├── income.php        # Income management
├── dashboard.php     # Main authenticated dashboard
├── login.php         # Authentication
├── logout.php        # Session logout
├── profile.php       # User profile
├── change_password.php
├── register.php      # User registration
├── db.php            # Database connection
└── index.php         # Application entry point
```

## Requirements

- PHP 7.4+ (PHP 8.x recommended)
- MySQL 5.7+ or MariaDB
- Apache or another PHP-capable web server

## Local Setup

1. Clone the repository into your web server's document root.
2. Create a MySQL database named `expense_manager`.
3. Import the SQL schema from the `database/` directory.
4. Configure the database connection in `db.php` for your local environment.
5. Start Apache and MySQL.
6. Open the project through your local server, for example:

```text
http://localhost/expense_manager_project/
```

> **Security note:** Never commit real database passwords or other credentials. For a production deployment, database configuration should be supplied through environment variables or a protected server configuration rather than source control.

## Development Notes

This project is intentionally lightweight and is suitable for learning and demonstrating PHP, MySQL, CRUD operations, sessions, and basic web application structure.

Before production use, authentication and data-access security should be strengthened with password hashing using PHP's `password_hash()` / `password_verify()`, prepared SQL statements, CSRF protection, stronger session-cookie settings, and centralized input validation.

## Testing

The repository does not currently include an automated test suite. Manual verification can be performed by registering a user, logging in, creating income/expense records, editing and deleting records, updating the profile, and logging out.

## Roadmap

- Add automated PHP tests
- Replace legacy authentication/data-access patterns with secure prepared statements and password hashing
- Move database credentials to environment-based configuration
- Add CSRF protection and stronger session security
- Add CI checks for PHP syntax and tests
- Improve deployment documentation

## License

No license is currently declared in the repository. Add an explicit license before presenting the project as an open-source project.

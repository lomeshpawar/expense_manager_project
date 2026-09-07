# Expense Manager

A lightweight PHP and MySQL web application for recording personal income and expenses through a browser-based interface.

> **Project status:** Educational / portfolio project. The application is suitable for local development and demonstrates PHP, MySQL, CRUD workflows, sessions, and basic web application structure. Review the security notes before any production deployment.

## What this project demonstrates

- Server-side PHP application development
- MySQL / MariaDB integration
- CRUD operations for expense records
- Income tracking and dashboard views
- Session-based user flows
- Profile and password-management workflows
- HTML, CSS, and JavaScript integration
- Local deployment with Apache/XAMPP/WAMP

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

| Layer | Technology |
|---|---|
| Backend | PHP |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, JavaScript |
| Local server | Apache via XAMPP/WAMP or equivalent |

## Project Structure

```text
expense_manager_project/
├── css/                 # Stylesheets
├── database/            # Database scripts/schema
├── images/              # Images and static assets
├── includes/            # Shared PHP components
├── js/                  # Client-side JavaScript
├── add_expense.php      # Create expense
├── edit_expense.php     # Update expense
├── delete_expense.php   # Delete expense
├── income.php           # Income management
├── dashboard.php        # Authenticated dashboard
├── login.php            # Authentication
├── logout.php           # Session logout
├── profile.php          # User profile
├── change_password.php  # Password management
├── register.php         # User registration
├── db.php               # Database connection
└── index.php            # Application entry point
```

## Requirements

- PHP 7.4 or newer (PHP 8.x recommended)
- MySQL 5.7+ or MariaDB
- Apache or another PHP-compatible web server

## Run Locally

### 1. Clone the repository

Place the project inside the document root of XAMPP, WAMP, or your PHP web server.

### 2. Create the database

Create a database named `expense_manager` and import the SQL schema available under `database/`.

### 3. Configure the database

For local development, the application supports the following environment variables:

```text
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=expense_manager
DB_PORT=3306
```

Do not commit real credentials to Git.

### 4. Start the services

Start Apache and MySQL from your local development environment.

### 5. Open the application

```text
http://localhost/expense_manager_project/
```

## Typical User Flow

```text
Register → Login → Dashboard → Add Income/Expense
                         ↓
                  Edit / Delete Records
                         ↓
                  Profile / Password
                         ↓
                       Logout
```

## Security Status

This is a portfolio/learning project and should **not** be treated as production-ready authentication yet.

The repository is being incrementally hardened. Priority security improvements include:

- Use `password_hash()` and `password_verify()` for passwords
- Replace dynamically constructed SQL with prepared statements
- Add CSRF protection to state-changing forms
- Strengthen session and cookie configuration
- Validate and sanitize server-side input consistently
- Keep database credentials outside source control

If you discover a security issue, do not publish credentials or sensitive values in an issue or pull request.

## Testing

The project currently relies primarily on manual functional verification. A useful smoke-test flow is:

1. Register a user.
2. Log in.
3. Open the dashboard.
4. Add an income record.
5. Add an expense.
6. Edit the expense.
7. Delete the expense.
8. Update profile information.
9. Test the password-change flow.
10. Log out and confirm the authenticated pages are protected.

Automated PHP tests are planned as the project is hardened.

## Development Roadmap

- [x] Document project structure and local setup
- [x] Externalize database configuration through environment variables
- [ ] Replace legacy password handling with secure password hashing
- [ ] Convert database operations to prepared statements
- [ ] Add CSRF protection
- [ ] Add automated PHP tests
- [ ] Expand CI checks
- [ ] Add deployment documentation

## Contributing

For portfolio development, changes should be small and focused. Use a feature branch for meaningful changes, verify the application locally, and open a pull request with a clear explanation of the change.

## License

No open-source license is currently declared. Add a license file if this project is intended to be reused or distributed as open-source software.

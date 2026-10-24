# Expense Manager — Static UI Preview

> This folder is a **static preview only** of the Expense Manager interface. The original application uses PHP and MySQL; those server-side features are not executed by GitHub Pages.

## What works on this preview

HTML, CSS, client-side JavaScript, and static assets can be served by GitHub Pages. PHP forms, PHP session management, database-backed login, income/expense persistence, and reports require a PHP-capable server and MySQL/MariaDB, and are not provided by this static deployment.

## Run the full application locally

Use XAMPP or another PHP/MySQL environment:

1. Place the repository in the web root, for example `C:\xampp\htdocs\expense_manager_project`.
2. Start Apache and MySQL.
3. Create the `expense_manager` database in phpMyAdmin and import the SQL schema from `database/`.
4. Configure local database environment values for the PHP runtime.
5. Open `http://localhost/expense_manager_project/`.

## Deployment

The GitHub Actions workflow `.github/workflows/pages.yml` publishes repository files as a static preview. It does not run PHP or provision a database. For full online functionality, deploy the PHP application to a PHP-capable host and configure a persistent database.

**Security:** Do not commit database credentials, real user data, or secrets.

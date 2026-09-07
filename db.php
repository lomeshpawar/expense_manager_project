<?php
/**
 * Database connection.
 *
 * Local development defaults are retained for compatibility. Set the DB_*
 * environment variables in deployed environments instead of committing
 * credentials to source control.
 */

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$db = getenv('DB_NAME') ?: 'expense_manager';
$port = (int) (getenv('DB_PORT') ?: 3306);

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    http_response_code(500);
    exit('Unable to connect to the database.');
}

mysqli_set_charset($conn, 'utf8mb4');
?>

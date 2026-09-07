<?php

include 'db.php';

if (isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
        http_response_code(400);
        exit('Please provide a valid name, email, and password of at least 8 characters.');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $passwordHash);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header('Location: login.php');
        exit;
    }

    mysqli_stmt_close($stmt);
    http_response_code(400);
    exit('Registration could not be completed.');
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="auth-container">
<h2>User Registration</h2>
<form method="POST">
<input type="text" name="name" placeholder="Enter Name" required>
<input type="email" name="email" placeholder="Enter Email" required>
<input type="password" name="password" placeholder="Enter Password" minlength="8" required>
<button type="submit" name="register">Register</button>
</form>
<p style="margin-top:20px;text-align:center;">Already have account? <a href="login.php">Login</a></p>
</div>
</body>
</html>

<?php

include 'includes/auth_check.php';
include 'db.php';

if (isset($_POST['save'])) {
    $user_id = (int) $_SESSION['user_id'];
    $source = trim($_POST['source'] ?? '');
    $amount = filter_var($_POST['amount'] ?? null, FILTER_VALIDATE_FLOAT);
    $date = $_POST['income_date'] ?? '';

    if ($source === '' || $amount === false || $amount <= 0 || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        http_response_code(400);
        exit('Please provide valid income details.');
    }

    $stmt = mysqli_prepare($conn, 'INSERT INTO income (user_id, source, amount, income_date) VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'isds', $user_id, $source, $amount, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Add Income</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
<h2>Add Income</h2>
<form method="POST">
<input type="text" name="source" placeholder="Income Source" required>
<input type="number" name="amount" placeholder="Amount" min="0.01" step="0.01" required>
<input type="date" name="income_date" required>
<button type="submit" name="save">Save Income</button>
</form>
</div>
</body>
</html>

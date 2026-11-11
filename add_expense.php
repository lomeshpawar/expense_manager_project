<?php

include 'includes/auth_check.php';
include 'db.php';

if (isset($_POST['add'])) {
    $user_id = (int) $_SESSION['user_id'];
    $category = trim($_POST['category'] ?? '');
    $amount = filter_var($_POST['amount'] ?? null, FILTER_VALIDATE_FLOAT);
    $date = $_POST['expense_date'] ?? '';
    $notes = trim($_POST['notes'] ?? '');

    $allowed_categories = ['Food', 'Travel', 'Shopping', 'Bills', 'Others'];

    if (!in_array($category, $allowed_categories, true) || $amount === false || $amount <= 0 || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        http_response_code(400);
        exit('Please provide valid expense details.');
    }

    $stmt = mysqli_prepare($conn, 'INSERT INTO expenses (user_id, category, amount, expense_date, notes) VALUES (?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'isdss', $user_id, $category, $amount, $date, $notes);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Add Expense</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
<h2>Add Expense</h2>
<form method="POST">
<select name="category" required>
<option value="">Select Category</option>
<option>Food</option>
<option>Travel</option>
<option>Shopping</option>
<option>Bills</option>
<option>Others</option>
</select>
<input type="number" name="amount" placeholder="Amount" min="0.01" step="0.01" required>
<input type="date" name="expense_date" required>
<textarea name="notes" placeholder="Expense Notes"></textarea>
<button type="submit" name="add">Add Expense</button>
</form>
</div>
</body>
</html>

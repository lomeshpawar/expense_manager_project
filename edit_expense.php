<?php

include 'includes/auth_check.php';
include 'db.php';

$user_id = (int) $_SESSION['user_id'];
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit('Invalid expense ID.');
}

$stmt = mysqli_prepare($conn, 'SELECT category, amount, expense_date, description FROM expenses WHERE id = ? AND user_id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'ii', $id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    http_response_code(404);
    exit('Expense not found.');
}

if (isset($_POST['update'])) {
    $category = trim($_POST['category'] ?? '');
    $amount = filter_var($_POST['amount'] ?? null, FILTER_VALIDATE_FLOAT);
    $expense_date = $_POST['expense_date'] ?? '';
    $description = trim($_POST['description'] ?? '');
    $allowed_categories = ['Food', 'Travel', 'Shopping', 'Bills', 'Others'];

    if (!in_array($category, $allowed_categories, true) || $amount === false || $amount <= 0 || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $expense_date)) {
        http_response_code(400);
        exit('Please provide valid expense details.');
    }

    $stmt = mysqli_prepare($conn, 'UPDATE expenses SET category = ?, amount = ?, expense_date = ?, description = ? WHERE id = ? AND user_id = ?');
    mysqli_stmt_bind_param($stmt, 'sdssii', $category, $amount, $expense_date, $description, $id, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<h2>Edit Expense</h2>
<form method="POST">
<select name="category" required>
<option value="Food" <?php echo $row['category'] === 'Food' ? 'selected' : ''; ?>>Food</option>
<option value="Travel" <?php echo $row['category'] === 'Travel' ? 'selected' : ''; ?>>Travel</option>
<option value="Shopping" <?php echo $row['category'] === 'Shopping' ? 'selected' : ''; ?>>Shopping</option>
<option value="Bills" <?php echo $row['category'] === 'Bills' ? 'selected' : ''; ?>>Bills</option>
<option value="Others" <?php echo $row['category'] === 'Others' ? 'selected' : ''; ?>>Others</option>
</select>
<input type="number" name="amount" value="<?php echo htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8'); ?>" min="0.01" step="0.01" required>
<input type="date" name="expense_date" value="<?php echo htmlspecialchars($row['expense_date'], ENT_QUOTES, 'UTF-8'); ?>" required>
<input type="text" name="description" value="<?php echo htmlspecialchars($row['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
<button type="submit" name="update">Update</button>
</form>
</div>
</body>
</html>

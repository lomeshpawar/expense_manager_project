<?php

include 'includes/auth_check.php';
include 'db.php';

$user_id = (int) $_SESSION['user_id'];
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit('Invalid expense ID.');
}

$stmt = mysqli_prepare($conn, 'DELETE FROM expenses WHERE id = ? AND user_id = ?');
mysqli_stmt_bind_param($stmt, 'ii', $id, $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: dashboard.php');
exit;
?>

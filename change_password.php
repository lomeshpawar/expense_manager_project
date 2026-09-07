<?php

include 'includes/auth_check.php';
include 'db.php';

$message = null;
$user_id = (int) $_SESSION['user_id'];

if (isset($_POST['change'])) {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    if ($old_password === '' || strlen($new_password) < 8) {
        $message = 'Use your current password and a new password of at least 8 characters.';
    } else {
        $stmt = mysqli_prepare($conn, 'SELECT password FROM users WHERE id = ? LIMIT 1');
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        $valid_password = false;
        $legacy_password = false;

        if ($user) {
            $valid_password = password_verify($old_password, $user['password']);
            // Transitional support for accounts created before password hashing.
            $legacy_password = !$valid_password && hash_equals($user['password'], md5($old_password));
        }

        if ($valid_password || $legacy_password) {
            $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, 'UPDATE users SET password = ? WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'si', $new_hash, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $message = 'Password changed successfully.';
        } else {
            $message = 'Old password is incorrect.';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
<h2>Change Password</h2>
<?php if ($message): ?>
<p role="status"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<form method="POST">
<input type="password" name="old_password" placeholder="Current Password" required>
<input type="password" name="new_password" placeholder="New Password" minlength="8" required>
<button type="submit" name="change">Change Password</button>
</form>
</div>
</body>
</html>

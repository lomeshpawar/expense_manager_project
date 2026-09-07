<?php

session_start();

include 'db.php';

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = MD5($_POST['password']);

$sql = "SELECT * FROM users
WHERE email='$email'
AND password='$password'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

$row = mysqli_fetch_assoc($result);

$_SESSION['user_id'] = $row['id'];
$_SESSION['name'] = $row['name'];

header("Location: dashboard.php");

}else{

echo "<script>alert('Invalid Email or Password');</script>";

}

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="auth-container">

<h2>User Login</h2>

<form method="POST">

<input type="email"
name="email"
placeholder="Enter Email"
required>

<input type="password"
name="password"
placeholder="Enter Password"
required>

<button type="submit"
name="login">
Login
</button>

</form>

<p style="margin-top:20px;text-align:center;">

New User?

<a href="register.php">Register</a>

</p>

</div>

</body>
</html>
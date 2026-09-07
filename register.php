<?php

include 'db.php';

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = MD5($_POST['password']);

$sql = "INSERT INTO users(name,email,password)

VALUES

('$name','$email','$password')";

if(mysqli_query($conn,$sql)){

header("Location: login.php");

}else{

echo "Error";

}

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

<input type="text"
name="name"
placeholder="Enter Name"
required>

<input type="email"
name="email"
placeholder="Enter Email"
required>

<input type="password"
name="password"
placeholder="Enter Password"
required>

<button type="submit"
name="register">
Register
</button>

</form>

<p style="margin-top:20px;text-align:center;">

Already have account?

<a href="login.php">Login</a>

</p>

</div>

</body>
</html>
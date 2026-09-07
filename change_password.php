<?php

include 'includes/auth_check.php';
include 'db.php';

if(isset($_POST['change'])){

$user_id = $_SESSION['user_id'];

$old = MD5($_POST['old_password']);
$new = MD5($_POST['new_password']);

$query = mysqli_query($conn,
"SELECT * FROM users
WHERE id='$user_id'
AND password='$old'");

if(mysqli_num_rows($query)>0){

mysqli_query($conn,
"UPDATE users SET password='$new'
WHERE id='$user_id'");

echo "Password Changed";

}else{

echo "Old Password Incorrect";

}

}

?>

<form method="POST">

<input type="password"
name="old_password"
placeholder="Old Password">

<input type="password"
name="new_password"
placeholder="New Password">

<button type="submit"
name="change">
Change Password
</button>

</form>
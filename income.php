<?php

include 'includes/auth_check.php';
include 'db.php';

if(isset($_POST['save'])){

$user_id = $_SESSION['user_id'];

$source = $_POST['source'];
$amount = $_POST['amount'];
$date = $_POST['income_date'];

$sql = "INSERT INTO income
(user_id,source,amount,income_date)

VALUES
('$user_id','$source','$amount','$date')";

mysqli_query($conn,$sql);

header("Location: dashboard.php");

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

<input type="text"
name="source"
placeholder="Income Source"
required>

<input type="number"
name="amount"
placeholder="Amount"
required>

<input type="date"
name="income_date"
required>

<button type="submit"
name="save">
Save Income
</button>

</form>

</div>

</body>
</html>
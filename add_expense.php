<?php

include 'includes/auth_check.php';
include 'db.php';

if(isset($_POST['add'])){

$user_id = $_SESSION['user_id'];

$category = $_POST['category'];
$amount = $_POST['amount'];
$date = $_POST['expense_date'];
$notes = $_POST['notes'];

$sql = "INSERT INTO expenses
(user_id,category,amount,expense_date,notes)

VALUES

('$user_id','$category','$amount','$date','$notes')";

mysqli_query($conn,$sql);

header("Location: dashboard.php");

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

<select name="category">

<option>Food</option>
<option>Travel</option>
<option>Shopping</option>
<option>Bills</option>
<option>Others</option>

</select>

<input type="number"
name="amount"
placeholder="Amount"
required>

<input type="date"
name="expense_date"
required>

<textarea
name="notes"
placeholder="Expense Notes"></textarea>

<button type="submit"
name="add">
Add Expense
</button>

</form>

</div>

</body>
</html>
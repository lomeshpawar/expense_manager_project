<?php
session_start();
include 'db.php';

$id = $_GET['id'];

$query = "SELECT * FROM expenses WHERE id='$id'";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $description = $_POST['description'];

    $sql = "UPDATE expenses SET

            category='$category',
            amount='$amount',
            expense_date='$expense_date',
            description='$description'

            WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        header("Location: dashboard.php");
    }
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

<select name="category">

<option><?php echo $row['category']; ?></option>
<option>Food</option>
<option>Travel</option>
<option>Shopping</option>
<option>Bills</option>
<option>Others</option>

</select>

<input type="number" name="amount"
value="<?php echo $row['amount']; ?>">

<input type="date" name="expense_date"
value="<?php echo $row['expense_date']; ?>">

<input type="text" name="description"
value="<?php echo $row['description']; ?>">

<button type="submit" name="update">Update</button>

</form>

</div>

</body>
</html>
<?php

include 'includes/auth_check.php';
include 'db.php';

$user_id = $_SESSION['user_id'];

/* TOTAL EXPENSE */

$total_expense = mysqli_query($conn,
"SELECT SUM(amount) as total
FROM expenses
WHERE user_id='$user_id'");

$total = mysqli_fetch_assoc($total_expense);

if($total['total'] == NULL){
$total['total'] = 0;
}

/* TOTAL INCOME */

$total_income = mysqli_query($conn,
"SELECT SUM(amount) as income
FROM income
WHERE user_id='$user_id'");

$income = mysqli_fetch_assoc($total_income);

if($income['income'] == NULL){
$income['income'] = 0;
}

/* BALANCE */

$balance = $income['income'] - $total['total'];

/* PROFILE */

$getProfile = mysqli_query($conn,
"SELECT * FROM user_profile
WHERE user_id='$user_id'
ORDER BY id DESC LIMIT 1");

$profile = mysqli_fetch_assoc($getProfile);

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<h2>Expense Manager</h2>

<div class="nav-links">

<a href="dashboard.php">Dashboard</a>
<a href="reports.php">Reports</a>
<a href="profile.php">Profile</a>
<a href="logout.php">Logout</a>

</div>

</div>

<div class="main-container">

<!-- SIDEBAR -->

<div class="sidebar">

<h3>Menu</h3>

<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="add_expense.php">
<i class="fa fa-plus"></i>
Add Expense
</a>

<a href="income.php">
<i class="fa fa-wallet"></i>
Income
</a>

<a href="reports.php">
<i class="fa fa-chart-pie"></i>
Reports
</a>

<a href="profile.php">
<i class="fa fa-user"></i>
Profile
</a>

</div>

<!-- CONTENT -->

<div class="content">

<!-- WELCOME SECTION -->

<div class="welcome-box">

<div>

<h2>
Welcome back,
<?php echo ucfirst($_SESSION['name']); ?> 👋
</h2>

<p>
Track your expenses and manage your finances smartly.
</p>

</div>

<div>

<?php

if(!empty($profile['profile_image'])){

?>

<img src="uploads/<?php echo $profile['profile_image']; ?>"
class="dashboard-profile">

<?php

}else{

$firstLetter =
strtoupper(substr($_SESSION['name'],0,1));

?>

<div class="default-profile">

<?php echo $firstLetter; ?>

</div>

<?php } ?>

</div>

</div>

<!-- DASHBOARD CARDS -->

<div class="cards">

<!-- INCOME -->

<div class="card income">

<div class="card-icon">
<i class="fa fa-wallet"></i>
</div>

<h3>Total Income</h3>

<p>₹<?php echo $income['income']; ?></p>

</div>

<!-- EXPENSE -->

<div class="card expense">

<div class="card-icon">
<i class="fa fa-credit-card"></i>
</div>

<h3>Total Expense</h3>

<p>₹<?php echo $total['total']; ?></p>

</div>

<!-- BALANCE -->

<div class="card balance">

<div class="card-icon">
<i class="fa fa-money-bill-wave"></i>
</div>

<h3>Balance</h3>

<p>₹<?php echo $balance; ?></p>

</div>

</div>

<!-- RECENT EXPENSES -->

<div class="section-header modern-header">

<div>

<h2 class="expense-title">
<i class="fa fa-chart-line"></i>
Recent Expenses
</h2>

<p class="expense-subtitle">
Track and manage your latest transactions
</p>

</div>

<a href="add_expense.php" class="modern-add-btn">

<i class="fa fa-plus"></i>

Add Expense

</a>

</div>

<!-- SEARCH -->

<input type="text"
id="searchInput"
placeholder="Search expenses by category, notes or amount...">

<!-- TABLE -->

<div class="table-container">

<table id="expenseTable">

<tr>

<th>Category</th>
<th>Amount</th>
<th>Date</th>
<th>Notes</th>
<th>Action</th>

</tr>

<?php

$query = mysqli_query($conn,
"SELECT * FROM expenses
WHERE user_id='$user_id'
ORDER BY id DESC");

if(mysqli_num_rows($query) > 0){

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td>

<span class="category-badge">

<?php echo $row['category']; ?>

</span>

</td>

<td>

₹<?php echo $row['amount']; ?>

</td>

<td>

<?php echo $row['expense_date']; ?>

</td>

<td>

<?php echo $row['notes']; ?>

</td>

<td>

<a class="edit-btn"
href="edit_expense.php?id=<?php echo $row['id']; ?>">

<i class="fa fa-pen"></i>

Edit

</a>

<a class="delete-btn"
onclick="return confirmDelete()"
href="delete_expense.php?id=<?php echo $row['id']; ?>">

<i class="fa fa-trash"></i>

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="5">

<div class="empty-state">

<div class="empty-icon">

<i class="fa fa-wallet"></i>

</div>

<h2>No Expenses Yet</h2>

<p>
Start tracking your daily spending and financial activity.
</p>

<a href="add_expense.php"
class="modern-empty-btn">

<i class="fa fa-plus-circle"></i>

Create First Expense

</a>

</div>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<script src="js/script.js"></script>

</body>
</html>
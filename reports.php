<?php

include 'includes/auth_check.php';
include 'db.php';

$user_id = $_SESSION['user_id'];

/* CATEGORY TOTALS */

$food = 0;
$travel = 0;
$shopping = 0;
$bills = 0;
$others = 0;

$query = mysqli_query($conn,
"SELECT category, SUM(amount) as total
FROM expenses
WHERE user_id='$user_id'
GROUP BY category");

while($row = mysqli_fetch_assoc($query)){

if($row['category'] == "Food"){
$food = $row['total'];
}

if($row['category'] == "Travel"){
$travel = $row['total'];
}

if($row['category'] == "Shopping"){
$shopping = $row['total'];
}

if($row['category'] == "Bills"){
$bills = $row['total'];
}

if($row['category'] == "Others"){
$others = $row['total'];
}

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Reports</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

.report-container{
padding:30px;
}

.report-title{
font-size:32px;
font-weight:600;
margin-bottom:25px;
color:#111827;
}

.chart-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:30px;
}

.chart-card{
background:white;
padding:25px;
border-radius:22px;
box-shadow:0 10px 20px rgba(0,0,0,0.08);
}

.chart-card h3{
margin-bottom:20px;
color:#111827;
}

.summary-cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.summary-card{
padding:25px;
border-radius:20px;
color:white;
box-shadow:0 10px 20px rgba(0,0,0,0.08);
}

.summary-card h3{
font-size:18px;
margin-bottom:10px;
}

.summary-card p{
font-size:32px;
font-weight:600;
}

.food{
background:linear-gradient(135deg,#3b82f6,#2563eb);
}

.travel{
background:linear-gradient(135deg,#ec4899,#db2777);
}

.shopping{
background:linear-gradient(135deg,#f59e0b,#d97706);
}

.bills{
background:linear-gradient(135deg,#10b981,#059669);
}

@media(max-width:768px){

.chart-grid{
grid-template-columns:1fr;
}

}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<h2>Expense Manager</h2>

<div>

<a href="dashboard.php">Dashboard</a>
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

<div class="content report-container">

<h2 class="report-title">
<i class="fa fa-chart-line"></i>
Expense Analytics Dashboard
</h2>

<!-- SUMMARY CARDS -->

<div class="summary-cards">

<div class="summary-card food">

<h3>Food</h3>

<p>₹<?php echo $food; ?></p>

</div>

<div class="summary-card travel">

<h3>Travel</h3>

<p>₹<?php echo $travel; ?></p>

</div>

<div class="summary-card shopping">

<h3>Shopping</h3>

<p>₹<?php echo $shopping; ?></p>

</div>

<div class="summary-card bills">

<h3>Bills</h3>

<p>₹<?php echo $bills; ?></p>

</div>

</div>

<!-- CHARTS -->

<div class="chart-grid">

<!-- PIE CHART -->

<div class="chart-card">

<h3>
<i class="fa fa-chart-pie"></i>
Expense Categories
</h3>

<canvas id="pieChart"></canvas>

</div>

<!-- BAR CHART -->

<div class="chart-card">

<h3>
<i class="fa fa-chart-bar"></i>
Expense Comparison
</h3>

<canvas id="barChart"></canvas>

</div>

</div>

</div>

</div>

<script>

/* PIE CHART */

const pieCtx =
document.getElementById('pieChart');

new Chart(pieCtx, {

type:'doughnut',

data:{

labels:[
'Food',
'Travel',
'Shopping',
'Bills',
'Others'
],

datasets:[{

data:[
<?php echo $food; ?>,
<?php echo $travel; ?>,
<?php echo $shopping; ?>,
<?php echo $bills; ?>,
<?php echo $others; ?>
],

backgroundColor:[
'#3b82f6',
'#ec4899',
'#f59e0b',
'#10b981',
'#8b5cf6'
],

borderWidth:0

}]

},

options:{
responsive:true,
plugins:{
legend:{
position:'bottom'
}
}
}

});

/* BAR CHART */

const barCtx =
document.getElementById('barChart');

new Chart(barCtx, {

type:'bar',

data:{

labels:[
'Food',
'Travel',
'Shopping',
'Bills',
'Others'
],

datasets:[{

label:'Expenses',

data:[
<?php echo $food; ?>,
<?php echo $travel; ?>,
<?php echo $shopping; ?>,
<?php echo $bills; ?>,
<?php echo $others; ?>
],

backgroundColor:[
'#3b82f6',
'#ec4899',
'#f59e0b',
'#10b981',
'#8b5cf6'
],

borderRadius:10

}]

},

options:{
responsive:true,
plugins:{
legend:{
display:false
}
}
}

});

</script>

</body>
</html>
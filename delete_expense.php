<?php

include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM expenses WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: dashboard.php");

?>
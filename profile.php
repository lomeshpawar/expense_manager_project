<?php

include 'includes/auth_check.php';
include 'db.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['update'])){

    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $image = $_FILES['image']['name'];

    if($image != ""){

        move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "uploads/".$image
        );

        $sql = "INSERT INTO user_profile
        (user_id,profile_image,phone,address)

        VALUES

        ('$user_id','$image','$phone','$address')";

        mysqli_query($conn,$sql);
    }
}

$getProfile = mysqli_query($conn,
"SELECT * FROM user_profile
WHERE user_id='$user_id'
ORDER BY id DESC LIMIT 1");

$profile = mysqli_fetch_assoc($getProfile);

?>

<!DOCTYPE html>
<html>
<head>

<title>Profile</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="profile-container">

<h2>User Profile</h2>

<?php if(!empty($profile['profile_image'])){ ?>

<img src="uploads/<?php echo $profile['profile_image']; ?>"
class="profile-image">

<?php } ?>

<form method="POST"
enctype="multipart/form-data">

<input type="file" name="image">

<input type="text"
name="phone"
placeholder="Phone Number">

<textarea name="address"
placeholder="Address"></textarea>

<button type="submit"
name="update">
Save Profile
</button>

</form>

</div>

</body>
</html>
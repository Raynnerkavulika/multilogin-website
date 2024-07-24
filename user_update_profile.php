<?php
require("config.php");

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $cpassword = md5($_POST['cpassword']);
    $cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = ('uploaded_img/'.$image);

   $select = $conn->prepare("SELECT * FROM users WHERE email = ?");
   $select->execute([$email]);

 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

<h1 class="heading">update user profile</h1>

<div class="profile-update-container">

<?php

   $select_profile = $conn->prepare("SELECT * FROM users WHERE id=?");
   $select_profile->execute([$user_id]);
   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>

<div class="profile">
    <form action="" method="post"></form>
</div>
</div>
   
    
</body>
</html>
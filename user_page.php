<?php
require('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header("location:login.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

   <h2 class="title">Userprofile page</h2>
  
   <section class="profile_container">
        <?php

          $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
          $select_profile->execute([$user_id]);
          $fetch_profile =  $select_profile->fetch(PDO::FETCH_ASSOC);
          
        ?>

        <div class="profile">

            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>

            <a href="user_update_profile.php" class="btn">Update Profile</a>
            <a href="logout.php" class="delete-btn">logout</a>

        </div>

   </section>
    
</body>
</html>
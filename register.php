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

   if($select->rowcount() >0){
      $message[]= "User already exist!";
   }else{
       if($password != $cpassword){
        $message[] = "Confirm password does not match";
       }else{
        $insert = $conn->prepare("INSERT INTO users(name,email,password,image) VALUES(?,?,?,?)");
        $insert->execute([$name,$email,$password,$image]);

        if($insert){
            move_uploaded_file($image_tmp_name,$image_folder);
            $message[] = "User registered successfully";
            header('location:login.php');
        }
       }
   } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

<?php
if(isset($message)){
    foreach($message as $message){
    echo'<div class="message">
              <span>'.$message.'</span>
        <div>';
    }
}
?>
    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>register now</h3>
            <input type="text" name="name" placeholder="enter  your name" autocomplete="off" required class="box">
            <input type="email" name="email" placeholder="enter  your email" autocomplete="off" required class="box">
            <input type="password" name="password" placeholder="enter  your password" autocomplete="off" required class="box">
            <input type="password" name="cpassword" placeholder="confirm your password" autocomplete="off" required class="box">
            <input type="file" name="image" accept="image/png,image/jpg,image/jpeg" class="box">
            <p>already have an account?<a href="login.php">login now</a></p>
            <input type="submit" name="submit" value="Register now" class="btn">
        </form>
    </section>
    
</body>
</html>
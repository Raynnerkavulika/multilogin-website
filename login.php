<?php
require("config.php");

session_start();
if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
  

   $select = $conn->prepare("SELECT * FROM users WHERE email = ? AND password =?");
   $select->execute([$email,$password]);
   $row = $select->fetch(PDO::FETCH_ASSOC);

   if($select->rowcount() >0){
      if($row['user_type'] == 'admin'){

      $_SESSION['admin_id'] = $row['id'];
      header('location:admin_page.php');
      }elseif($row['user_type'] == 'user'){

        $_SESSION['user_id'] = $row['id'];
        header('location:user_page.php');
      }else{
        $message[] = 'No user found';
      }
   }else{
    $message[] = "Wrong email or password.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <form action="" method="post">
            <h3>login now</h3>
            <input type="email" name="email" placeholder="enter  your email" autocomplete="off" required class="box">
            <input type="password" name="password" placeholder="enter  your password" autocomplete="off" required class="box">
            <p>don't have an account?<a href="register.php">register now</a></p>
            <input type="submit" name="submit" value="login now" class="btn">
        </form>
    </section>
    
</body>
</html>
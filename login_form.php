<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);{

         $_SESSION['admin_name'] = $row['name'];
         header('location:index.php');
         
      }
     
   }else{
      $error[] = 'Kata Sandi Anda Salah!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style_login.css">

</head>
<body>
   
<div class="input">
   <h1>TRAVEL</h1>
      <h2>LOGIN</h2>

   <form action="" method="post">

      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      
      <div class="box-input">
                <i class="fas fa-envelope-open-text"></i>
      <input type="email" name="email" required placeholder="Masukkan Email Anda">
      </div>
      
      <div class="box-input">
                <i class="fas fa-lock"></i>
      <input type="password" name="password" required placeholder="Masukkan Kata Sandi Anda">
      </div>

      <input type="submit" name="submit" value="MASUK" class="btn-input">
      
      <p>Saya belum memiliki Akun! <a href="register_form.php">DAFTAR</a></p>
   </form>

</div>

</body>
</html>
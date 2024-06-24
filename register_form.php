<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'Kata Sandi Anda berbeda dengan Kata Sandi sebelumnya!';
      
      }else{
         $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
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
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style_login.css">

</head>
<body>
   
<div class="input">

   <form action="" method="post">
      <h1>TRAVEL</h1>
      <h2>SIGN UP</h2>

      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <div class="box-input">
      <i class="fas fa-user"></i>
      <input type="text" name="name" required placeholder="Masukkan Nama Anda">
      </div>

      <div class="box-input">
      <i class="fas fa-address-book"></i>
      <input type="email" name="email" required placeholder="Masukkan Alamat Email anda">
      </div>

      <div class="box-input">
      <i class="fas fa-lock"></i>
      <input type="password" name="password" required placeholder="Masukkan Kata Sandi Anda">
      </div>

      <div class="box-input">
      <i class="fas fa-lock"></i>
      <input type="password" name="cpassword" required placeholder="Konfirmasi Kata Sandi Sebelumnya">
      </div>

      <input type="submit" name="submit" value="DAFTAR" class="btn-input">
      <p>Saya sudah memiliki Akun! <a href="login_form.php">MASUK</a></p>
   </form>

</div>

</body>
</html>
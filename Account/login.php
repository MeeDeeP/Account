<?php 
    $app = "<script src='js/app.login.js'></script>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="bg-info">
<div class="login_form text-center" ><br>
        <div class="right">
     <div class="login-box"  id="login-app">
        <h2>Login</h2>
        <form @submit="fnLogin($event)">
          <div class="user-box">
          <!-- <label>Username</label><br> -->
            <input type="text" placeholder="Username" name="username" required="" v-model="username">
            
          </div>
          <div class="user-box">
          <!-- <label>Password</label><br> -->
            <input type="password" placeholder="Password" name="password" required="" v-model="password">
            
          </div>
         <button class="btn btn-default"type="submit"> Login </button>
          <button class="btn btn-default"> <a href="register.php"> Register
        </a>
         </button>
        </form>
      </div>
      <?php include "includes/footer.php"; ?>
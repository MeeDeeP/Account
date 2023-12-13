<?php 
    $app = "<script src='js/app.register.js'></script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Register</title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-info">  
<div class="login_form text-center pt-5" >
        <div class="right">
<div id="register-app" class="login-box"  >
    <div class="loginForm">
        <h2 >Register</h2><br>
<form @submit="fnSave($event)" class="reg">
     <div class="user-box">
    <input required type="text" placeholder="Fullname" name="fullname" v-model="fullname" /><br>
    <!-- <label>Fullname</label> -->
</div>
   <div class="user-box">
    <input required type="text" placeholder="Username" name="username" v-model="username" /><br>
     <!-- <label>Username</label> -->
</div>
      <div class="user-box">
    <input required type="password" placeholder="Password" name="password"  v-model="password" /><br>
     <!-- <label>Password</label> -->
</div>
     <div class="user-box">
    <input required type="text" placeholder="Address" name="address" v-model="address" /><br>
     <!-- <label>Address</label> -->
</div>
  <div class="user-box">
    <input required type="email" placeholder="Email" name="email" v-model="email" /><br>
     <!-- <label>Email</label> -->
</div><br>
        <button type="submit"> Register</button>
        <p class="message">Already registered? <a href="login.php" class="text-primary">Sign In</a></p>
</form>
</div>
</div>
</div>
<?php include "includes/footer.php"; ?>
    

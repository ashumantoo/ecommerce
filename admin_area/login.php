<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles/login_style.css" media="all">
  </head>
  <body>
    <div class="login">
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?> </h2>
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out']; ?> </h2>
	  <h1>Admin Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login.</button>
    </form>
</div>
  </body>
</html>

<?php
session_start();
include 'include/Connection.php';

if (isset($_POST['login'])) {
   $email = $_POST['email'];
   $pass =  $_POST['p'];

   $sel_admin = "SELECT * FROM admins WHERE user_email='$email' AND user_pass='$pass'";
   $run_admin = mysqli_query($con,$sel_admin);

   $check_admin = mysqli_num_rows($run_admin);

   if ($check_admin == 0) {
     echo "<script>alert('Password or Email is wrong, Try again!')</script>";
   }else {

     $_SESSION['user_email'] = $email;
     echo "<script>window.open('index.php?logged_in=You have successfully logged in!','_self')</script>";
   }
}
 ?>

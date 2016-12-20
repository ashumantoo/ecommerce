<?php
include 'includes/Connection.php';
 ?>

<div >

  <form action="" method="post" style="margin-top:30px;">
    <table width="720" align="center" bgcolor="skyblue">

      <tr align="center">
        <td colspan="3"><h2>Login or Register to Buy!</h2></td>
      </tr>

      <tr>
        <td align="right"><b>Email:</b></td>
        <td><input type="text" name="email" placeholder="Enter email" required=""></td>
      </tr>

      <tr>
        <td align="right"><b>Password:</b></td>
        <td><input type="password" name="pass" placeholder="Enter Password" required=""></td>
      </tr>

      <tr>
        <td colspan="3"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
      </tr>
      <tr align="center">
        <td colspan="3"><input type="submit" name="login" value="Login"></td>
      </tr>
    </table>

    <h2 style="float:right; padding:5px; margin-right:10px;"><a href="customer_register.php" style="text-decoration:none;">New? Register here</a></h2>
  </form>

  <!-- fetching the user credential from the customers table to user logging -->
  <?php
  if (isset($_POST['login'])) {

    $c_email = $_POST['email'];
    $c_pass = $_POST['pass'];

    $sel_customer = "SELECT * FROM customers WHERE customer_email='$c_email' AND customer_pass='$c_pass'";
    $run_customer = mysqli_query($con,$sel_customer);

    $check_customer = mysqli_num_rows($run_customer);

    if ($check_customer == 0) {
      echo "<script>alert('Password or email is incorrect! Please try again!')</script>";
      exit();
    }


    $ip = getIp();

    $sel_cart = "SELECT * FROM cart WHERE ip_add= '$ip'";
    $run_cart = mysqli_query($con,$sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if ($check_customer>0 AND $check_cart == 0) {
      $_SESSION['customer_email'] = $c_email;

      echo "<script>alert('You logged in successfully , Thanks!')</script>";
      echo "<script>window.open('customer/my_account.php','_self')</script>";
    }
    else {
      $_SESSION['customer_email'] = $c_email;

      echo "<script>alert('You logged in successfully , Thanks!')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";
    }
  }
   ?>
</div>

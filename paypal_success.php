<?php
session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Payment Successful!</title>
  </head>
  <body>

    <h2>Welcome <?php echo $_SESSION['customer_email']; ?></h2>
    <h3>Your Payment is successful , Please go to your Account</h3>
    <h3><a href="https://www.google.co.in/#gws_rd=ssl">Go to your Account</a></h3>
  </body>
</html>

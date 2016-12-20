<!DOCTYPE html>
<?php
session_start();
include 'functions/functions.php';
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>My online shop</title>

    <link rel="stylesheet" href="styles/style.css"charset="utf-8" media="all">
  </head>
  <body>

    <!-- Main Container starts from here-->
    <div class="main_wrapper">

        <!-- Header starts from here-->
        <div class="header_wrapper">
          <a href="../index.php"><img id="logo"  src="images/logo.png" alt="logo" height="100" width="250"/></a>
          <img id="banner" src="images/banner.jpg" alt="bannner" height="100" width="750"/>
        </div>
        <!-- Header ends here-->

        <!-- Nevigation or menubar starts from here-->
        <div class="menubar">
            <ul id="menu">
              <li><a href="../index.php">Home</a></li>
              <li><a href="../all_products.php">All Products</a></li>
              <li><a href="customer/my_account.php">My Accounts</a></li>
              <li><a href="#">Sign Up</a></li>
              <li><a href="cart.php">Shopping cart</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>

            <!--Search box -->
            <div id="form">
              <form action="results.php" method="get" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Search a product">
                <input type="submit" name="search" value="Search">
              </form>
            </div>
            <!--Search box ends here-->
        </div>
        <!-- Navigation or menubar ends here-->

        <!-- Content wrapper starts from here-->
        <div class="content_wrapper">
          <!--sidebar starts here-->
          <div id="sidebar">
            <div id="sidebar_title" style="text-align:center;">My Account:</div>
               <ul id="cats">
                 <!--Fetching the customer image from the database and showing on the my Account page -->
                 <?php
                   $user = $_SESSION['customer_email'];
                   $get_image = "SELECT * FROM customers WHERE customer_email='$user'";
                   $run_image = mysqli_query($con,$get_image);

                   $row_image = mysqli_fetch_array($run_image);
                   $customer_image = $row_image['customer_image'];
                   $customer_name = $row_image['customer_name'];

                   echo "<p style='text-align:center;'><img src='customer_images/$customer_image' width='150' height='150'></p>";
                  ?>
                  <li><a href="my_account.php?my_orders">My Orders</a></li>
                  <li><a href="my_account.php?edit_account">Edit Account</a></li>
                  <li><a href="my_account.php?change_pass">Change Password</a></li>
                  <li><a href="my_account.php?delete_account">Delete Account</a></li>
                  <li><a href="logout.php">Logout</a></li>
               </ul>

          </div>

          <div id="content_area">
             <!-- Calling the cart function -->
               <?php cart(); ?>

            <!-- shopping Cart bar div -->
            <div id="shopping_cart">

                <span style="float:right; font-size:17px; padding:5px;line-height:45px;">

                 <!-- setting up the user email from the database -->
                 <?php
                   if (isset($_SESSION['customer_email'])) {
                     echo "<b>Welcome:</b> ".$_SESSION['customer_email'];
                   }
                  ?>

                  <!-- Checking that the person is logged in or not using the session with the user email -->
                  <?php
                   if (!isset($_SESSION['customer_email'])) {
                     echo "<a href='checkout.php' style='color:blue' >Login</a>";
                   }else {
                     echo "<a href='logout.php' style='color:orange;'>Logout</a>";
                   }
                   ?>

                </span>
            </div>

            <!-- Product div -->
            <div id="product_box">

              <!--Showing the customer name -->
              <?php
                if (!isset($_GET['my_orders'])) {
                  if (!isset($_GET['edit_account'])) {
                    if (!isset($_GET['change_pass'])) {
                      if (!isset($_GET['delete_account'])) {
                        echo "<h2 style='padding:20px;'>Welcome :  $customer_name</h2>";
                        echo "<b>You can see your orders Progress by Clicking on this<a href='my_account.php?my_orders'>Link</a></b>";
                      }
                    }
                  }
                }
               ?>

               <!-- including the my_order page which is actually dynamic link-->
               <?php
                if (isset($_GET['edit_account'])) {
                  include 'edit_account.php';
                }
                if (isset($_GET['change_pass'])) {
                  include 'change_pass.php';
                }
                if (isset($_GET['delete_account'])) {
                  include 'delete_account.php';
                }
                ?>
            </div>
          </div>
        </div>
        <!-- Containts wrappter ends from here-->

          <!-- Footer starts from here-->
        <div id="footer">
          <h2 style="text-align:center; padding-top:30px">&copy;2016 Created by Ashutosh Kumar Mantoo</h2>
        </div>
          <!-- footer ends from here-->
    </div>

      <!-- Main Container ends from here-->
  </body>
</html>

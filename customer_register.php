<!DOCTYPE html>
<?php
session_start();
include 'functions/functions.php';
include 'includes/Connection.php';
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
          <a href="index.php"><img id="logo"  src="images/logo.png" alt="logo" height="100" width="250"/></a>
          <img id="banner" src="images/banner.jpg" alt="bannner" height="100" width="750"/>
        </div>
        <!-- Header ends here-->

        <!-- Nevigation or menubar starts from here-->
        <div class="menubar">
            <ul id="menu">
              <li><a href="index.php">Home</a></li>
              <li><a href="all_products.php">All Products</a></li>
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
            <div id="sidebar_title">Categories</div>
               <ul id="cats">
                  <!-- getting dynamic categories using php function directly from DB-->
                  <?php getCats(); ?>
               </ul>

               <div id="sidebar_title">Brands</div>
                  <ul id="cats">
                    <!-- getting dynamic Brands using php function directly from DB-->
                    <?php getBrands(); ?>
                  </ul>
          </div>

          <div id="content_area">
             <!-- Calling the cart function -->
               <?php cart(); ?>

            <!-- shopping Cart bar div -->
            <div id="shopping_cart">

                <span style="float:right; font-size:18px; padding:5px;line-height:45px;">
                  Welcome Guest! <b style="color:yellow">Shopping Cart -</b>Total item: <?php toatal_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">Go to Cart</a>
                </span>
            </div>

            <form action="customer_register.php" method="post" enctype="multipart/form-data">
              <table align="center" width="750">

                <tr align="center">
                  <td colspan="6"><h2>Create an Account</h2></td>
                </tr>

                <tr>
                  <td align="right">Customer Name:</td>
                  <td><input type="text" name="c_name"></td>
                </tr>

                <tr>
                  <td align="right">Customer Email*:</td>
                  <td><input type="text" name="c_email" required=""></td>
                </tr>

                <tr>
                  <td align="right">Customer Password*:</td>
                  <td><input type="password" name="c_pass" value="" required=""></td>
                </tr>

                <tr>
                  <td align="right">Customer Image:</td>
                  <td><input type="file" name="c_image" value=""></td>
                </tr>

                <tr>
                  <td align="right">Customer Country</td>
                  <td>
                    <select name="c_country">
                      <option>Select a Country</option>
                      <option>India</option>
                      <option>Pakistan</option>
                      <option>Nepal</option>
                      <option>America</option>
                      <option>China</option>
                      <option>Japan</option>
                      <option>Shri Lanka</option>
                      <option>Bangladesh</option>
                      <option>England</option>
                      <option>Newzealand</option>
                      <option>Australia</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td align="right">Customer City:</td>
                  <td><input type="text" name="c_city"></td>
                </tr>

                <tr>
                  <td align="right">Customer Contact</td>
                  <td><input type="text" name="c_contact"></td>
                </tr>

                <tr>
                  <td align="right">Customer Address</td>
                  <td><textarea name="c_address" rows="2" cols="20"></textarea></td>
                </tr>

                <tr align="center">
                  <td colspan="6"><input type="submit" name="register" value="Create Account"></td>
                </tr>
              </table>
            </form>
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

<!-- php script for the registering the Customer -->
<?php
 if (isset($_POST['register'])) {

   $ip = getIp();

   $c_name = $_POST['c_name'];
   $c_email = $_POST['c_email'];
   $c_pass = $_POST['c_pass'];
   $c_image = $_FILES['c_image']['name'];
   $c_image_tmp = $_FILES['c_image']['tmp_name'];
   $c_country = $_POST['c_country'];
   $c_city = $_POST['c_city'];
   $c_contact = $_POST['c_contact'];
   $c_address = $_POST['c_address'];

   move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

   $insert_customer = "INSERT INTO customers
   (customer_ip,customer_name,	customer_email,	customer_pass,	customer_country,	customer_city,	customer_contact,customer_address,	customer_image)
   VALUES ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";

   $run_customer = mysqli_query($con,$insert_customer);

   $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";

   $run_cart = mysqli_query($con,$sel_cart);

   $check_cart = mysqli_num_rows($run_cart);

   if ($check_cart == 0) {

     $_SESSION['customer_email'] = $c_email;

     echo "<script>alert('Accont has been Created successfully , Thanks!')</script>";
     echo "<script>window.open('customer/my_account.php','_self')</script>";
   }
   else {

          $_SESSION['customer_email'] = $c_email;

          echo "<script>alert('Accont has been Created successfully , Thanks!')</script>";
          echo "<script>window.open('checkout.php','_self')</script>";
        }
 }
 ?>

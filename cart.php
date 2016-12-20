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

                <span style="float:right; font-size:17px; padding:5px;line-height:45px;">
                  <!-- setting up the user email from the database -->
                  <?php
                    if (isset($_SESSION['customer_email'])) {
                      echo "<b>Welcome:</b> ".$_SESSION['customer_email']." <b style='color:yellow;'>Your</b>";
                    }else {
                      echo "<b>Welcome Guest:</b>";
                    }
                   ?>
                  <b style="color:yellow">Shopping Cart -</b>Total item: <?php toatal_items(); ?> Total Price: <?php total_price(); ?> <a href="index.php" style="color:yellow">Back to Shop</a>

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
              <!-- form for the cart page -->
              <br>
              <form method="post" enctype="multipart/form-data">

                <table align ="center" width="700" bgcolor="skyblue">

                  <tr aling="center">
                    <th>Remove</th>
                    <th>Product(s)</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                  </tr>

                  <?php
                  $total = 0;

                  global $con;
                  $ip = getIp();

                  $price_query = "SELECT * FROM cart WHERE ip_add='$ip'";
                  $run_price = mysqli_query($con,$price_query);
                  while ($p_price = mysqli_fetch_array($run_price)) {
                    $pro_id = $p_price['p_id'];
                    $prod_price = "SELECT * FROM products WHERE product_id='$pro_id'";

                    $run_prod_price = mysqli_query($con,$prod_price);

                    while ($pp_price = mysqli_fetch_array($run_prod_price)) {
                      $product_price = array($pp_price['product_price']);

                      $product_title = $pp_price['product_title'];

                      $product_image = $pp_price['product_image'];

                      $single_price = $pp_price['product_price'];

                      $values = array_sum($product_price);

                      $total += $values;
                   ?>

                   <tr align="center">
                      <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                      <td><?php echo $product_title; ?><br>
                        <img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
                      </td>
                      <td><input type="text" name="qty" size="4" value=""></td>

                      <!-- Updating the Quantity value in the cart database table -->
                      <?php
                      /*
                        if (isset($_POST['update_cart'])) {
                          $qty = $_POST['qty'];

                          $update_qty = "UPDATE cart SET qty='$qty'";
                          $run_qty = mysqli_query($con,$update_qty);

                          $_SESSION['qty'] = $qty;

                          $total = $total*$qty;
                        }
                        */
                       ?>

                      <td><?php echo "$ ".$single_price; ?></td>
                   </tr>

                 <?php  } } ?>

                 <tr align="right">
                   <td colspan="5"><b>Sub Total</b></td>
                   <td><?php echo "$ ".$total; ?></td>
                 </tr>

                 <tr align="center">
                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
                    <td><input type="submit" name="continue" value="Continue Shopping"></td>
                    <td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
                 </tr>
                </table>
              </form>

              <!-- php script for updating the shopping cart page -->
              <?php

              $ip = getIp();

              if (isset($_POST['update_cart'])) {

                foreach ($_POST['remove'] as $remove_id) {

                  $delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'";

                  $run_delete = mysqli_query($con,$delete_product);

                  if ($run_delete) {
                    echo "<script>window.open('cart.php','_self')</script>";
                  }
                }
              }
              if (isset($_POST['continue'])) {
                echo "<script>window.open('index.php','_self')</script>";
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

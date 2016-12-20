<!DOCTYPE html>
<?php
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
          <a href="index.php"><img id="logo"  src="images/logo.png" alt="logo" height="100" width="250" /></a>
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

            <!-- shopping Cart bar div -->
            <div id="shopping_cart">

                <span style="float:right; font-size:18px; padding:5px;line-height:45px;">
                  Welcome Guest! <b style="color:yellow">Shopping Cart -</b>Total item:Total Price: <a href="cart.php" style="color:yellow">Go to Cart</a>
                </span>
            </div>
            <!--Single Product details div -->
            <div id="product_box">
                 <!--calling getSingle_Prodetails() function to Displaying single Products detials from the Database using php script-->
               <?php getSingle_Prodetails(); ?>
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

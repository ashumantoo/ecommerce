<?php
 include 'Connection.php';

 //Function to get Categories from the Database dynamically
 function getCats(){

   global $con;

   $get_cats = "SELECT * FROM categories";
   $run_cats = mysqli_query($con,$get_cats);

   while ($row_cats = mysqli_fetch_array($run_cats)) {
     $cat_id = $row_cats['cat_id'];
     $cat_title = $row_cats['cat_title'];

     echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
   }
 }

 //Function to get Barands from the Database dynamically
 function getBrands(){

   global $con;

   $get_brands = "SELECT * FROM brands";
   $run_brands = mysqli_query($con,$get_brands);

   while ($row_brands = mysqli_fetch_array($run_brands)) {
     $brand_id = $row_brands['brand_id'];
     $brand_title = $row_brands['brand_title'];

     echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
   }
 }

 //Function to get the Products details from the product table
 function getPro(){
   if (!isset($_GET['cat'])) {
     if (!isset($_GET['brand'])) {
       global $con;

       $get_pro = "SELECT * FROM products order by RAND () LIMIT 0,9";

       $run_pro = mysqli_query($con,$get_pro);

       while ($row_pro = mysqli_fetch_array($run_pro)) {

         $pro_id = $row_pro['product_id'];
         $pro_cat = $row_pro['product_cat'];
         $pro_brand = $row_pro['product_brand'];
         $pro_title = $row_pro['product_title'];
         $pro_price = $row_pro['product_price'];
         $pro_image = $row_pro['product_image'];

         echo "
             <div id='single_product'>
                <h3>$pro_title</h3>
                <img src='admin_area/product_images/$pro_image' width='180' height='180'/>
                <p><b> Price: $ $pro_price</b></p>
                <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
             </div>
         ";
       }
     }
   }
 }

// Function to get Product by selecting the Category
 function getProductByCategory(){
   if (isset($_GET['cat'])) {

     $cat_id = $_GET['cat'];
       global $con;

       $get_cat_pro = "SELECT * FROM products WHERE product_cat='$cat_id'";

       $run_cat_pro = mysqli_query($con,$get_cat_pro);

       $count_cats = mysqli_num_rows($run_cat_pro);

       if ($count_cats == 0) {
         echo "<h2 style='text-align:center; padding:5px'>No Product found in this Category!!</h2>";
       }

       while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {

         $pro_id = $row_cat_pro['product_id'];
         $pro_cat = $row_cat_pro['product_cat'];
         $pro_brand = $row_cat_pro['product_brand'];
         $pro_title = $row_cat_pro['product_title'];
         $pro_price = $row_cat_pro['product_price'];
         $pro_image = $row_cat_pro['product_image'];

         echo "
             <div id='single_product'>
                <h3>$pro_title</h3>
                <img src='admin_area/product_images/$pro_image' width='180' height='180'/>
                <p><b>$ $pro_price</b></p>
                <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
             </div>
         ";
      }
   }
 }

 // Function to get Product by selecting the Brands
  function getProductByBrand(){
    if (isset($_GET['brand'])) {

      $brand_id = $_GET['brand'];
        global $con;

        $get_brand_pro = "SELECT * FROM products WHERE product_brand='$brand_id'";

        $run_brand_pro = mysqli_query($con,$get_brand_pro);

        $count_brand = mysqli_num_rows($run_brand_pro);

        if ($count_brand == 0) {
          echo "<h2 style='text-align:center; padding:5px'>No Product found related to this Brand!!</h2>";
        }

        while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {

          $pro_id = $row_brand_pro['product_id'];
          $pro_cat = $row_brand_pro['product_cat'];
          $pro_brand = $row_brand_pro['product_brand'];
          $pro_title = $row_brand_pro['product_title'];
          $pro_price = $row_brand_pro['product_price'];
          $pro_image = $row_brand_pro['product_image'];

          echo "
              <div id='single_product'>
                 <h3>$pro_title</h3>
                 <img src='admin_area/product_images/$pro_image' width='180' height='180'/>
                 <p><b>$ $pro_price</b></p>
                 <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                 <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
              </div>
          ";
       }
    }
  }
 //Function to get single products details for the details page
 function getSingle_Prodetails(){

   global $con;

   if (isset($_GET['pro_id'])) {
     $product_id = $_GET['pro_id'];

     $get_pro = "SELECT * FROM products WHERE product_id='$product_id'";

     $run_pro = mysqli_query($con,$get_pro);

     while ($row_pro = mysqli_fetch_array($run_pro)) {

       $pro_id = $row_pro['product_id'];
       $pro_title = $row_pro['product_title'];
       $pro_price = $row_pro['product_price'];
       $pro_image = $row_pro['product_image'];
       $pro_desc = $row_pro['product_desc'];

       echo "
           <div id='single_product'>
              <h3>$pro_title</h3>
              <img src='admin_area/product_images/$pro_image' width='400' height='300'/>
              <p><b>$ $pro_price</b></p>
               <p>$pro_desc</p>
              <a href='index.php' style='float:left;'>Go back</a>
              <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
           </div>
       ";
     }
   }
}

//function to get the current User ip address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}


//function to add the product into the cart
function cart(){

  if (isset($_GET['add_cart'])) {
    global $con;
    $ip = getIp();

    $pro_id = $_GET['add_cart'];

    $check_pro = "SELECT * FROM cart WHERE ip_add = '$ip' AND p_id='$pro_id'";

    $run_check = mysqli_query($con,$check_pro);

    if (mysqli_num_rows($run_check)>0) {
      echo "<script>alert('You have already added this to cart!')</script>";
    }else {
      $insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
      $run_pro = mysqli_query($con,$insert_pro);

      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}

//getting the total added items
function toatal_items(){
  if (isset($_GET['add_cart'])) {
    global $con;
    $ip = getIp();

    $get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
    $run_items = mysqli_query($con,$get_items);
    $count_items = mysqli_num_rows($run_items);
  }else {
    global $con;
    $ip = getIp();

    $get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
    $run_items = mysqli_query($con,$get_items);
    $count_items = mysqli_num_rows($run_items);
  }
  echo $count_items;
}

//Getting the total price of the items in the cart
function total_price(){

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

      $values = array_sum($product_price);

      $total +=$values;
    }
  }
  echo "$".$total;
}
 ?>

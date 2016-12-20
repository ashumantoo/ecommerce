<!DOCTYPE html>
<?php
include 'include/Connection.php';
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inserting Product</title>
    <!-- Script for the text editor -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body bgcolor="skyblue">
    <form action="insert_product.php" method="post" enctype="multipart/form-data">
       <table align="center" width="795" border="2" bgcolor="#187eae">
          <tr align="center">
             <td colspan="7"><h2>Insert Now Product Here</h2></td>
          </tr>

          <tr>
             <td align="right"><b>Product Title:</b></td>
             <td><input type="text" name="product_title" size="40" required></td>
          </tr>

          <tr>
             <td align="right"><b>Product Category:</b></td>
             <td>
               <select name="product_cat" required>
                 <option>Select a Category Name</option>
                 <!-- php code to select the categories from the Database-->
                  <?php
                  $get_cats = "SELECT * FROM categories";
                  $run_cats = mysqli_query($con,$get_cats);

                  while ($row_cats = mysqli_fetch_array($run_cats)) {
                    $cat_id = $row_cats['cat_id'];
                    $cat_title = $row_cats['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                  }
                   ?>
               </select>
             </td>
          </tr>

          <tr>
             <td align="right"><b>Product Brand:</b></td>
             <td>
               <select name="product_brand" required="">
                 <option>Select a Brand Name</option>
                  <!-- php code to select the brands from the Database-->
                 <?php
                 $get_brands = "SELECT * FROM brands";
                 $run_brands = mysqli_query($con,$get_brands);

                 while ($row_brands = mysqli_fetch_array($run_brands)) {
                   $brand_id = $row_brands['brand_id'];
                   $brand_title = $row_brands['brand_title'];

                   echo "<option value='$brand_id'>$brand_title</option>";
                 }
                  ?>
               </select>
             </td>
          </tr>

          <tr>
             <td align="right"><b>Product Image:</b></td>
             <td><input type="file" name="product_image" required=""></td>
          </tr>

          <tr>
             <td align="right"><b>Product Price:</b></td>
             <td><input type="text" name="product_price" required=""></td>
          </tr>

          <tr>
             <td align="right"><b>Product Description:</b></td>
             <td><textarea name="product_desc" rows="12" cols="20"></textarea></td>
          </tr>

          <tr>
             <td align="right"><b>Product Keywords:</b></td>
             <td><input type="text" name="product_keywords" size="40" required=""></td>
          </tr>

          <tr align="center ">
             <td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now"></td>
          </tr>
       </table>
    </form>
  </body>
</html>

<!-- PHP Script to insert the Proudcts details into the database table -->
<?php
   if (isset($_POST['insert_post'])) {

     //Getting the text data from the from fields
     $product_title = $_POST['product_title'];
     $product_cat = $_POST['product_cat'];
     $product_brand = $_POST['product_brand'];
     $product_price = $_POST['product_price'];
     $product_desc = $_POST['product_desc'];
     $product_keywords = $_POST['product_keywords'];

     //getting the images from the form field
     $product_image = $_FILES['product_image']['name'];
     $product_image_tmp = $_FILES['product_image']['tmp_name'];

     //moving the images to the specific location
     move_uploaded_file($product_image_tmp,"product_images/$product_image");

     $insert_product = "INSERT INTO products
     (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) VALUES
     ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";

     $insert_pro = mysqli_query($con,$insert_product);

     if ($insert_pro) {
       echo "<script>alert('Product has been inserted Successfully')</script>";
       echo "<script>window.open('index.php?insert_product','_self')</script>";
     }
   }
 ?>

<?php } ?>

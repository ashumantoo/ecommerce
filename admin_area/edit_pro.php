<!DOCTYPE html>
<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<?php
include 'include/Connection.php';

if (isset($_GET['edit_pro'])) {
  $get_id = $_GET['edit_pro'];

  $get_products = "SELECT * FROM products WHERE product_id='$get_id'";

  $run_products = mysqli_query($con,$get_products);

  $i =0;

  $row_products = mysqli_fetch_array($run_products);

    $pro_id = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_image = $row_products['product_image'];
    $pro_price = $row_products['product_price'];
    $pro_desc = $row_products['product_desc'];
    $pro_keywords = $row_products['product_keywords'];
    $pro_cat = $row_products['product_cat'];
    $pro_brand = $row_products['product_brand'];

    //Displaying the Category title not the id
    $get_cat = "SELECT * FROM categories WHERE cat_id='$pro_cat'";
    $run_cat = mysqli_query($con,$get_cat);
    $row_cat = mysqli_fetch_array($run_cat);

    $category_title = $row_cat['cat_title'];

    //Displaying the Brand title not the id
    $get_brand = "SELECT * FROM brands WHERE brand_id='$pro_brand'";
    $run_brand = mysqli_query($con,$get_brand);
    $row_brand = mysqli_fetch_array($run_brand);

    $brand_title = $row_brand['brand_title'];
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Updating Product</title>
    <!-- Script for the text editor -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea'});</script>
  </head>
  <body bgcolor="skyblue">
    <form action="" method="post" enctype="multipart/form-data">
       <table align="center" width="795" border="2" bgcolor="#187eae">
          <tr align="center">
             <td colspan="7"><h2>Edit & Update Product Here</h2></td>
          </tr>

          <tr>
             <td align="right"><b>Product Title:</b></td>
             <td><input type="text" name="product_title" size="40" value="<?php echo $pro_title;?>"></td>
          </tr>

          <tr>
             <td align="right"><b>Product Category:</b></td>
             <td>
               <select name="product_cat" required>
                 <option><?php echo $category_title; ?></option>
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
                 <option><?php echo $brand_title; ?></option>
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
             <td><input type="file" name="product_image" ><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"/></td>
          </tr>

          <tr>
             <td align="right"><b>Product Price:</b></td>
             <td><input type="text" name="product_price" value="<?php echo $pro_price; ?>"></td>
          </tr>

          <tr>
             <td align="right"><b>Product Description:</b></td>
             <td><textarea name="product_desc" rows="8" cols="35"><?php echo $pro_desc; ?></textarea></td>
          </tr>

          <tr>
             <td align="right"><b>Product Keywords:</b></td>
             <td><input type="text" name="product_keywords" size="40" value="<?php echo $pro_keywords; ?>"></td>
          </tr>

          <tr align="center ">
             <td colspan="7"><input type="submit" name="update_product" value="Update Product"></td>
          </tr>
       </table>
    </form>
  </body>
</html>

<!-- PHP Script to insert the Proudcts details into the database table -->
<?php
   if (isset($_POST['update_product'])) {

     //Getting the text data from the from fields
     $update_id = $pro_id;

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

     $update_product = "UPDATE products SET product_cat='$product_cat',product_brand='$product_brand',product_title='$product_title',
     product_price='$product_price',product_desc='$product_desc',product_image='$product_image',product_keywords='$product_keywords'
     WHERE product_id='$update_id'";

     $run_product = mysqli_query($con,$update_product);

     if ($run_product) {
       echo "<script>alert('A product has been Updated!')</script>";
       echo "<script>window.open('index.php?view_products','_self')</script>";
     }
   }
 ?>
<?php } ?>

<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<form action="" method="post" style="padding:60px; margin-left:100px">
  <b>Insert New Brand:</b>
  <input type="text" name="new_brand"/>
  <input type="submit" name="add_brand" value="Add Brand"/>
</form>

<?php
include 'include/Connection.php';

if (isset($_POST['add_brand'])) {
  $new_brand = $_POST['new_brand'];
  $insert_brand = "INSERT INTO brands (brand_title) VALUES ('$new_brand')";
  $run_brand = mysqli_query($con,$insert_brand);

  if ($run_brand) {
    echo "<script>alert('New Brand has been Added!')</script>";
    echo "<script>window.open('index.php?view_brands','_self')</script>";
  }
}

 ?>
<?php } ?>

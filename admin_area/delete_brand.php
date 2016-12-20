<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<?php
include 'include/Connection.php';

if (isset($_GET['delete_brand'])) {
  $delete_id = $_GET['delete_brand'];
  $delete_brand = "DELETE FROM brands WHERE brand_id='$delete_id'";
  $run_delete = mysqli_query($con,$delete_brand);

  if ($run_delete) {
    echo "<script>alert('A Brand has been deleted!')</script>";
    echo "<script>window.open('index.php?view_brands','_self')</script>";
  }
}
 ?>
 <?php } ?>

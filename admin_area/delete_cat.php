<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<?php
include 'include/Connection.php';

if (isset($_GET['delete_cat'])) {
  $delete_id = $_GET['delete_cat'];
  $delete_cat = "DELETE FROM categories WHERE cat_id='$delete_id'";
  $run_delete = mysqli_query($con,$delete_cat);

  if ($run_delete) {
    echo "<script>alert('A Category has been deleted!')</script>";
    echo "<script>window.open('index.php?view_cats','_self')</script>";
  }
}
 ?>
<?php } ?>

<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<?php
include 'include/Connection.php';

if (isset($_GET['delete_customer'])) {
  $delete_id = $_GET['delete_customer'];
  $delete_customer = "DELETE FROM customers WHERE customer_id='$delete_id'";
  $run_delete = mysqli_query($con,$delete_customer);

  if ($run_delete) {
    echo "<script>alert('Customer has been deleted!')</script>";
    echo "<script>window.open('index.php?view_customers','_self')</script>";
  }
}
 ?>
<?php } ?>

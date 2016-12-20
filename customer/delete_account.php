<br>
<h2 style="text-align:center;">Do you really want to delete your Account?</h2>

<form action="" method="post">
<br>
  <input type="submit" name="yes" value="Yes I want">
  <input type="submit" name="no" value="No, Not at this time!">
</form>

<?php
include 'includes/Connection.php';

$user = $_SESSION['customer_email'];

if (isset($_POST['yes'])) {
  $delete_customer = "DELETE FROM customers WHERE customer_email='$user'";
  $run_delete = mysqli_query($con,$delete_customer);

  echo "<script>alert('We are really sorry, Your account has been deleted!')</script>";
  echo "<script>window.open('../index.php','_self')</script>";
}
if (isset($_POST['no'])) {
  echo "<script>alert('Oh! do not joke again!')</script>";
  echo "<script>window.open('my_account.php','_self')</script>";
}
 ?>

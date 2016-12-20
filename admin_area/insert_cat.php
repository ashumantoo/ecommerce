<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<form action="" method="post" style="padding:60px; margin-left:100px">
  <b>Insert New Category:</b>
  <input type="text" name="new_cat"/>
  <input type="submit" name="add_cat" value="Add Category"/>
</form>

<?php
include 'include/Connection.php';

if (isset($_POST['add_cat'])) {
  $new_cat = $_POST['new_cat'];
  $insert_cat = "INSERT INTO categories (cat_title) VALUES ('$new_cat')";
  $run_cat = mysqli_query($con,$insert_cat);

  if ($run_cat) {
    echo "<script>alert('New Category has been Added!')</script>";
    echo "<script>window.open('index.php?view_cats','_self')</script>";
  }
}

 ?>
 <?php } ?>

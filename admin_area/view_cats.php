<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<table width="795" align="center" bgcolor="pink">

  <tr align="center">
    <td colspan="6"><h2>View All categories here</h2></td>
  </tr>

  <tr align="center" bgcolor="skyblue">
      <th>Category ID</th>
      <th>categories Title</th>
      <th>Edit</th>
      <th>Delete</th>
  </tr>

  <?php
    include 'include/Connection.php';

    $get_cats = "SELECT * FROM categories";

    $run_cat = mysqli_query($con,$get_cats);

    $i =0;

    while ($row_cat = mysqli_fetch_array($run_cat)) {

      $cat_id = $row_cat['cat_id'];
      $cat_title = $row_cat ['cat_title'];
      $i++;
   ?>

  <tr align="center">
    <td><?php echo $i; ?></td>
    <td><?php echo $cat_title; ?></td>
    <td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
    <td><a href="delete_cat.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
  </tr>
  <?php   } ?>
</table>
<?php } ?>

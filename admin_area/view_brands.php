<?php
 if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {
 ?>
<table width="795" align="center" bgcolor="pink">

  <tr align="center">
    <td colspan="6"><h2>View All Brands here</h2></td>
  </tr>

  <tr align="center" bgcolor="skyblue">
      <th>Brand ID</th>
      <th>Brand Title</th>
      <th>Edit</th>
      <th>Delete</th>
  </tr>

  <?php
    include 'include/Connection.php';

    $get_brands = "SELECT * FROM brands";

    $run_brands = mysqli_query($con,$get_brands);

    $i =0;

    while ($row_brand = mysqli_fetch_array($run_brands)) {

      $brand_id = $row_brand['brand_id'];
      $brand_title = $row_brand ['brand_title'];
      $i++;
   ?>

  <tr align="center">
    <td><?php echo $i; ?></td>
    <td><?php echo $brand_title; ?></td>
    <td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
    <td><a href="delete_brand.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
  </tr>
  <?php   } ?>
</table>
<?php } ?>

<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<table width="795" align="center" bgcolor="pink">

  <tr align="center">
    <td colspan="6"><h2>View All Products here</h2></td>
  </tr>

  <tr align="center" bgcolor="skyblue">
      <th>S.No</th>
      <th>Title</th>
      <th>Image</th>
      <th>Price</th>
      <th>Edit</th>
      <th>Delete</th>
  </tr>

  <?php
    include 'include/Connection.php';

    $get_products = "SELECT * FROM products";

    $run_products = mysqli_query($con,$get_products);

    $i =0;

    while ($row_products = mysqli_fetch_array($run_products)) {

      $pro_id = $row_products['product_id'];
      $pro_title = $row_products['product_title'];
      $pro_image = $row_products['product_image'];
      $pro_price = $row_products['product_price'];
      $i++;
   ?>

  <tr align="center">
    <td><?php echo $i; ?></td>
    <td><?php echo $pro_title; ?></td>
    <td><img src="product_images/<?php echo $pro_image;?>" width="60px" height="60px"/></td>
    <td><?php echo $pro_price; ?></td>
    <td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
    <td><a href="delete_pro.php?delete_pro=<?php echo $pro_id; ?>">Delete</a></td>
  </tr>
  <?php   } ?>
</table>
<?php } ?>

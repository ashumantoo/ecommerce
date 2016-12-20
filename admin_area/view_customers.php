<?php
if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}
else {

 ?>
<table width="795" align="center" bgcolor="pink">

  <tr align="center">
    <td colspan="6"><h2>View All Customers here</h2></td>
  </tr>

  <tr align="center" bgcolor="skyblue">
      <th>S.No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Image</th>
      <th>Delete</th>
  </tr>

  <?php
    include 'include/Connection.php';

    $get_customer = "SELECT * FROM customers";

    $run_customer = mysqli_query($con,$get_customer);

    $i =0;

    while ($row_customer = mysqli_fetch_array($run_customer)) {

      $c_id = $row_customer['customer_id'];
      $c_name = $row_customer['customer_name'];
      $c_email = $row_customer['customer_email'];
      $c_image = $row_customer['customer_image'];
      $i++;
   ?>

  <tr align="center">
    <td><?php echo $i; ?></td>
    <td><?php echo $c_name; ?></td>
    <td><?php echo $c_email; ?></td>
    <td><img src="../customer/customer_images/<?php echo $c_image;?>" width="60px" height="60px"/></td>
    <td><a href="delete_customer.php?delete_customer=<?php echo $c_id; ?>">Delete</a></td>
  </tr>
  <?php   } ?>
</table>
<?php } ?>

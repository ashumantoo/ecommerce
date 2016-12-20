<?php
include 'includes/Connection.php';

$user = $_SESSION['customer_email'];
$get_customer = "SELECT * FROM customers WHERE customer_email='$user'";
$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$c_id = $row_customer['customer_id'];
$name = $row_customer['customer_name'];
$email = $row_customer['customer_email'];
$pass = $row_customer['customer_pass'];
$country = $row_customer['customer_country'];
$city = $row_customer['customer_city'];
$contact = $row_customer['customer_contact'];
$address = $row_customer['customer_address'];
$image = $row_customer['customer_image'];
 ?>

<!DOCTYPE html>
            <form action="" method="post" enctype="multipart/form-data">
              <table align="center" width="750">

                <tr align="center">
                  <td colspan="9"><h2>Update your Account</h2></td>
                </tr>

                <tr>
                  <td align="right">Customer Name:</td>
                  <td><input type="text" name="c_name" value="<?php echo $name; ?>"></td>
                </tr>

                <tr>
                  <td align="right">Customer Email*:</td>
                  <td><input type="text" name="c_email" value="<?php echo $email; ?>" required=""></td>
                </tr>

                <tr>
                  <td align="right">Customer Password*:</td>
                  <td><input type="password" name="c_pass" value="<?php echo $pass; ?>" required=""></td>
                </tr>

                <tr>
                  <td align="right">Customer Image:</td>
                  <td><input type="file" name="c_image" value=""><img src="customer_images/<?php echo $image; ?>" alt="" height="60" width="60" /></td>
                </tr>

                <tr>
                  <td align="right">Customer Country</td>
                  <td>
                    <select name="c_country" disabled="">
                      <option><?php echo $country; ?></option>
                      <option>India</option>
                      <option>Pakistan</option>
                      <option>Nepal</option>
                      <option>America</option>
                      <option>China</option>
                      <option>Japan</option>
                      <option>Shri Lanka</option>
                      <option>Bangladesh</option>
                      <option>England</option>
                      <option>Newzealand</option>
                      <option>Australia</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td align="right">Customer City:</td>
                  <td><input type="text" name="c_city" value="<?php echo $city; ?>"></td>
                </tr>

                <tr>
                  <td align="right">Customer Contact</td>
                  <td><input type="text" name="c_contact" value="<?php echo $contact; ?>"></td>
                </tr>

                <tr>
                  <td align="right">Customer Address</td>
                  <td><textarea name="c_address" rows="2" cols="20"><?php echo $address; ?></textarea></td>
                </tr>

                <tr align="center">
                  <td colspan="9"><input type="submit" name="update" value="Update Account"></td>
                </tr>
              </table>
            </form>

<!-- php script for the registering the Customer -->
<?php
 if (isset($_POST['update'])) {

   $ip = getIp();

   $customer_id = $c_id;

   $c_name = $_POST['c_name'];
   $c_email = $_POST['c_email'];
   $c_pass = $_POST['c_pass'];
   $c_image = $_FILES['c_image']['name'];
   $c_image_tmp = $_FILES['c_image']['tmp_name'];
   $c_city = $_POST['c_city'];
   $c_contact = $_POST['c_contact'];
   $c_address = $_POST['c_address'];

   move_uploaded_file($c_image_tmp,"customer_images/$c_image");

   $update_customer = "UPDATE customers SET customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',
   customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address',
   customer_image='$c_image' WHERE customer_id='$customer_id'";

   $run_update = mysqli_query($con,$update_customer);

   if ($run_update) {
     echo "<script>alert('Your account has been successfully Updated!')</script>";
     echo "<script>window.open('my_account.php','_self')</script>";
   }
 }
 ?>



<!DOCTYPE html>
<html>
<head>

<?php

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cneprofile";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


if (isset($_SESSION['user_email'])) {
  header("Location:login.php");
  exit();

}


$email = $_SESSION['user_email'];
$sql = "SELECT * FROM `register` WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

?>



<h1>My Profile</h1>
<P><b>Name</b> <?php echo $user['name']; ?> </p>
<p><b>Email</b> <?php echo $user['email']; ?> </p>
<p><b>DOB</b> <?php echo $user['dob']; ?> </p>





</body>
</html>

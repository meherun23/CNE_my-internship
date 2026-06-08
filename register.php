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

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $pass = password_hash($_POST['psw'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO `register` (name, email, dob, pass)
            VALUES ('$name', '$email', '$dob', '$pass')";

    if (mysqli_query($conn, $sql)) {

        $_SESSION['user_email'] = $email;

        header("Location: profile.php");
        exit();

    } else {
        die("SQL Error: " . mysqli_error($conn));
    }
}
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>






<h1> REGISTRATION <h1>


<form method="POST" action="" style="border:1px solid #ccc">
  <div class="container">
    <h4>Sign Up</h4>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter name" name="name" required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="dob"><b>DOB</b></label>
    <input type="date" placeholder="Enter DOB" name="dob" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>


    <div class="clearfix">
      <button type="submit" name="register">Sign Up</button>
      <a href="login.php">
        <button type="button">Login</button>
      </a>
    </div>
  </div>
</form>






</body>
</html>







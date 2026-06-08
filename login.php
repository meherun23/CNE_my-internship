<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "cneprofile");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['psw'];

    $sql = "SELECT * FROM `register` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['pass'])) {

            $_SESSION['user_email'] = $email;

            header("Location: profile.php");
            exit();

        } else {
            echo "Wrong password!";
        }

    } else {
        echo "Can't find user!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>






<h1>LOGIN</h1>

<form method="POST" action="">

  <label>Email</label>
  <input type="email" name="email" required><br><br>

  <label>Password</label>
  <input type="password" name="psw" required><br><br>

  <button type="submit" name="login">Login</button>

</form>






</body>
</html>







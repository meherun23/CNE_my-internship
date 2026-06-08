

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cneprofile";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"]=="POST"){


$id = $_POST['id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$message = $_POST['message'];


if($id == ""){
    
    $sql = "INSERT INTO user (name, dob, email, message)
    VALUES ('$name', '$dob', '$email', '$message')";
} else {
    
    $sql = "UPDATE user SET
    name='$name',
    dob='$dob',
    email='$email',
    message='$message'
    WHERE id=$id";
}



if (mysqli_query($conn, $sql)){
  header("Location: ".$_SERVER['PHP_SELF']."?success=1");
  exit();
} 

 

else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

if(isset($_GET['delete'])){

$dlt_no = $_GET['delete'];

$dlt = "DELETE FROM user WHERE id=$dlt_no";

if(mysqli_query($conn, $dlt)){
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
} else {
    echo "Error" . mysqli_error($conn);
}

}


$edit_id="";
$edit_name="";
$edit_dob="";
$edit_email="";
$edit_message="";



if(isset($_GET['edit'])){
$edit_id = $_GET['edit'];
$edit_query = mysqli_query($conn, "SELECT * FROM user WHERE id= $edit_id");
$edit_data = mysqli_fetch_assoc ($edit_query);


$edit_name = $edit_data['name'];
$edit_dob = $edit_data['dob'];
$edit_email = $edit_data['email'];
$edit_message = $edit_data['message'];


}




$result = mysqli_query($conn,"SELECT*FROM user ORDER BY id DESC");


$color = "red";
$x=5+5;
echo 'my first PHP! <br>';
echo "this is to color $color <br>";
echo "the result is $x";

mysqli_close($conn);


?>


<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>


<h1>The input autofocus attribute</h1>

<p>The autofocus attribute specifies that the input field should automatically get focus when the page loads.</p>

<form method="POST" action="">
  <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
  <label for="name">name:</label><br>
  <input type="text" id="name" name="name" autofocus><br>
  <label for="dob">dob:</label><br>
  <input type="date" id="dob" name="dob" autofocus><br>
  <label for="email">email:</label><br>
  <input type="emaiL" id="email" name="email"><br><br>
  <label for="message">message:</label><br>
  <input type="text" id="message" name="message"><br><br>
  <input type="submit" value="Submit">
</form>


<?php if ($edit_id!=""){?>


<h1>UPDATE</h1>


<form method="POST" action="">
  <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
  <label for="name">name:</label><br>
  <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>" autofocus><br>
  <label for="dob">dob:</label><br>
  <input type="date" id="dob" name="dob" value="<?php echo $edit_dob; ?>" autofocus><br>
  <label for="email">email:</label><br>
  <input type="emaiL" id="email" name="email" value="<?php echo $edit_email; ?>"><br><br>
  <label for="message">message:</label><br>
  <input type="text" id="message" name="message" value="<?php echo $edit_message; ?>"><br><br>
  <input type="submit" value="Submit">

  <a href= "<?php echo $_SERVER['PHP_SELF'];?>">
      <button>close</button>
  </a>
</form>


<?php } ?>


<table style="width:100%">
  <tr>
    <th>name</th>
    <th>dob</th>
    <th>email</th>
    <th>message</th>
    <th>edit/dlt</th>
  </tr>


 <?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
  <td><?php echo $row['name']; ?></td>
  <td><?php echo $row['dob']; ?></td>
  <td><?php echo $row['email']; ?></td>
  <td><?php echo $row['message']; ?></td>
  <td>
    <a href="?edit=<?php echo $row['id']; ?>">
      <button type="button">edit</button>
    </a>
    <a href="?delete=<?php echo $row['id']; ?>">
      <button type="button">delete</button>
    </a>

  </td>
</tr>
<?php } ?>
</table>




<br><br>

<a href="logout.php">
    <button type="button">Logout</button>
</a>




</body>
</html>


<!-- 
if (mysqli_query($conn, $sql)) {
  echo "Submitted successfully!";
} -->






<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<h2 style="text-align:center">User Profile Card</h2>

<div class="card">
  <img src="/w3images/team2.jpg" alt="John" style="width:100%">
  <h1>John Doe</h1>
  <p class="title">CEO & Founder, Example</p>
  <p>Harvard University</p>
  <div style="margin: 24px 0;">
    <a href="#"><i class="fa fa-dribbble"></i></a> 
    <a href="#"><i class="fa fa-twitter"></i></a>  
    <a href="#"><i class="fa fa-linkedin"></i></a>  
    <a href="#"><i class="fa fa-facebook"></i></a> 
  </div>
  <p><button>Contact</button></p>
</div>


<a href="logout.php">
    <button type="button">Logout</button>
</a> -->

 

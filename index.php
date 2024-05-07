<?php
require 'config.php';

// Check if the session is not active before starting it
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Fetching user data
$id = $_SESSION['id'];
$query = "SELECT name FROM user WHERE id = $id";
$result = mysqli_query($conn, $query);

//Check if user is logged in
if(!empty($_SESSION['id'])){
    $id=$_SESSION["id"];
    $id = mysqli_real_escape_string($conn, $id);
    $result=mysqli_query($conn,"SELECT * FROM user WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
}

// Check if query was successful
if($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['name'];
} else {
    $username = "Unknown";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    

<h1>Welcome<?php echo $username;?></h1>
<p>This is the homepage.</p>
    <br>
    <a href="update.php">Update Profile</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
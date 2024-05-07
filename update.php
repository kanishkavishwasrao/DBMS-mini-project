<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

$user_id = $_SESSION['id'];

// Fetch current user data
$user_query = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
$user_data = mysqli_fetch_assoc($user_query);

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    
    // Check if new password matches confirmation
    if($password !== $confirmpassword){
        echo "<script> alert ('Passwords do not match.') ;</script>";
    } else {
        // Update user information
        $query = "UPDATE user SET name='$name', email='$email'";
        
   
        if(!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password='$password_hash'";
        }
        
        $query .= " WHERE id=$user_id";
        
        if(mysqli_query($conn, $query)){
            echo "<script> alert ('Update successful.') ;</script>";
            // Update user_data with new values
            $user_data['name'] = $name;
            $user_data['email'] = $email;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
</head>
<body>
    <h2>Update Information</h2>
    <form class="" action="" method="post" autocomplete="off">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" required value="<?php echo $user_data['name']; ?>"><br>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required value="<?php echo $user_data['email']; ?>"><br>
        <label for="password">New Password: </label>
        <input type="password" name="password" id="password" value=""><br>
        <label for="confirmpassword">Confirm New Password: </label>
        <input type="password" name="confirmpassword" id="confirmpassword" value=""><br>
        
        <button type="submit" name="submit">Update</button>
    </form>
    <br>
    <a href="index.php">Back to Home</a>
    <br>
    <a href="delete.php">Delete Account</a>
</body>
</html>

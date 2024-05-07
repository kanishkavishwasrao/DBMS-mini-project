<?php
require 'config.php';

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username and password match in the database
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        // Delete the user record
        $delete_query = "DELETE FROM user WHERE username='$username'";
        if(mysqli_query($conn, $delete_query)){
            echo "<script>alert('User deleted successfully.');</script>";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Incorrect username or password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h2>Delete Account</h2>
    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit" name="submit">Delete Account</button>
    </form>
</body>
</html>

<?php
session_start();

// Check if user is logged in
include("connect.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password))
    {
        // save user name and password and admin status to database
        // Automatically sets admin status to "No"
        $admin = 0;

        // Build the SQL statement from the sanitized variables
        $query = "INSERT INTO users (user_name, password, admin) 
        VALUES (:user_name, :password, :admin)";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);        
        $statement->bindValue(':password', $password);
        $statement->bindValue(':admin', $admin);
        //$statement->bindValue(':id', $id, PDO::PARAM_INT);

        if($statement->execute())
        {
            header("Location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <div>
        <form method="post">
            <input type="text" name="user_name"><br><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Signup"><br><br>
            <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>
    
</body>
</html>
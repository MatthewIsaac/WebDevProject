<?php
session_start();

// Check if user is logged in
include("connect.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Something was posted
    $user_name = $_POST['user_name'];
    $email = $_POST['email_add'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($email) && !empty($password))
    {
        // save user name and password and admin status to database
        // Automatically sets admin status to "No"
        $admin_status = 0;  
        

        // salt and hash password
        //$password = password_hash($password, PASSWORD_DEFAULT);

        // Build the SQL statement from the sanitized variables
        $query = "INSERT INTO users (user_name, email_add, password, admin_status) 
        VALUES (:user_name, :email_add, :password, :admin_status)";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);       
        $statement->bindValue(':email_add', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':admin_status', $admin_status);

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
            <label for="content">User Name</label>
            <input type="text" name="user_name"><br><br>
            <label for="content">Email</label>
            <input type="text" name="email_add"><br><br>
            <label for="content">password</label>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Signup"><br><br>
            <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>
    
</body>
</html>
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
        // Build the SQL statement from the variables
        $query = "SELECT * FROM users WHERE user_name = :user_name";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);

        $statement->execute();
        $row = $statement->fetch();


        if(/* user name matches a user name in the database */
            $user_name === $row['user_name'])
        {
            if(/* user name password matches $password */
                $password === $row['password'])
                {
                    $_SESSION["user_name"] = $user_name;
                    //echo "test";
                    //header("Location: post.php");
                    header("Location: index.php");
                }
                else
                {
                    echo "Please enter the correct password";
                }
        }
        else
        {
            echo "Please enter a correct username.";
        }
    }
    else
    {
        echo "Please enter a correct user name and password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <form method="post">
            <input type="text" name="user_name"><br><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Login"><br><br>
            <a href="signup.php">Click to Signup</a><br><br>
        </form>
    </div>
    
</body>
</html>
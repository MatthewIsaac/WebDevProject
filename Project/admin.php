<?php

session_start();
include("connect.php");
include("authenticate.php");

if (isset($_POST['editButton']) && isset($_POST['id']))
{
    // Update user query
    // Filter/Sanitize user input
    $user_name  = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email_add', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Build the SQL statement from the sanitized variables
    $query = "UPDATE users SET user_name = :user_name, email_add = :email, password = :password WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);        
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    // Execute the INSERT.
    $statement->execute();
}
else if (isset($_POST['deleteButton']) && isset($_POST['id']))
{
    // Delete row from query
    // Filter/Sanitize user input
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the SQL statement from sanitized id
    $query = "DELETE FROM users WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the DELETE
    $statement->execute();
}

// Build and prepare SQL String with :id placeholder parameter.
$userQuery = "SELECT * FROM `users` WHERE admin_status = 0 ORDER BY date DESC, id DESC LIMIT 10";
$userStatement = $db->prepare($userQuery);

// Bind the :id parameter in the query to the sanitized
// $id specifying a binding-type of Integer.
//$userStatement->bindValue('id', $id, PDO::PARAM_INT);
$userStatement->execute();

$adminQuery = "SELECT * FROM `users` WHERE admin_status = 1 ORDER BY date DESC, id DESC LIMIT 10";

$adminStatement = $db->prepare($adminQuery);

// Bind the :id parameter in the query to the sanitized
// $id specifying a binding-type of Integer.
//$userStatement->bindValue('id', $id, PDO::PARAM_INT);
$adminStatement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Home Page</a>
    <fieldset>
        <legend>
            Users
        </legend>
        <table>
        <tr>
            <th>
                
            </th>
            <th>
                User name
            </th>
            <th>
                Email
            </th>
            <th>
                Password
            </th>
            <th>
                Account Last Updated
            </th>
        </tr>
        <form method="post">
        <?php while($row = $userStatement->fetch()): ?>
            <?php if(empty($row)): ?>
                <tr>
                    <td>
                        No data
                    </td>
                    <td>
                        No data
                    </td>
                    <td>
                        No data
                    </td>
                    <td>
                        No data
                    </td>
                </tr>
            <?php else: ?>
                
                <tr>
                    <td>
                        <input name="id" value="<?= $row['id'] ?>">
                    </td>
                    <td>
                        <input id="user_name" name="user_name" value="<?= $row['user_name'] ?>">
                    </td>
                    <td>
                        <input id="email_add" name="email_add" value="<?= $row['email_add'] ?>">
                    </td>
                    <td>
                        <input id="password" name="password" value="<?= $row['password'] ?>">
                    </td>
                    <td>
                        <?= $row['date'] ?>
                    </td>
                    <td>
                        <input type="submit" name="editButton" value="Edit <?= $row['user_name'] ?>" onclick="return confirm('Edit user?')"/>  
                    </td>
                    <td>
                        <input type="submit" name="deleteButton" value="Delete <?= $row['user_name'] ?>" onclick="return confirm('Delete user?')"/>  
                    </td>
                </tr>
            <?php endif ?>
        <?php endwhile ?>
        </form>
        </table>
    </fieldset>  
    <fieldset>
        <legend>
            Admins
        </legend>
        <table>
        <tr>
            <th>
                User name
            </th>
            <th>
                Email
            </th>
            <th>
                Account Last Updated
            </th>
        </tr>
        <?php while($row = $adminStatement->fetch()): ?>
            <tr>
                <td>
                    <?= $row['user_name'] ?>
                </td>
                <td>
                    <?= $row['email_add'] ?>
                </td>
                <td>
                    <?= $row['date'] ?>
                </td>
            </tr>
        <?php endwhile ?>
        </table>
    </fieldset>    
</body>
</html>
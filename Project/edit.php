<?php

/*******w******** 
    
    Name: Matt Isaac
    Date: Oct 2, 2023  
    Description: Completed Challenge 3

****************/

require('connect.php');
require('authenticate.php');


if (isset($_POST['editButton']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])) 
{
    // Filter/Sanitize user input
    $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Build the SQL statement from the sanitized variables
    $query = "UPDATE forum SET title = :title, content = :content WHERE forum_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);        
    $statement->bindValue(':content', $content);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    // Execute the INSERT.
    $statement->execute();
    
    // Redirect after update.
    header("Location: forum.php");
    exit;
} 

else if (isset($_POST['deleteButton']) && isset($_POST['id'])) 
{
    // Filter/Sanitize user input
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the SQL statement from sanitized id
    $query = "DELETE FROM forum WHERE forum_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the DELETE
    $statement->execute();

    // Redirect after update.
    header("Location: forum.php");
    exit;
}

else if (isset($_GET['id'])) 
{
    // Sanitize the id. Like above but this time from INPUT_GET.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Build the parametrized SQL query using the filtered id.
    $query = "SELECT * FROM forum WHERE forum_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    // Execute the SELECT and fetch the single row returned.
    $statement->execute();
    $row = $statement->fetch();
} 

else 
{
    $id = false; // False if we are not UPDATING or SELECTING.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="forum.php">New Post for FCC Forum</a></h1>
        </div> 
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php" class="active">New Post</a></li>
        </ul> 
        <div id="all_blogs">
            <form method="post">
                <!-- Hidden input for the forum primary key. -->
                <input type="hidden" name="id" value="<?= $row['forum_id'] ?>"> <!-- put "type="hidden"" back -->
                
                <!-- forum_id title and content are echoed into the input value attributes. -->
                <label for="title">Title</label>
                <input id="title" name="title" value="<?= $row['title'] ?>"> <!-- <?= $row['title'] ?> -->
                <label for="content">Content</label>
                <input id="content" name="content" value="<?= $row['content'] ?>">
                
                <input type="submit" name="editButton" value="Update" />
                <input type="submit" name="deleteButton" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
            </form>
        </div>   
    </div> 
</body>
</html>
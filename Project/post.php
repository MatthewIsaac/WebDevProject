<?php

/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/

require('connect.php');
require('authenticate.php');

if ($_POST && !empty($_POST['title']) && !empty($_POST['content'])) 
{
    //  Sanitize user input 
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //  Build the parameterized SQL query and bind to the above sanitized values.
    $query = "INSERT INTO Forum(title, content) VALUES (:title, :content)";
    $statement = $db->prepare($query);

    //  Bind values to the parameters
    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);
    
    //  Execute the INSERT.
    //  execute() will check for possible SQL injection and remove if necessary
    if($statement->execute())
    {
        header("Location: index.php"); /* CHANGE BACK TO INDEX */
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>FCC Forum Post!</title>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">New Post for FCC Forum</a></h1>  <!-- CHANGE BACK TO INDEX-->
        </div> 
        <ul id="menu">
            <li><a href="index.php">Home</a></li>  <!-- CHANGE BACK TO INDEX-->
            <li><a href="post.php" class="active">New Post</a></li>
        </ul> 
        <div id="all_blogs">
            <form method="post" action="post.php">
                <fieldset>
                    <legend>New Forum Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title" />
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit"/>
                    </p>
                </fieldset>
            </form>
        </div>
    </div> 
</body>
</html>
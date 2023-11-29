<?php

/*******w******** 
    
    Name: Matt Isaac
    Date: Oct 2, 2023  
    Description: Completed Challenge 3

****************/

require('connect.php');

// Build and prepare SQL String with :id placeholder parameter.
$query = "SELECT * FROM Forum WHERE forum_id = :id LIMIT 1";
$statement = $db->prepare($query);

// Sanitize $_GET['id'] to ensure it's a number.
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Bind the :id parameter in the query to the sanitized
// $id specifying a binding-type of Integer.
$statement->bindValue('id', $id, PDO::PARAM_INT);
$statement->execute();

// Fetch the row selected by primary key id.
$row = $statement->fetch();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Fairlane Children's Centre</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">FCC Forum Page</a></h1>
        </div> 
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php" class="active">New Post</a></li>
        </ul> 
        <div id="all_blogs">
            <form method="post" action="post.php">
                <fieldset>
                    <legend>Viewing a Forum Post</legend>
                    <h2><?= $row['title'] ?></h2>
                    <p><?= $row['timestamp'] ?> - <a href="edit.php?id=<?= $row['forum_id'] ?>">edit</a></p>
                    <p><?= $row['content'] ?></p>
                </fieldset>
            </form>
        </div>
    </div>  
</body>
</html> 
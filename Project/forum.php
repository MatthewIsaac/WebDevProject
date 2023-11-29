<?php

/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/

require('connect.php');

// Used to display the proper blog posts
$query = "SELECT * FROM `forum` ORDER BY timestamp DESC, forum_id DESC LIMIT 10";

$statement = $db->prepare($query);

$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>FCC Forum</title>
</head>
<body>
    <nav>
        <div>
            <h2 id="title">FCC Forum</h2>
        </div>
        <aside>
            <a href="post.php"><h2>New Forum Post</h2></a>
            <a href="index.php"><h2>Home</h2></a>
        </aside>
    </nav>
    <div id="container">
        <?php while($row = $statement->fetch()): ?> <!-- loops through 5 instances of blog posts -->
            <div id="blog">
                <div id="blog_title">
                    <h1 class="padding"><a href="display.php?id=<?= $row['forum_id'] ?>"><?= $row['title'] ?></a></h1>
                    <h4 id="edit" class="padding"><a href="edit.php?id=<?= $row['forum_id'] ?>">edit</a></h4>
                </div>
                <h5 class="padding"><?= $row['timestamp'] ?></h5>
                <?php if(strlen($row['content']) <= 200): ?>
                    <p><?= $row['content'] ?></p>
                <?php else: ?>
                    <p><?= substr($row['content'], 0, 200) ?>...<a href="blog.php?id=<?= $row['forum_id'] ?>">View Full Blog</a></p>
                <?php endif ?>
            </div>
        <?php endwhile ?>
    </div>
    
    
</body>
</html>
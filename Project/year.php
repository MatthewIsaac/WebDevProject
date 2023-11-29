<?php

/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/

require('connect.php');

// Used to display the proper years
$query = "SELECT * FROM `fundraiser` ORDER BY date_year DESC";

$statement = $db->prepare($query);

$statement->execute();

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>

    </header>
        <div id="container">
            <?php while($row = $statement->fetch()): ?>
                <h1 class="padding"><a href="fundraisers.php?id=<?= $row['fundraiser_id'] ?>"><?= $row['date_year'] ?></a></h1>
            <?php endwhile ?>
        </div>
    <footer>
        
    </footer>
</body>

</html>
<?php

/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/

require('connect.php');


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM `fundraiser` WHERE fundraiser_id = :id LIMIT 5";
//$query = "SELECT * FROM `fundraiser` WHERE date_year = 2023";

$statement = $db->prepare($query);

$statement->bindValue(':id', $id, PDO::PARAM_INT);

$statement->execute();

$row = $statement->fetch();


$_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$_query = "SELECT * FROM `fundraiser` WHERE fundraiser_id = :id LIMIT 5";
//$query = "SELECT * FROM `fundraiser` WHERE date_year = 2023";

$_statement = $db->prepare($_query);

$_statement->bindValue(':id', $_id, PDO::PARAM_INT);

$_statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title><?= $row['date_year'] ?></title>
</head>
<body>
    <nav>
        <div>
            <h2 id="title">Fundraisers in <?= $row['date_year'] ?></h2>
        </div>
        <aside>
            <a href="index.php"><h2>Home</h2></a>
        </aside>
    </nav>
    <div id="container">
        <div id="blog">
            <div id="blog_title">
            <?php while($_row = $_statement->fetch()): ?>
                <h1><a href="year.php?id=<?= $row['fundraiser_id'] ?>"><?= $row['fundraised_item'] ?></a></h1>
            <?php endwhile ?>
        </div>
    </div>
</body>
</html>
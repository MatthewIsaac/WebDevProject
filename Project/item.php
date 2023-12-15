<?php

//<?php while($_row = $_statement->fetch()): 
/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/
session_start();
require('connect.php');

//if(($_SESSION['admin_status'] === true) && (isset($_POST['hidePostButton'])))
if(isset($_POST['hidePostButton']))
{
    //$display_status = filter_input(INPUT_POST, 'display_status', FILTER_SANITIZE_NUMBER_INT);
    $display_status = 0;
    $id = filter_input(INPUT_POST, 'fundraiser_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "UPDATE fundraiser SET display_status = :display_status WHERE fundraiser_id = :fundraiser_id";

    $statement->bindValue(':display_status', $display_status);
    $statement->bindValue(':fundraiser_id', $id, PDO::PARAM_INT);

    $statement = $db->prepare($query);

    $statement->execute();

    // Redirect after update.
    header("Location: index.php");
}

else if($_SESSION['admin_status'] === true)
{
    $query = "SELECT * FROM `fundraiser` WHERE date_year = ORDER BY date_year DESC";

    $statement = $db->prepare($query);

    $statement->execute();
    echo "admin_status true";
}
else if($_SESSION['admin_status'] === false)
{
    $query = "SELECT * FROM `fundraiser` WHERE display_status = 1 ORDER BY date_year DESC";

    $statement = $db->prepare($query);
    
    $statement->execute();

    echo "admin_status false";
}


else /*if(!isset($_POST['hidePostButton']))*/
{
    $id = filter_input(INPUT_GET, 'fundraiser_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM `fundraiser` WHERE fundraiser_id = :fundraiser_id LIMIT 1";
    //$query = "SELECT * FROM `fundraiser` WHERE date_year = 2023";

    $statement = $db->prepare($query);

    $statement->bindValue(':fundraiser_id', $id, PDO::PARAM_INT);

    $statement->execute();

    $row = $statement->fetch();


    $_id = filter_input(INPUT_GET, 'fundraiser_id', FILTER_SANITIZE_NUMBER_INT);

    $_query = "SELECT * FROM `fundraiser` WHERE fundraiser_id = :ifundraiser_id LIMIT 1";
    //$query = "SELECT * FROM `fundraiser` WHERE date_year = 2023";

    $_statement = $db->prepare($_query);

    $_statement->bindValue(':ifundraiser_id', $_id, PDO::PARAM_INT);

    $_statement->execute();

    echo "else";
}


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
            <a href="year.php"><h2>Back to Year Selection</h2></a>
        </aside>
    </nav>
    <div id="container">
        <div id="blog">
            <div id="blog_title">
            
            <?php while($row = $statement->fetch()): ?>
                <input name="fundraiser_id" value="<?= $row['fundraiser_id'] ?>"> <!-- type="hidden" -->
                <h1><?= $row['fundraised_item'] ?></h1>
                <h2><?= $row['item_company'] ?></h2>
                <p><?= $row['notes'] ?></p>
                <?php if($_SESSION['admin_status'] === true): ?>
                    <input type="submit" name="hidePostButton" value="Hide" onclick="return confirm('Are you sure you wish to hide this post?')"/>  
                <?php endif ?>
            <?php endwhile ?>
        </div>
    </div>
</body>
</html>
<?php

/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/
session_start();
require('connect.php');


//if (isset($_POST['insertButton']) && isset($_POST['fundraiser_item']) && isset($_POST['fundraiser_company']) && isset($_POST['fundraiser_year'])) && isset($_POST['fundraiser_notes'])

if (isset($_POST['insertButton'])
    && isset($_POST['fundraiser_item']) 
    && isset($_POST['fundraiser_company']) 
    && isset($_POST['fundraiser_year']) 
    && isset($_POST['fundraiser_notes'])
    && isset($_POST['fundraiser_user_name']))

{
    //  Sanitize user input 
    $fundraiser_item = filter_input(INPUT_POST, 'fundraiser_item', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fundraiser_company = filter_input(INPUT_POST, 'fundraiser_company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fundraiser_year = filter_input(INPUT_POST, 'fundraiser_year', FILTER_SANITIZE_NUMBER_INT);
    $fundraiser_notes = filter_input(INPUT_POST, 'fundraiser_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fundraiser_user_name = filter_input(INPUT_POST, 'fundraiser_user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Build the SQL statement from the sanitized variables
$insertQuery = "INSERT INTO fundraiser(fundraised_item, 
                                 item_company,
                                 date_year,
                                 notes,
                                 display_status,
                                 user_name)
                         VALUES (:fundraiser_item, 
                                 :fundraiser_company,
                                 :fundraiser_year,
                                 :fundraiser_notes,
                                 1,
                                 :fundraiser_user_name)";
$statement = $db->prepare($insertQuery);
$statement->bindValue(':fundraiser_item', $fundraiser_item);        
$statement->bindValue(':fundraiser_company', $fundraiser_company);
$statement->bindValue(':fundraiser_year', $fundraiser_year);
$statement->bindValue(':fundraiser_notes', $fundraiser_notes);        
$statement->bindValue(':fundraiser_user_name', $fundraiser_user_name);

// Execute the INSERT.
$statement->execute();

// Redirect after update.
header("Location: year.php");
} 
else
{
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM dollars JOIN fundraiser ON dollars.dollars_id = fundraiser.dollars_id 
              WHERE fundraiser_id = :id LIMIT 5";
    
    $fundraiserStatement = $db->prepare($query);
    
    $fundraiserStatement->bindValue(':id', $id, PDO::PARAM_INT);
    
    $fundraiserStatement->execute();
    
    $row = $fundraiserStatement->fetch();
    
    
    
    $query2 = "SELECT * FROM dollars JOIN fundraiser ON dollars.dollars_id = fundraiser.dollars_id 
               WHERE fundraiser_id = :id LIMIT 5";
    
    $fundraiserStatement2 = $db->prepare($query2);
    
    $fundraiserStatement2->bindValue(':id', $id, PDO::PARAM_INT);
    
    $fundraiserStatement2->execute();
}




//$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

/*$query = "SELECT * FROM `fundraiser` WHERE fundraiser_id = :id LIMIT 5";
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
            <?php while($_row = $_statement->fetch()): ?>
                <h1><a href="item.php?id=<?= $row['fundraiser_id'] ?>"><?= $row['fundraised_item'] ?></a></h1>




            <?php endwhile ?>
        </div>
        <?php if($_SESSION['admin_status'] === true): ?>
            <label for="fundraiser_item">Add a fundraiser</label>
            <input id="fundraiser_item" name="fundraiser_item" value="Add fundraiser item here">
            <label for="fundraiser_company">Fundraiser Company</label>
            <input id="fundraiser_company" name="fundraiser_company" value="Add fundraiser company here">
            <label for="fundraiser_year">Add the year it was fundraised</label>
            <input id="fundraiser_year" name="fundraiser_year" value="<?= $row['date_year'] ?>">
            <label for="fundraiser_notes">Add the fundraisers notes</label>
            <input id="fundraiser_notes" name="fundraiser_notes" value="Add fundraiser notes here">
            <label for="fundraiser_dollars">Add amount fundraised</label>
            <input id="fundraiser_dollars" name="fundraiser_dollars" value="0.00">
            <input type="submit" name="insertButton" value="Insert" />
        <?php endif ?>
    </div>



    <label for="fundraiser_dollars">Add amount fundraised</label>
            <input id="fundraiser_dollars" name="fundraiser_dollars" value="0.00">
            <input type="submit" name="insertButton" value="Insert" />


*/
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
    <fieldset>
        <legend>
            Fundraisers in <?= $row['date_year'] ?>
        </legend>
        <table>
        <tr>
            <th>
                Item
            </th>
            <th>
                Company
            </th>
            <th>
                Notes
            </th>
            <th>
                Net Profit
            </th>
            <th>
                Gross Raised
            </th>
            <th>
                Costs
            </th>
        </tr>
        <?php while($row2 = $fundraiserStatement2->fetch()): ?>
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
                        <?= $row['fundraised_item'] ?>
                    </td>
                    <td>
                        <?= $row['item_company'] ?>
                    </td>
                    <td>
                        <?= $row['notes'] ?>
                    </td>
                    <td>
                        <?= $row['net_profit'] ?>
                    </td>
                    <td>
                        <?= $row['gross_raised'] ?>
                    </td>
                    <td>
                        <?= $row['costs'] ?>
                    </td>
                </tr>
            <?php endif ?>
        <?php endwhile ?>
        
        </table>    
    </fieldset>   
    <form method="post">
    <label for="fundraiser_item">Add a fundraiser</label>
            <input id="fundraiser_item" name="fundraiser_item" value="Add fundraiser item here">
            <label for="fundraiser_company">Fundraiser Company</label>
            <input id="fundraiser_company" name="fundraiser_company" value="Add fundraiser company here">
            <label for="fundraiser_year">Add the year it was fundraised</label>
            <input id="fundraiser_year" name="fundraiser_year" value="<?= $row['date_year'] ?>">
            <label for="fundraiser_notes">Add the fundraisers notes</label>
            <input id="fundraiser_notes" name="fundraiser_notes" value="Add fundraiser notes here">
            <label for="fundraiser_user_name">User name</label>
            <input id="fundraiser_user_name" name="fundraiser_user_name" value="Add your name here">
            <input type="submit" name="insertButton" value="Insert" />
    </form>
    <?php if($_SESSION['admin_status'] === true): ?>
            <label for="fundraiser_item">Add a fundraiser</label>
            <input id="fundraiser_item" name="fundraiser_item" value="Add fundraiser item here">
            <label for="fundraiser_company">Fundraiser Company</label>
            <input id="fundraiser_company" name="fundraiser_company" value="Add fundraiser company here">
            <label for="fundraiser_year">Add the year it was fundraised</label>
            <input id="fundraiser_year" name="fundraiser_year" value="<?= $row['date_year'] ?>">
            <label for="fundraiser_notes">Add the fundraisers notes</label>
            <input id="fundraiser_notes" name="fundraiser_notes" value="Add fundraiser notes here">
            <label for="fundraiser_user_name">User name</label>
            <input id="fundraiser_user_name" name="fundraiser_user_name" value="Add your name here">
            <input type="submit" name="insertButton" value="Insert" />
        <?php endif ?>
</body>
</html>
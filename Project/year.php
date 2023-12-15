<?php

/*******w******** 
    
    Project
    Name: Matt Isaac
    Date: November 2023
    Description: Final Project for WEBDEV2

****************/
session_start();
require('connect.php');

if($_SESSION['admin_status'] && isset($_POST['editButton']))
{
    echo "Edit pressed";
    $display_status = filter_input(INPUT_POST, 'display_status', FILTER_SANITIZE_NUMBER_INT);
    $id = filter_input(INPUT_POST, 'fundraiser_id', FILTER_SANITIZE_NUMBER_INT); // id of row button pressed
    var_dump($id);

    $displayQuery = "UPDATE fundraiser SET display_status = :display_status WHERE fundraiser_id = :id";

    $_statement = $db->prepare($displayQuery); 

    $_statement->bindValue(':display_status', $display_status);
    $_statement->bindValue(':id', $id, PDO::PARAM_INT);

    $_statement->execute();
}
else if((isset($_POST['insertPostButton'])) && (isset($_POST['fundraised_item']) && isset($_POST['item_company']) && isset($_POST['date_year']) && isset($_POST['notes']) && isset($_POST['notes'])))
{
    echo "Insert pressed";
    //Insert Fundraiser table
    $fundraised_item  = filter_input(INPUT_POST, 'fundraised_item', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $item_company = filter_input(INPUT_POST, 'item_company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date_year  = filter_input(INPUT_POST, 'date_year', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'fundraiser_id', FILTER_SANITIZE_NUMBER_INT);
    $display_status = 1;

    //$updateFundraiser = "UPDATE fundraiser SET fundraised_item = :fundraised_item, item_company = :item_company, date_year = :date_year, notes = :notes, user_name = :user_name WHERE fundraiser_id = :id";
    $insertFundraiser = "INSERT INTO fundraiser(fundraised_item, item_company, date_year, notes, user_name, display_status) VALUES (:fundraised_item, :item_company, :date_year, :notes, :user_name, :display_status)";

    $insertFundraiserStatement = $db->prepare($insertFundraiser);

    $insertFundraiserStatement->bindValue(':fundraised_item', $fundraised_item);
    $insertFundraiserStatement->bindValue(':item_company', $item_company);
    $insertFundraiserStatement->bindValue(':date_year', $date_year);
    $insertFundraiserStatement->bindValue(':notes', $notes);
    $insertFundraiserStatement->bindValue(':user_name', $user_name);
    $insertFundraiserStatement->bindValue(':display_status', $display_status);
    //$insertFundraiserStatement->bindValue(':id', $id, PDO::PARAM_INT);

    $insertFundraiserStatement->execute();

    //Insert Dollars table
    //$gross_raised  = filter_input(INPUT_POST, 'gross_raised', FILTER_SANITIZE_NUMBER_FLOAT);
    //$costs = filter_input(INPUT_POST, 'costs', FILTER_SANITIZE_NUMBER_FLOAT);
    //$net_profit = filter_input(INPUT_POST, 'net_profit', FILTER_SANITIZE_NUMBER_FLOAT);
    //$dollars_id = filter_input(INPUT_POST, 'dollars_id', FILTER_SANITIZE_NUMBER_INT);
    //$display_status = 1;

    //$updateDollarsStatement = "UPDATE dollars SET gross_raised = :gross_raised, costs = :costs, net_profit = :net_profit WHERE dollars_id = :dollars_id";
    //$insertDollars = "INSERT INTO dollars(gross_raised, costs, net_profit) VALUES (:gross_raised, :costs, :net_profit)";

    //$insertDollarsStatement = $db->prepare($insertDollars);

    //$insertDollarsStatement->bindValue(':gross_raised', $gross_raised);
    //$insertDollarsStatement->bindValue(':costs', $costs);
    //$insertDollarsStatement->bindValue(':net_profit', $net_profit);
    //$insertDollarsStatement->bindValue(':dollars_id', $dollars_id, PDO::PARAM_INT);

    //$insertDollarsStatement->execute();
}

if($_SESSION['admin_status'] /*&& empty($_POST['insertPostButton']) && empty($_POST['hidePostButton'])*/)
{
    echo "Admin";
    
    $admin_query = "SELECT * FROM fundraiser ORDER BY date_year DESC";

    $statement = $db->prepare($admin_query);

    $statement->execute();

    $_statement = $db->prepare($admin_query);

    $_statement->execute();
}
else
{
    echo "Not admin";
    //$query = "SELECT date_year FROM `fundraiser` WHERE display_status = 1 ORDER BY date_year DESC";
    $query = "SELECT * FROM fundraiser WHERE display_status = 1 ORDER BY date_year DESC";

    $statement = $db->prepare($query);
    
    $statement->execute();

    $_statement = $db->prepare($query);

    $_statement->execute();
}


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
                Item    
            </th>
            <th>
                Company
            </th>
            <th>
                Year
            </th>
            <th>
                Notes
            </th>
            <th>
                Poster
            </th>
        </tr>
        <form method="post">
        <?php while($row = $_statement->fetch()): ?>
            <tr>
                <td>
                <input type="hidden" name="id" value="<?= $row['fundraiser_id'] ?>">
                </td>
                <td>
                    <?= $row['fundraised_item'] ?>
                </td>
                <td>
                    <?= $row['item_company'] ?>
                </td>
                <td>
                    <?= $row['date_year'] ?>
                </td>
                <td>
                    <?= $row['notes'] ?>
                </td>
                <td>
                   <?= $row['user_name'] ?>
                </td>
            </tr>
        <?php endwhile ?>
        </form>
        </table>
    </fieldset>  
    <?php if ($_SESSION['admin_status'] === true): ?>
        <fieldset>
            <legend>
                Admins
            </legend>
            <table>
            <tr>
                <th>
                    
                </th>
                <th>
                    Item    
                </th>
                <th>
                    Company
                </th>
                <th>
                    Year
                </th>
                <th>
                    Notes
                </th>
                <th>
                    Poster
                </th>
                <th>
                    Display Status
                </th>
            </tr>
            <form method="post">
            <?php while($row = $statement->fetch()): ?>
                <?php if($_SESSION['admin_status'] === true): ?>
                    <tr>
                        <td>
                            <?= $row['fundraiser_id'] ?>
                        </td>
                        <td>
                            <input id="fundraised_item" name="fundraised_item" value="<?= $row['fundraised_item'] ?>">
                        </td>
                        <td>
                            <input id="item_company" name="item_company" value="<?= $row['item_company'] ?>">
                        </td>
                        <td>
                            <input id="date_year" name="date_year" value="<?= $row['date_year'] ?>">
                        </td>
                        <td>
                            <input id="notes" name="notes" value="<?= $row['notes'] ?>">
                        </td>
                        <td>
                            <input id="user_name" name="user_name" value="<?= $row['user_name'] ?>">
                        </td>
                        <td>
                            <input id="display_status" name="display_status" value="<?= $row['display_status'] ?>">
                        </td>
                        <td>
                            <input type="submit" name="editButton" value="Edit <?= $row['fundraiser_id'] ?>" onclick="return confirm('Edit post?')"/>  
                        </td>
                        <td>
                            <input type="submit" name="hidePostButton" value="Delete <?= $row['fundraiser_id'] ?>" onclick="return confirm('Hide post?')"/>  
                        </td>
                    </tr>
                <?php endif ?>
            <?php endwhile ?>
            </form>
            </table>
        </fieldset>
    <?php endif ?>            
    <fieldset>
        <legend>
            Add New Record
        </legend>
        <table>
        <tr>
            <th>
                
            </th>
            <th>
                Item    
            </th>
            <th>
                Company
            </th>
            <th>
                Year
            </th>
            <th>
                Notes
            </th>
            <th>
                Poster
            </th>
        </tr>
        <form method="post">
            <tr>
                <td>

                </td>
                <td>
                    <input id="fundraised_item" name="fundraised_item" placeholder="Fundraised Item">
                </td>
                <td>
                    <input id="item_company" name="item_company" placeholder="Company">
                </td>
                <td>
                    <input id="date_year" name="date_year" placeholder="Year">
                </td>
                <td>
                    <input id="notes" name="notes" placeholder="Notes">
                </td>
                <td>
                    <input id="user_name" name="user_name" placeholder="Your name">
                </td>
            </tr>
            <input type="submit" name="insertPostButton" value="Add new record"/>
        </form>
        </table>
    </fieldset>  
</body>
</html>
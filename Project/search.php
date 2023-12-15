<?php 

session_start();
require('connect.php');

if($_POST && isset($_POST['search']))
{
    $search = $_POST['search'];
    var_dump($search);
}
/*$query = "SELECT * FROM fundraiser WHERE fundraiser_id = $_SESSION['search']";*/
//$query = "SELECT * FROM `fundraiser` JOIN `dollars` ON fundraiser.dollars_id=dollars.dollars_id WHERE dollars_id = 2";
//$query = "SELECT * FROM dollars JOIN fundraiser ON dollars.dollars_id = fundraiser.dollars_id WHERE fundraised_item LIKE '%'$search'%'";
$query = "SELECT * FROM dollars JOIN fundraiser ON dollars.dollars_id = fundraiser.dollars_id";
$statement = $db->prepare($query);
$statement->execute();
//$row = $statement->fetch();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <input id="search" type="text" />
	<button name="search">Search</button>
    <table>
        <tr>
            <th>
                Fundraised Item
            </th>
            <th>
                Company
            </th>
            <th>
                Year
            </th>
            <th>
                Gross Raised
            </th>
            <th>
                Costs
            </th>
            <th>
                Net Profit
            </th>
        </tr>
        <?php while($row = $statement->fetch()): ?>
            <?php var_dump($row);?>
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
                        <?= $row['date_year'] ?>
                    </td>
                    <td>
                        <?= $row['gross_raised'] ?>
                    </td>
                    <td>
                        <?= $row['costs'] ?>
                    </td>
                    <td>
                        <?= $row['net_profit'] ?>
                    </td>
                </tr>
            <?php endif ?>
        <?php endwhile ?>
    </table>
</body>
</html>
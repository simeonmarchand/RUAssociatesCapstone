<?php

// error reporting
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
ini_set("html_errors", "1");
ini_set("docref_root", "http://www.php.net/");
ini_set("error_prepend_string", "<div style='color:red; font-family:verdana; border:1px solid red; padding:5px;'>");
ini_set("error_append_string", "</div>");

// Database connection configuration
require 'login.php';

// Create a connection
$connection = new mysqli($hn, $un, $pw, $db);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve data from the Items, Maintenance, and Warranties tables
$queryItem = $_POST['searchQuery'];

$itemResult = '';
$itemResult = $itemResult . 'SELECT * FROM `items` WHERE ';
$itemResult = $itemResult . 'item_id in ';
$itemResult = $itemResult . '(select warranty_id from Warranties where provider like \'%'.$queryItem.'%\' or terms like \'%'.$queryItem.'%\') OR ';
$itemResult = $itemResult . 'item_id in ';
$itemResult = $itemResult . '(select maintenance_id from Maintenance where description like \'%'.$queryItem.'%\' or cost like \'%'.$queryItem.'%\') OR ';
$itemResult = $itemResult . 'name like \'%'.$queryItem.'%\' OR ';
$itemResult = $itemResult . 'description like \'%'.$queryItem.'%\';';


$itemResult = $connection->query($itemResult);
//$maintenanceResult = $connection->query($maintenanceQuery);
//$warrantyResult = $connection->query($warrantyQuery);

// Display the data in a table
echo "<table>
        <tr>
            <th>Item ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Manufacturer</th>
            <th>Maintenance ID</th>
            <th>Date</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Warranty ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Provider</th>
            <th>Terms</th>
            <th>Extended Warranty Start</th>
            <th>Extended Warranty End</th>
            <th>Cost</th>
        </tr>";

// Iterate over the data and display each row
$numOfResults = 0;

while ($row = $itemResult->fetch_assoc()) {
    $numOfResults++;
    echo "<tr>";
    echo "<td>" . $row["item_id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["description"] . "</td>";
    echo "<td>" . $row["category"] . "</td>";
    echo "<td>" . $row["manufacturer"] . "</td>";

    // Find the corresponding maintenance record for the item
    $maintenanceResult = $connection->query('select * from maintenance where maintenance_id = '.$row["item_id"].';');
    $maintenanceRecord = $maintenanceResult->fetch_assoc();

    if ($maintenanceRecord && $maintenanceRecord["maintenance_id"] == $row["item_id"]) {
        echo "<td>" . $maintenanceRecord["maintenance_id"] . "</td>";
        echo "<td>" . $maintenanceRecord["date"] . "</td>";
        echo "<td>" . $maintenanceRecord["description"] . "</td>";
        echo "<td>" . $maintenanceRecord["cost"] . "</td>";
    } else {
        echo "<td colspan='4'>No maintenance record found</td>";
    }

    // Find the corresponding warranty record for the item
    $warrantyResult = $connection->query('select * from warranties where warranty_id = '.$row["item_id"].';');
    $warrantyRecord = $warrantyResult->fetch_assoc();
    if ($warrantyRecord && $warrantyRecord["warranty_id"] == $row["item_id"]) {
        echo "<td>" . $warrantyRecord["warranty_id"] . "</td>";
        echo "<td>" . $warrantyRecord["start_date"] . "</td>";
        echo "<td>" . $warrantyRecord["end_date"] . "</td>";
        echo "<td>" . $warrantyRecord["provider"] . "</td>";
        echo "<td>" . $warrantyRecord["terms"] . "</td>";
        echo "<td>" . $warrantyRecord["extended_warranty_start"] . "</td>";
        echo "<td>" . $warrantyRecord["extended_warranty_end"] . "</td>";
        echo "<td>" . $warrantyRecord["cost"] . "</td>";
    } else {
        echo "<td colspan='8'>No warranty record found</td>";
    }

    echo "</tr>";
}

if($numOfResults == 0) {
    echo "<tr><td colspan='17'>No results found</td></tr>";
}else{
    echo "<tr><td colspan='17'>Number of results: ".$numOfResults."</td></tr>";
}

echo "</table>";

// Close the database connection
$connection->close();
?>

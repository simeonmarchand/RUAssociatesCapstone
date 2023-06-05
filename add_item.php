<?php

// error reporting
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
ini_set("html_errors", "1");
ini_set("docref_root", "http://www.php.net/");
ini_set("error_prepend_string", "<div style='color:red; font-family:verdana; border:1px solid red; padding:5px;'>");
ini_set("error_append_string", "</div>");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $itemName = $_POST["itemName"];
    $itemDescription = $_POST["itemDescription"];
    $itemCategory = $_POST["itemCategory"];
    $itemManufacturer = $_POST["itemManufacturer"];
    $maintenanceDate = $_POST["maintenanceDate"];
    $maintenanceDescription = $_POST["maintenanceDescription"];
    $maintenanceCost = $_POST["maintenanceCost"];
    $warrantyStartDate = $_POST["warrantyStartDate"];
    $warrantyEndDate = $_POST["warrantyEndDate"];
    $warrantyProvider = $_POST["warrantyProvider"];
    $warrantyTerms = $_POST["warrantyTerms"];
    $extendedWarrantyStartDate = $_POST["extendedWarrantyStartDate"];
    $extendedWarrantyEndDate = $_POST["extendedWarrantyEndDate"];
    $warrantyCost = $_POST["warrantyCost"];

    // TODO: Perform data validation and sanitation as needed

    // Database connection configuration
    require "login.php";

    // Create a connection
    $connection = new mysqli($hn, $un, $pw, $db);

    // Check if the connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Insert data into the Items table
    $itemQuery = "INSERT INTO Items (name, description, category, manufacturer)
                  VALUES ('$itemName', '$itemDescription', '$itemCategory', '$itemManufacturer')";

    if ($connection->query($itemQuery) === TRUE) {
        echo "Item record inserted successfully";
    } else {
        echo "Error inserting item record: " . $connection->error;
    }

    // Insert data into the Maintenance table
    $maintenanceQuery = "INSERT INTO Maintenance (date, description, cost)
                          VALUES ('$maintenanceDate', '$maintenanceDescription', '$maintenanceCost')";

    if ($connection->query($maintenanceQuery) === TRUE) {
        echo "Maintenance record inserted successfully";
    } else {
        echo "Error inserting maintenance record: " . $connection->error;
    }

    // Insert data into the Warranties table
    $warrantyQuery = "INSERT INTO Warranties (start_date, end_date, provider, terms, extended_warranty_start, extended_warranty_end, cost)
                      VALUES ('$warrantyStartDate', '$warrantyEndDate', '$warrantyProvider', '$warrantyTerms', '$extendedWarrantyStartDate', '$extendedWarrantyEndDate', '$warrantyCost')";

    if ($connection->query($warrantyQuery) === TRUE) {
        echo "Warranty record inserted successfully";
    } else {
        echo "Error inserting warranty record: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
}
?>

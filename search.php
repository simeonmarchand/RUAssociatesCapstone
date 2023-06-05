<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
</head>
<body>
  <h1>Search Results</h1>

  <?php
  // Establish a connection to the MySQL database
  $host = 'http://localhost/phpmyadmin/';
  $username = 'root';
  $password = ' ';
  $database = 'capstone';

  $connection = mysqli_connect($host, $username, $password, $database);

  // Check if the connection was successful
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Retrieve the search query from the form submission
  $itemName = $_POST['itemName'];

  // Perform the database query
  $query = "SELECT * FROM warranty_data WHERE item_name LIKE '%$itemName%'";
  $result = mysqli_query($connection, $query);

  // Display the search results
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<p><strong>Item Name:</strong> ' . $row['item_name'] . '</p>';
      echo '<p><strong>Purchase Date:</strong> ' . $row['purchase_date'] . '</p>';
      echo '<p><strong>Warranty Years:</strong> ' . $row['warranty_years'] . '</p>';
      echo '<p><strong>Warranty Description:</strong> ' . $row['warranty_description'] . '</p>';
      echo '<p><strong>Last Maintenance Date:</strong> ' . $row['maintenance_date'] . '</p>';
      echo '<hr>';
    }
  } else {
    echo '<p>No results found.</p>';
  }

  // Close the database connection
  mysqli_close($connection);
  ?>
</body>
</html>

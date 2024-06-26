<?php
// get_inventory_data.php

// Establish a database connection (update with your credentials)
$servername = "localhost";
$username = "root";
$password = "Qwdfbn@123";
$dbname = "grocerystore";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the category parameter
$category = $_GET['category'];
$subcategory = $_GET['subcategory'];


$sql = "SELECT * FROM inventory WHERE Category = '$category';";
if($subcategory != 'all')
{
    $sql = "SELECT * FROM inventory WHERE Category = '$category' AND Subcategory = '$subcategory';";
}
$result = $conn->query($sql);
header('Content-Type: application/json'); // Set the content type to JSON


if ($result->num_rows > 0) {
    // Convert the result to a JSON format
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No results found"]); // Send a JSON response for no results
}

$conn->close();
?>

<?php
// Assuming you're using POST for simplicity
$data = json_decode(file_get_contents("php://input"), true);

// Assuming you have a database connection already established
$conn = new mysqli("localhost", "root", "Qwdfbn@123", "grocerystore");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Replace this query with your actual query to fetch data from the cart table
$query = "SELECT carts.*, inventory.ItemName, inventory.UnitPrice
FROM carts
JOIN inventory ON carts.ItemNumber = inventory.ItemNumber where carts.CartStatus!='Completed';";

$result = $conn->query($query);

if (!$result) {
    die(json_encode(['success' => false, 'error' => 'Query failed: ' . $conn->error]));
}

$cart = [];
while ($row = $result->fetch_assoc()) {
    $cart[] = $row;
}

echo json_encode(['success' => true, 'cart' => $cart]);

$conn->close();
?>

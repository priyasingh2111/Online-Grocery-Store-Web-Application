<?php
$itemName = $_GET['itemName'];
$itemQuantity = $_GET['itemQuantity'];
$itemPrice = $_GET['itemPrice'];

$conn = new mysqli("localhost", "root", "Qwdfbn@123", "grocerystore");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

$query = "SELECT * FROM inventory WHERE ItemName = '$itemName'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die(json_encode(['success' => false, 'error' => 'Query failed: ' . mysqli_error($conn)]));
}

$row = mysqli_fetch_assoc($result);
if (!$row) {
    die(json_encode(['success' => false, 'error' => 'Item not found']));
}

$currentQuantity = $row['QuantityInInventory'];
$itemNumber = $row['ItemNumber'];

$newQuantity = $currentQuantity - $itemQuantity;
$sql1 = "UPDATE inventory SET QuantityInInventory = $newQuantity WHERE ItemName = '$itemName'";

if ($conn->query($sql1) !== TRUE) {
    die(json_encode(['success' => false, 'error' => 'Update query failed: ' . $conn->error]));
}

$price = $itemQuantity * $row['UnitPrice'];
$sql2 = "INSERT INTO transactions (TransactionStatus, TransactionDate, TotalPrice)
         VALUES ('InProcess', '2023-09-29', $price)";

if ($conn->query($sql2) !== TRUE) {
    die(json_encode(['success' => false, 'error' => 'Insert query failed: ' . $conn->error]));
}

$transactionID = $conn->insert_id; // Get the last inserted ID

$sql3 = "INSERT INTO carts (CustomerID, TransactionID, ItemNumber, Quantity, CartStatus)
         VALUES (1, $transactionID, $itemNumber, $itemQuantity, 'Pending')";

if ($conn->query($sql3) !== TRUE) {
    die(json_encode(['success' => false, 'error' => 'Insert query failed: ' . $conn->error]));
}

echo json_encode(['success' => true]);

$conn->close();
?>

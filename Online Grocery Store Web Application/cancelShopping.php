<?php

// Connect to the database
$conn = new mysqli("localhost", "root", "Qwdfbn@123", "grocerystore");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Assuming you have a specific UserID (replace 1 with the actual UserID)
$userID = 1;

// Query to get all transaction IDs for a specific user
$queryTransactionIDs = "SELECT TransactionID FROM carts WHERE CustomerID = $userID";
$resultTransactionIDs = mysqli_query($conn, $queryTransactionIDs);

if (!$resultTransactionIDs) {
    die(json_encode(['success' => false, 'error' => 'Query failed: ' . mysqli_error($conn)]));
}

// Iterate over each transaction ID and update the status to 'Completed'
while ($rowTransactionID = mysqli_fetch_assoc($resultTransactionIDs)) {
    $transactionID = $rowTransactionID['TransactionID'];
    // Fetch transaction details
$query1 = "DELETE FROM transactions where TransactionID=$transactionID AND TransactionStatus='InProcess';";
$result1 = mysqli_query($conn, $query1);

$query = "SELECT * FROM carts where TransactionID=$transactionID;";
$result = mysqli_query($conn, $query);

if (!$result) {
    die(json_encode(['success' => false, 'error' => 'Query failed: ' . mysqli_error($conn)]));
}

// Fetch the result
$row1 = mysqli_fetch_assoc($result);
$totalQuantity = $row1['Quantity'];
$itemNumber = $row1['ItemNumber'];

$query2 = "DELETE FROM carts where TransactionID=$transactionID;";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT * FROM inventory where ItemNumber=$itemNumber;";
$result3 = mysqli_query($conn, $query3);


if (!$result3) {
    die(json_encode(['success' => false, 'error' => 'Query failed: ' . mysqli_error($conn)]));
}

// Fetch the result
$row3 = mysqli_fetch_assoc($result3);
$originalQuantity = $row3['QuantityInInventory'];
$newQuantity = $originalQuantity+$totalQuantity;

$query4 = "UPDATE inventory SET QuantityInInventory = $newQuantity WHERE ItemNumber = $itemNumber;";
$result4 = mysqli_query($conn, $query4);

echo json_encode(['success' => true]);

}



// // Close the database connection
$conn->close();
?>

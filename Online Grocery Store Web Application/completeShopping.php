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

    // Update the transaction status to 'Completed'
    $queryUpdateStatus = "UPDATE transactions SET TransactionStatus = 'Completed' WHERE TransactionID = $transactionID";
    
    if ($conn->query($queryUpdateStatus) !== TRUE) {
        die(json_encode(['success' => false, 'error' => 'Update query failed: ' . $conn->error]));
    }

    $queryUpdateCartStatus = "UPDATE carts SET CartStatus = 'Completed' WHERE TransactionID = $transactionID";
    if ($conn->query($queryUpdateCartStatus) !== TRUE) {
        die(json_encode(['success' => false, 'error' => 'Update query failed: ' . $conn->error]));
    }
}

echo json_encode(['success' => true]);


// // Close the database connection
$conn->close();
?>
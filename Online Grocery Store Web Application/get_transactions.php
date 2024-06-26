<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "Qwdfbn@123", "grocerystore");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Fetch transactions based on the selected period
$period = $_GET['period'];

// Set the default period to the current month
if (empty($period)) {
    $period = 'currentMonth';
}

// Get the start and end dates based on the selected period
if ($period === 'currentMonth') {
    $query = "SELECT * FROM transactions where TransactionStatus='InProcess'and TransactionDate BETWEEN '2023-09-01' AND '2023-09-30';";
} elseif ($period === 'last3Months') {
    $query = "SELECT * FROM transactions where TransactionStatus='InProcess'and TransactionDate BETWEEN '2023-07-01' AND '2023-09-30';";
} elseif ($period === 'all') {
    $query = "SELECT * FROM transactions where TransactionStatus='InProcess';";
}

// Fetch transactions based on the date range

$result = mysqli_query($conn, $query);

if (!$result) {
    die(json_encode(['success' => false, 'error' => 'Query failed: ' . mysqli_error($conn)]));
}

$transactions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $transactions[] = $row;
}

// Close the database connection
$conn->close();

// Return the fetched transactions in the response
echo json_encode(['success' => true, 'data' => $transactions]);
?>

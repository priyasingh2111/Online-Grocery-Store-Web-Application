<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "Qwdfbn@123";
$dbname = "grocerystore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitizeInput($input) {
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]); 
    $firstName = sanitizeInput($_POST["firstName"]);
    $lastName = sanitizeInput($_POST["lastName"]);
    $dob = sanitizeInput($_POST["dob"]);
    $phone = sanitizeInput($_POST["phone"]);
    $email = sanitizeInput($_POST["email"]);
    $address = sanitizeInput($_POST["address"]);

    // Insert into Users table
    $userInsertQuery = "INSERT INTO Users (UserName, Password) VALUES ('$username', '$password')";
    $userInsertResult = $conn->query($userInsertQuery);

    if ($userInsertResult) {
        // Get the auto-generated Customer ID
        $customerId = $conn->insert_id;

        // Insert into Customers table
        $customerInsertQuery = "INSERT INTO customers (FirstName, LastName, Age, PhoneNumber, Email, Address) 
                               VALUES ('$firstName', '$lastName', '$dob', '$phone','$email', '$address')";
        $customerInsertResult = $conn->query($customerInsertQuery);

        if ($customerInsertResult) {
            echo '<script type="text/JavaScript">';
            echo 'alert("Registration successful!")';
            echo '</script>';
            header("Location:FreshProducts.html");
        } 
        else 
        {
            echo '<script type="text/JavaScript">';
            echo 'alert("Error inserting into Customers table: ")';
            echo '</script>';
        }
    } 
    else 
    {
        echo '<script type="text/JavaScript">';
        echo 'alert("Error inserting into Users table: ")';
        echo '</script>';
    }
}

// Close the database connection
$conn->close();
?>
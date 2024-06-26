<?php
session_start(); // Start the session for admin authentication

if (!isset($_SESSION["adminAuthenticated"]) || $_SESSION["adminAuthenticated"] !== true) {
    header("Location: admin-login.html"); // Redirect to login if not authenticated
    exit();
}

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form submission
    $itemNumber = $_POST["itemNumber"];
    $newUnitPrice = $_POST["newUnitPrice"];
    $newQuantity = $_POST["newQuantity"];

    // Update the Inventory table based on the entered item number
    $query = "UPDATE Inventory SET UnitPrice = ?, QuantityInInventory = ? WHERE ItemNumber = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("dii", $newUnitPrice, $newQuantity, $itemNumber);

    if ($statement->execute()) {
        echo "<alert>Item updated successfully.</alert>";
    } else {
        echo "<alert>Error updating item.</alert>";
    }

    // Close the statement
    $statement->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="myScript.js"></script>
    <title>Modify Inventory Item</title>
</head>
<body>
<div class="demo-wrap">
        <img class="demo-bg"
             src="img/banner.jpg"
             alt="">
        <div class="demo-content">
            <h1>Welcome to Our Online Grocery Store</h1>
            <p>Explore our wide range of products for all your grocery needs.</p>
        </div>
    </div>
    <header>
        <nav>
            <ul>
                <li><a href="add-inventory-form.php">Add Inventory</a></li>
                <li><a href="view-inventory.php">View Inventory</a></li>
                <li><a href="low-inventory.php">Low Inventory Items</a></li>
                <li><a href="customer-transactions.php">Customer Transactions</a></li>
                <li><a href="customer-by-zip.php">Customers by Zip Code and Month</a></li>
                <li><a href="modify-inventory.php">Modify Inventory Item</a></li>
                <li><a href="older-than-20.php">Customers Older Than 20</a></li>
                <li><a class="active" href="AboutUs.html">About Us</a></li>
                <li><a href="admin-panel.php">Admin Panel</a></li>
                <li><a href="MyAccount.html">My Account</a></li>
                <li><a href="FreshProducts.html">Fresh Food</a></li>
                <li><a href="FrozenProducts.html">Frozen Food</a></li>
                <li><a href="Pantry.html">Pantry</a></li>
                <li><a href="BreakfastAndCereal.html">Breakfast and Cereals</a></li>
                <li><a href="BakingGoods.html">Baking Goods</a></li>
                <li><a href="Snacks.html">Snacks</a></li>
                <li><a href="ContactUs.html">Contact Us</a></li>
                <li><a href="Cart.html">View Cart</a></li>
            </ul>
        </nav>
    </header>
    <div>

    <div class="container">
            <div class="main-content">
                <section class="register-form">

                    <form method="POST" action="">
                        <label for="itemNumber">Item Number:</label>
                        <input type="text" name="itemNumber" required>

                        <label for="newUnitPrice">New Unit Price:</label>
                        <input type="text" name="newUnitPrice" required>

                        <label for="newQuantity">New Quantity:</label>
                        <input type="text" name="newQuantity" required>

                        <button type="submit">Modify Item</button>
                    </form>

                </section>
            </div>
    </div>
    <footer>
            <p class="copyright">&copy; 2023 </p>
            <a class="logout" href="logout.php">Logout</a>
            <br />
            <br />
            <p class="details">First name: Nisha Deborah</p>
            <p class="details">Last name: Philips</p>
            <p class="details">Net Id: NXP220012</p>
    </footer>
</body>
</html>
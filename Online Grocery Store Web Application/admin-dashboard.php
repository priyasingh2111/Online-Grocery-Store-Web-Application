<?php
session_start(); // Start the session for admin authentication

if (!isset($_SESSION["adminAuthenticated"]) || $_SESSION["adminAuthenticated"] !== true) {
    header("Location: admin-login.html"); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="myScript.js"></script>
    <title>Admin Login</title>
</head>
<body>
    <div class="demo-wrap">
        <img class="demo-bg"
             src="img/banner.jpg"
             alt="">
        <div class="demo-content">
            <h1>Admin Login</h1>
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
                <li><a href="Candy.html">Candy</a></li>
                <li><a href="ContactUs.html">Contact Us</a></li>
                <li><a href="Cart.html">View Cart</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>

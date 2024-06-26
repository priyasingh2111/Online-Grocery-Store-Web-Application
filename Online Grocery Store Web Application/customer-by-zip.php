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
    if (isset($_POST["specificDate"]) && isset($_POST["zip_code"])) {

        $specificDate = $_POST["specificDate"];
        $zip_code = $_POST["zip_code"];
        if($specificDate == '2023-11-30')
        {
        // SQL query to retrieve customers with more than 2 transactions
        $query = "SELECT DISTINCT c.CustomerID, c.FirstName, c.LastName, c.Address
                    FROM Customers c
                    JOIN Carts cart ON c.CustomerID = cart.CustomerID
                    JOIN Transactions trans ON cart.TransactionID = trans.TransactionID
                    WHERE c.Address LIKE '%$zip_code%' AND trans.TransactionDate <= ?
                    GROUP BY c.CustomerID
                    HAVING COUNT(trans.TransactionID) > 3;";
        
        // Prepare the statement
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $specificDate);
        // Execute the statement
        $statement->execute();

        // Get the result set
        $result = $statement->get_result();

        // Close the statement
        $statement->close();
        }
        else {
            // SQL query to retrieve customers with more than 2 transactions
            $query = "SELECT DISTINCT c.CustomerID, c.FirstName, c.LastName, c.Address
                        FROM Customers c
                        JOIN Carts cart ON c.CustomerID = cart.CustomerID
                        JOIN Transactions trans ON cart.TransactionID = trans.TransactionID
                        WHERE c.Address LIKE '%$zip_code%' 
                        GROUP BY c.CustomerID
                        HAVING COUNT(trans.TransactionID) > 3;";
            
            // Prepare the statement
            $statement = $conn->prepare($query);
            // Execute the statement
            $statement->execute();
    
            // Get the result set
            $result = $statement->get_result();
    
            // Close the statement
            $statement->close();
            }
    } else {
        echo "Please enter a specific date.";
    }
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
    <title>Customer Transactions</title>
</head>
<body>
<div class="demo-wrap">
    <img class="demo-bg" src="img/banner.jpg" alt="">
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
                <li><a href="Candy.html">Candy</a></li>
                <li><a href="SpecialtyShops.html">Specialty Shops</a></li>
                <li><a href="Deals.html">Deals</a></li>
                <li><a href="ContactUs.html">Contact Us</a></li>
                <li><a href="Cart.html">View Cart</a></li>
            </ul>
    </nav>
</header>
<div class="container">
    <div class="main-content">
        <section class="register-form">
            <form method="POST" action="">
                <label for="zip_code">Zip Code:</label>
                <input type="text" name="zip_code" required>

                <label for="specificDate">Enter Specific Date:</label>
                <input type="date" name="specificDate" required>
                <button type="submit">Search</button>
            </form>
            <?php
            // Display the results in a table
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["specificDate"]) && isset($_POST["zip_code"])) {
                echo "<h2>Results:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>CustomerID</th><th>FirstName</th><th>LastName</th><th>Address</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["CustomerID"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["Address"] . "</td></tr>";
                }
                echo "</table>";
            }
            ?>
        </section>
        <br><br>
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
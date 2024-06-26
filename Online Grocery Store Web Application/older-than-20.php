<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="myScript.js"></script>
    <title>Customer Search Form</title>
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
                <li><a href="admin-login.html">Admin Login</a></li>
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
    <div>

        <div class="container">
            <div class="main-content">
                <section>
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

                    // Fetch customers older than 20 with more than 3 transactions from the database
                    $query = "SELECT
                    c.CustomerID,
                    c.FirstName,
                    c.LastName,
                    TIMESTAMPDIFF(YEAR, STR_TO_DATE(c.Age, '%m/%d/%Y'), CURDATE()) AS Age,
                    c.PhoneNumber,
                    c.Email,
                    c.Address
                FROM
                    Customers c
                JOIN
                    Carts cart ON c.CustomerID = cart.CustomerID
                JOIN
                    Transactions t ON cart.TransactionID = t.TransactionID
                -- WHERE
                --     TIMESTAMPDIFF(YEAR, c.Age, CURDATE()) > 20
                GROUP BY
                    c.CustomerID, c.FirstName, c.LastName
                HAVING
                    COUNT(t.TransactionID) > 3;
                ";
                    $result = mysqli_query($conn, $query);

                    // Display customers in a table
                    echo "<h2>Customers Older Than 20 with More Than 3 Transactions</h2>";
                    echo "<table border='1'>
                        <tr>
                            <th>Customer ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['CustomerID']}</td>
                            <td>{$row['FirstName']}</td>
                            <td>{$row['LastName']}</td>
                            <td>{$row['Age']}</td>
                            <td>{$row['PhoneNumber']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Address']}</td>
                        </tr>";
                    }

                    echo "</table>";

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </section>
            </div>
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
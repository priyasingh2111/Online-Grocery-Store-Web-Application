<!-- add-inventory-form.php -->
<!-- Create similar forms for XML and JSON file uploads -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="myScript.js"></script>
    <title>Register - Online Grocery Store</title>
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
                <li><a href="Candy.html">Candy</a></li>
                <li><a href="ContactUs.html">Contact Us</a></li>
                <li><a href="Cart.html">View Cart</a></li>
            </ul>
        </nav>
    </header>
    <div>

        <div class="container">
            <div class="main-content">
                <section class="register-form">
                    <h2>Register</h2>
                        <form action="add-inventory.php" method="post" enctype="multipart/form-data">
                            <label for="file">Select File:</label>
                            <input type="file" name="file" accept=".xml, .json" required>

                            <div>
                            <br>
                            <label for="category">Select Category:</label>
                            <select name="category" id="category" required>
                                <option value="baking">Baking Good</option>
                                <option value="breakfast">Breakfast & Cereal</option>
                                <option value="candy">Candy</option>
                                <option value="fresh">Fresh Products</option>
                                <option value="frozen">Frozen Products</option>
                                <option value="pantry">Pantry</option>
                                <option value="snacks">Snacks</option>
                                <option value="speciality">Speciality Shops</option>
                                <option value="deals">Deals</option>
                            </select>
                            </div>

                            <br>
                            <input type="submit" value="Upload">
                        </form>
                    </h2>
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

<?php
session_start();

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

// Get user input
$enteredUsername = $_POST["username"];
$enteredPassword = $_POST["password"];

// Query the database
$sql = "SELECT * FROM Users WHERE UserName = '$enteredUsername' AND Password = '$enteredPassword';";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $_SESSION["CustomerID"] = $row["CustomerID"];
      }
    header("Location: FreshProducts.html");
} 
else if ($enteredUsername == 'admin' && $enteredPassword == 'admin123') {
    $_SESSION["adminAuthenticated"] = true;
    header("Location: admin-dashboard.php"); // Redirect to admin dashboard after successful login
    exit();
} 
else {
    // User does not exist
    echo "User not found. Please check your username.";
}

// Close connections
$conn->close();
?>
</div>
</div>
</div>
<footer>
            <p class="copyright">&copy; 2023 </p>
            <a class="logout" href="">Logout</a>
            <br />
            <br />
            <p class="details">First name: Nisha Deborah</p>
            <p class="details">Last name: Philips</p>
            <p class="details">Net Id: NXP220012</p>
    </footer>
</body>
</html>
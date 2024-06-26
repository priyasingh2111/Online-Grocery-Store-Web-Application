<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Check if a file was uploaded
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $tempFilePath = $_FILES["file"]["tmp_name"];

        // Check if the uploaded file is a valid XML file
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        if (strtolower($fileInfo['extension']) == 'xml') {
            // Load XML file
            $xml = simplexml_load_file($tempFilePath);

            // Iterate through each item in the XML
            foreach ($xml->item as $item) {
                $itemNumber = (int)$item->itemNumber;
                $name = (string)$item->name;
                $category = (string)$item->category;
                $subcategory = (string)$item->subcategory;
                $unitPrice = (float)$item->unitPrice;
                $quantity = (int)$item->quantity;

                // Insert data into the Inventory table
                $sql = "INSERT INTO Inventory (ItemNumber, ItemName, Category, Subcategory, UnitPrice, QuantityInInventory) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssdi", $itemNumber, $name, $category, $subcategory, $unitPrice, $quantity);
                $stmt->execute();
                $stmt->close();
            }

            echo '<script>
                        alert("Data inserted successfully from the file.");
                        window.location.href = "add-inventory-form.php";
                    </script>';
            
        } 
        
        else if (strtolower($fileInfo['extension']) == 'json')
        {
            $fileContent = json_decode(file_get_contents($tempFilePath));
            // Iterate through each item in the file
            foreach ($fileContent->items as $item) {
                $itemNumber = (int)$item->itemNumber;
                $name = (string)$item->name;
                $category = (string)$item->category;
                $subcategory = (string)$item->subcategory;
                $unitPrice = (float)$item->unitPrice;
                $quantity = (int)$item->quantity;

                // Insert data into the Inventory table
                $sql = "INSERT INTO Inventory (ItemNumber, ItemName, Category, Subcategory, UnitPrice, QuantityInInventory) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssdi", $itemNumber, $name, $category, $subcategory, $unitPrice, $quantity);
                $stmt->execute();
                $stmt->close();
            }

            echo '<script>
            alert("Data inserted successfully from the file.");
            window.location.href = "add-inventory-form.php";
            </script>';
        }      
        
        else {
            echo "Invalid file format. Please upload a valid XML file.";
        }
    } else {
        echo "Error uploading file. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
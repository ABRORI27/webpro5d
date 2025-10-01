<?php
// Create Connections
include "config/conn_db.php";

$sql = "SELECT name, description, price, created FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row using a while loop
    while($row = $result->fetch_assoc()) {
        //body of loop
        echo "Name: " . $row["name"] . " - Description: " . $row["description"] . " - Price: " . $row["price"] . " - Created: " . $row["created"] . "<br>";
    }
} else {
    echo "0 results - Table is empty";
}

$conn->close();
?>
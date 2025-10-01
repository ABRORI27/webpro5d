<?php
// Create Connections
include "config/conn_db.php";

$sql = "SELECT name, description, price, created FROM products WHERE id=11";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    echo "Name: ". $row["name"]." - Description: ". $row["description"]. " - Price: ". $row["price"]. " - Created: ". $row["created"];
}
else {
    echo "0 results - Data not found";
}

$conn->close();
?>
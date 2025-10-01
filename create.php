<?php
// Create Connections
include "config/conn_db.php";

// data to be inserted
$prodName = $_POST['name'];
$prodDesc = $_POST['description'];
$prodPrice = $_POST['price'];

// insert data into table products
$sql = "INSERT INTO products(name, description, price)
VALUES ('$prodName', '$prodDesc', $prodPrice)";

if ($conn-> query($sql) === TRUE) {
    //
    //
    header('Location: read_table_view.php');
} else {
    echo "Error: ".$sql. "<br>".$conn->error;
}

// Close connection
$conn->close();
?>
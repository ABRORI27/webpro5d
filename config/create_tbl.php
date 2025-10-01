<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_webpro5d";

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE products(
id INT(11) NOT NULL AUTO_INCREMENT,
name VARCHAR(50) NOT NULL,
description TEXT NOT NULL,
price DOUBLE NOT NULL,
created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(id)
)";

if ($conn->query($sql) === TRUE){
    echo "Table products created successfully";
}else{
    echo "Error creating table products:".$conn->error;
}

// // sql to create table baru
// $sql2 = "CREATE TABLE new_products(
//     id INT(11) NOT NULL AUTO_INCREMENT,
//     name VARCHAR(100) NOT NULL,
//     alamat TEXT NOT NULL,
//     nik CHAR(16) NOT NULL,
//     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY(id)
// )";


// if ($conn->query($sql2) === TRUE){
//     echo "Table products created successfully";
// }else{
//     echo "Error creating table products:".$conn->error;
// }
$conn->close();
?>
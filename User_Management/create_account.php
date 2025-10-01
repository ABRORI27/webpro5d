<?php
// insert data user to table user
echo "INSERT INTO TABLE users";

// Create Connections
include "../config/conn_db.php";

// data to be inserted
$username = $_POST['username'];
$password = $_POST['password'];
$fullname  = $_POST['fullname'];
$role = $_POST['role'];

// insert data into table products
$sql = "INSERT INTO users(username, password, fullname, role)
VALUES ('$username', '$password', '$fullname' , '$role')";

if ($conn-> query($sql) === TRUE) {
    //
    //
    echo "New account created successfully";
    //
    // header('Location: view_users.php');
} else {
    echo "Error: ".$sql. "<br>".$conn->error;
}

// Close connection
$conn->close();
?>
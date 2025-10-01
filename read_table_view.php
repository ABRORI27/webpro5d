<?php
// Create Connections
include "config/conn_db.php";

$sql = "SELECT id, name, description, price FROM products";
$result = $conn->query($sql);

// link untuk Add product
echo "<a href=form_product.html>Add Product</a>";

if ($result->num_rows > 0) {
    // Table view
    echo "<style>";
    echo "    table { width: 100%; border-collapse: collapse; margin-top: 20px; }";
    echo "    th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }";
    echo "    th { background-color: #007bff; color: white; }";
    echo "    tr:nth-child(even) { background-color: #f2f2f2; }";
    echo "    tr:hover { background-color: #e9e9e9; }";
    echo "    .action-btn { text-decoration: none; padding: 5px 10px; border-radius: 5px; color: white; }";
    echo "    .edit-btn { background-color: #ffc107; }";
    echo "    .delete-btn { background-color: #dc3545; }";
    echo "</style>";

    echo "<table>";
    echo "    <thead>";
    echo "        <tr>";
    echo "            <th>ID</th>";
    echo "            <th>Name</th>";
    echo "            <th>Description</th>";
    echo "            <th>Price</th>";
    echo "            <th>Action</th>";
    echo "        </tr>";
    echo "    </thead>";
    echo "    <tbody>";
    
    while ($row = $result->fetch_assoc()) {
        echo "        <tr>";
        echo "            <td>" . htmlspecialchars($row['id']) . "</td>";
        echo "            <td>" . htmlspecialchars($row['name']) . "</td>";
        echo "            <td>" . htmlspecialchars($row['description']) . "</td>";
        echo "            <td>" . htmlspecialchars($row['price']) . "</td>";
        echo "            <td>";
        echo "                <a href='edit.php?id=" . $row['id'] . "' class='action-btn edit-btn'>Edit</a> ";
        echo "                <a href='delete.php?id=" . $row['id'] . "' class='action-btn delete-btn' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Delete</a>";
        echo "            </td>";
        echo "        </tr>";
    }

    echo "    </tbody>";
    echo "</table>";
} else {
    echo "0 results - Table is empty";
}

$conn->close();
?>

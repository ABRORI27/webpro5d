<?php
// Koneksi ke database
include "config/conn_db.php";

$name = $description = $price = "";
$name_err = $description_err = $price_err = "";

// Jika form disubmit (POST → update data)
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);

    $sql = "UPDATE products SET name=?, description=?, price=? WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
        if ($stmt->execute()) {
            header("location: read.php");
            exit();
        } else {
            echo "Oops! Ada yang salah, coba lagi nanti.";
        }
    }
    $stmt->close();

} else if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Jika form dibuka dengan GET → ambil data produk
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM products WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $name = $row["name"];
                $description = $row["description"];
                $price = $row["price"];
            } else {
                header("location: error.php");
                exit();
            }
        }
    }
    $stmt->close();
} else {
    header("location: error.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        textarea {
            height: 120px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <label for="name">Product Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="description">Description</label>
        <textarea name="description" required><?php echo htmlspecialchars($description); ?></textarea>

        <label for="price">Price</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>" required>

        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <button type="submit">Update Product</button>
    </form>
</div>

</body>
</html>

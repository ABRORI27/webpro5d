<?php
// ===== Bagian Proses PHP =====
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $host = "localhost";
    $user = "root";   // sesuaikan
    $pass = "";       // sesuaikan
    $db   = "db_webpro5d";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $role     = $_POST['role'];
    $status   = "active";

    // Query insert pakai prepared statement
    $sql = "INSERT INTO users (username, password, fullname, role, status) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $fullname, $role, $status);

    if ($stmt->execute()) {
        $message = "✅ Registrasi berhasil!";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1e7e34;
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
    </style>
    <script>
        // Validasi password sama
        function validateForm() {
            const pass = document.getElementById("password").value;
            const repass = document.getElementById("repassword").value;

            if (pass !== repass) {
                alert("❌ Password dan Re-Enter Password tidak sama!");
                return false; // hentikan submit
            }
            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2>User Registration</h2>
    
    <?php if ($message != ""): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST" onsubmit="return validateForm()">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="repassword">Re-Enter Password</label>
        <input type="password" id="repassword" name="repassword" required>

        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>

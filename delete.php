<?php
// Koneksi ke database
include "config/conn_db.php";

// Periksa apakah ID produk tersedia di URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    // Ambil ID dari URL dan bersihkan dari karakter berbahaya
    $id = trim($_GET['id']);

    // Buat query DELETE
    $sql = "DELETE FROM products WHERE id = ?";

    // Gunakan prepared statement untuk mencegah SQL Injection
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("i", $param_id);

        // Atur parameter
        $param_id = $id;

        // Jalankan statement
        if($stmt->execute()){
            // Jika berhasil, alihkan kembali ke halaman utama (read.php)
            header("location: read.php");
            exit();
        } else{
            echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }
    }
    // Tutup statement
    $stmt->close();
} else{
    // Jika ID tidak ada atau tidak valid, alihkan kembali ke halaman utama
    header("location: read_table_view.php");
    exit();
}

// Tutup koneksi
$conn->close();
?>
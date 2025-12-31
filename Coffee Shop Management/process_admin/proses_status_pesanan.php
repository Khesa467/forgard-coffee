<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['ID_Pegawai'])) {
    die("Anda harus login sebagai admin terlebih dahulu");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data dari form
if (isset($_POST['id_pesanan']) && isset($_POST['status_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $status_pesanan = $_POST['status_pesanan'];

    // Validasi data
    if (empty($id_pesanan) || empty($status_pesanan)) {
        die("Data tidak lengkap");
    }

    // Update status pesanan
    $sql = "UPDATE Pesanan SET Status_Pesanan = ? WHERE ID_Pesanan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status_pesanan, $id_pesanan);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
    
    $stmt->close();
} else {
    echo "Data tidak lengkap";
}

$conn->close();
?>
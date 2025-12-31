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
if (isset($_POST['id_transaksi']) && isset($_POST['status_pembayaran'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $id_pegawai = $_SESSION['ID_Pegawai'];

    // Update status pembayaran
    $sql = "UPDATE Transaksi SET Status_Pembayaran = ?, ID_Pegawai = ? WHERE ID_Transaksi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $status_pembayaran, $id_pegawai, $id_transaksi);

    if ($stmt->execute()) {
        // Jika status berubah menjadi "Lunas", update juga status pesanan
        if ($status_pembayaran == "Lunas") {
            $sql_pesanan = "UPDATE Pesanan p 
                           JOIN Transaksi t ON p.ID_Pesanan = t.ID_Pesanan 
                           SET p.Status_Pesanan = 'Diproses' 
                           WHERE t.ID_Transaksi = ?";
            $stmt_pesanan = $conn->prepare($sql_pesanan);
            $stmt_pesanan->bind_param("i", $id_transaksi);
            $stmt_pesanan->execute();
            $stmt_pesanan->close();
        }
        
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
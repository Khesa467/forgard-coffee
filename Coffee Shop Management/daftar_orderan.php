<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDERAN | Forgard Coffee</title>
    <link rel="icon" type="image/png" href="./img/logo.png">
    <link rel="stylesheet" type="text/css" href="./home/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <style>
        /* Sticky Footer */
        html, body {
            height: 100%;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-content {
            flex: 1;
        }
        
        .social-icons a {
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
        }

        .social-icons a:hover .fa-instagram {
            color: #E4405F !important;
        }

        .social-icons a:hover .fa-facebook {
            color: #1877F2 !important;
        }

        .social-icons a:hover .fa-envelope {
            color: #EA4335 !important;
        }

        .social-icons a:hover .fa-tiktok {
            color: #69C9D0 !important;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark sticky-top">
        <div class="container">
            <a class="logo" href="dashboard_admin.php" style="color: orange";>Forgard<span style="color: blue;"> Coffee</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="dashboard_admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="daftar_orderan.php">Daftar Orderan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="javascript:void(0);" onclick="confirmLogout()">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Main Content -->
    <div class="main-content">
        <!-- Tampilkan Data Pesanan -->
        <div class="container mt-3 mb-5">
            <h3 class="display-6" style="color: orange;">Daftar <span style="color: blue;">Orderan</span></h3>
            <!-- Tampilkan tabel data Pesanan -->
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "coffee_shop";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $sql ="SELECT
            Transaksi.ID_Transaksi,
            Pesanan.ID_Pesanan,
            Pelanggan.Nama AS Nama_Pelanggan,
            Produk.Nama_Produk,
            Pesanan.Jumlah,
            Pesanan.Alamat_Pengiriman,
            Pesanan.Tanggal_Pesanan,
            Pesanan.Status_Pesanan,
            Transaksi.Total_Harga,
            Transaksi.Metode_Pembayaran,
            Transaksi.Status_Pembayaran,
            Pegawai.Username AS Username_Pegawai
            FROM
            Transaksi
            LEFT JOIN Pesanan ON Transaksi.ID_Transaksi = Pesanan.ID_Pesanan
            LEFT JOIN Pelanggan ON Pesanan.ID_Pelanggan = Pelanggan.ID_Pelanggan
            LEFT JOIN Produk ON Pesanan.ID_Produk = Produk.ID_Produk
            LEFT JOIN Pegawai ON Transaksi.ID_Pegawai = Pegawai.ID_Pegawai";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='table-responsive'>
                <table class='table table-striped table-hover'>
                <thead class='table-dark'>
                <tr>
                <th>ID Pesanan</th>
                <th>ID Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Alamat Pengiriman</th>
                <th>Tanggal Pesanan</th>
                <th>Status Pesanan</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Username Pegawai</th>
                </tr>
                </thead>
                <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["ID_Pesanan"] . "</td>
                    <td>" . $row["ID_Transaksi"] . "</td>
                    <td>" . $row["Nama_Pelanggan"] . "</td>
                    <td>" . $row["Nama_Produk"] . "</td>
                    <td>" . $row["Jumlah"] . "</td>
                    <td>" . $row["Alamat_Pengiriman"] . "</td>
                    <td>" . $row["Tanggal_Pesanan"] . "</td>
                    <td><span class='badge bg-warning text-dark'>" . $row["Status_Pesanan"] . "</span></td>
                    <td>Rp " . number_format($row["Total_Harga"], 0, ',', '.') . "</td>
                    <td><span class='badge bg-info'>" . $row["Metode_Pembayaran"] . "</span></td>
                    <td><span class='badge bg-primary'>" . $row["Status_Pembayaran"] . "</span></td>
                    <td>" . ($row["Username_Pegawai"] ? $row["Username_Pegawai"] : '-') . "</td>
                    </tr>";
                }

                echo "</tbody>
                </table>
                </div>";
            } else {
                echo "<div class='alert alert-info text-center'>
                <h5>Belum ada orderan.</h5>
                <p>Tidak ada data pesanan yang ditemukan.</p>
                </div>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Copyrights - Footer di paling bawah -->
    <footer class="bg-dark mt-auto">
        <div class="container py-4">
            <div class="text-center">
                <p class="text-muted mb-3">© 2025 Forgard Coffee - Muhammad Khesa Rhafi.</p>
                
                <!-- Social Media Icons -->
                <div class="social-icons mb-3">
                    <a href="#" class="text-white me-3" title="Instagram">
                        <i class="fa-brands fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-3" title="Facebook">
                        <i class="fa-brands fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-3" title="Email">
                        <i class="fa-solid fa-envelope fa-lg"></i>
                    </a>
                    <a href="#" class="text-white" title="TikTok">
                        <i class="fa-brands fa-tiktok fa-lg"></i>
                    </a>
                </div>
                
                <p class="text-muted small mb-0">Your Perfect Coffee Experience ☕</p>
            </div>
        </div>
    </footer>
    <!-- End -->

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Logout',
                text: 'Apakah Anda yakin ingin logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika 'Ya' dipilih, arahkan ke index.html atau sesuai dengan kebutuhan Anda
                    window.location.replace('./home/index.html')
                    history.replaceState(null, null, './home/index.html');;
                }
            });
        }
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/c4e23af47a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAU PESAN APA ? | Forgard Coffee</title>
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
            <a class="logo" href="dashboard_pelanggan.php" style="color: orange;">Forgard<span style="color: blue;"> Coffee</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active mx-2">
                        <a class="nav-link" aria-current="page" href="dashboard_pelanggan.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="dashboard_pelanggan.php">Menu</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="daftar_pesanan.php">Daftar Pesanan</a>
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
        <div class="container mt-3">
            <h3 class="display-6" style="color: orange;">Daftar <span style="color: blue;">Pesanan</span></h3>

            <?php
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "coffee_shop";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Periksa apakah pelanggan sudah login
            if (isset($_SESSION["ID_Pelanggan"])) {
                $idPelanggan = $_SESSION["ID_Pelanggan"];

                // Query untuk mengambil data pesanan dari tabel Pesanan dan tabel terkait
                $query = "SELECT p.ID_Pesanan, pl.Nama AS Nama_Pelanggan, pr.Nama_Produk, p.Jumlah, pr.Harga, p.Alamat_Pengiriman, p.Tanggal_Pesanan, p.Status_Pesanan, t.Total_Harga
                FROM Pesanan p
                JOIN Transaksi t ON p.ID_Pesanan = t.ID_Transaksi
                JOIN Pelanggan pl ON p.ID_Pelanggan = pl.ID_Pelanggan
                JOIN Produk pr ON p.ID_Produk = pr.ID_Produk
                WHERE p.ID_Pelanggan = $idPelanggan";

                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    echo "<div class='table-responsive'>
                    <table class='table table-striped table-hover'>
                    <thead class='table-dark'>
                    <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Alamat Pengiriman</th>
                    <th>Tanggal Pesanan</th>
                    <th>Status Pesanan</th>
                    <th>Total Harga</th>
                    </tr>
                    </thead>
                    <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        $totalHarga = $row["Total_Harga"];

                        echo "<tr>
                        <td>" . $row["ID_Pesanan"] . "</td>
                        <td>" . $row["Nama_Pelanggan"] . "</td>
                        <td>" . $row["Nama_Produk"] . "</td>
                        <td>" . $row["Jumlah"] . "</td>
                        <td>Rp " . number_format($row["Harga"], 0, ',', '.') . "</td>
                        <td>" . $row["Alamat_Pengiriman"] . "</td>
                        <td>" . $row["Tanggal_Pesanan"] . "</td>
                        <td><span class='badge bg-warning text-dark'>" . $row["Status_Pesanan"] . "</span></td>
                        <td>Rp " . number_format($totalHarga, 0, ',', '.') . "</td>
                        </tr>";
                    }

                    echo "</tbody>
                    </table>
                    </div>";
                } else {
                    echo "<div class='alert alert-info text-center'>
                    <h5>Belum ada pesanan.</h5>
                    <p>Silakan melakukan pemesanan terlebih dahulu.</p>
                    <a href='order.php' class='btn btn-primary'>Pesan Sekarang</a>
                    </div>";
                }
            } else {
                echo "<div class='alert alert-warning text-center'>
                <h5>Pelanggan belum login.</h5>
                <p>Silakan login terlebih dahulu.</p>
                <a href='login.php' class='btn btn-warning'>Login</a>
                </div>";
            }

            $conn->close();
            ?>
        </div>

        <!-- Tombol di luar tabel untuk membayar dan membatalkan -->
        <?php if (isset($_SESSION["ID_Pelanggan"]) && $result->num_rows > 0): ?>
        <div class="container mt-4 mb-5">
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-success btn-lg px-4" id="btnBayarPesanan">
                    <i class="fa-solid fa-credit-card me-2"></i>Bayar Pesanan
                </button>
                <button class="btn btn-danger btn-lg px-4" id="btnBatalkanPesanan">
                    <i class="fa-solid fa-times me-2"></i>Batalkan Pesanan
                </button>
            </div>
        </div>
        <?php endif; ?>

        <!-- Modal Bayar Pesanan -->
        <div class="modal fade" id="bayarPesananModal" tabindex="-1" aria-labelledby="bayarPesananModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bayarPesananModalLabel">Bayar Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formBayarPesanan" method="post" action="./proses_pembelian.php">
                            <div class="mb-3">
                                <label for="id_pesanan_bayar" class="form-label">ID Pesanan:</label>
                                <input type="text" class="form-control" id="id_pesanan_bayar" name="id_pesanan_bayar" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100" id="btnKonfirmasiBayar">
                                <i class="fa-solid fa-check me-2"></i>Konfirmasi Bayar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Batalkan Pesanan -->
        <div class="modal fade" id="batalkanPesananModal" tabindex="-1" aria-labelledby="batalkanPesananModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalkanPesananModalLabel">Batalkan Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formBatalkanPesanan" method="post" action="./proses_pembatalan.php">
                            <div class="mb-3">
                                <label for="id_pesanan_batalkan" class="form-label">ID Pesanan:</label>
                                <input type="text" class="form-control" id="id_pesanan_batalkan" name="id_pesanan_batalkan" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100" id="btnKonfirmasiBatal">
                                <i class="fa-solid fa-times me-2"></i>Konfirmasi Batalkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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
                    window.location.replace('./home/index.html');
                    history.replaceState(null, null, './home/index.html');
                }
            });
        }

        // SweetAlert untuk Bayar Pesanan
        document.getElementById('btnBayarPesanan').addEventListener('click', function () {
            Swal.fire({
                title: 'Bayar Pesanan',
                text: 'Masukkan ID Pesanan:',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Bayar',
                cancelButtonText: 'Batal',
                preConfirm: (idPesanan) => {
                    if (!idPesanan) {
                        Swal.showValidationMessage('ID Pesanan harus diisi');
                    }
                    return { idPesanan: idPesanan };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('id_pesanan_bayar').value = result.value.idPesanan;
                    $('#bayarPesananModal').modal('show');
                }
            });
        });

        // SweetAlert untuk Batalkan Pesanan
        document.getElementById('btnBatalkanPesanan').addEventListener('click', function () {
            Swal.fire({
                title: 'Batalkan Pesanan',
                text: 'Masukkan ID Pesanan:',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Batalkan',
                cancelButtonText: 'Batal',
                preConfirm: (idPesanan) => {
                    if (!idPesanan) {
                        Swal.showValidationMessage('ID Pesanan harus diisi');
                    }
                    return { idPesanan: idPesanan };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('id_pesanan_batalkan').value = result.value.idPesanan;
                    $('#batalkanPesananModal').modal('show');
                }
            });
        });
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/c4e23af47a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
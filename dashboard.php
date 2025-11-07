<?php
session_start();

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// ====== Array Produk ======
$kode_barang = ["BRG001", "BRG002", "BRG003", "BRG004", "BRG005"];
$nama_barang = ["Kopi", "Teh", "Gula", "Susu", "Roti"];
$harga_barang = [15000, 10000, 12000, 20000, 8000];

// ====== Logika Penjualan Random ======
$beli = [];      // Barang yang dibeli
$jumlah = [];    // Jumlah pembelian per barang
$total = [];     // Total harga per barang
$grandtotal = 0; // Total keseluruhan (nanti dipakai di commit selanjutnya)

// Simulasikan pembelian 3 barang random
for ($i = 0; $i < 3; $i++) {
    $index = rand(0, count($kode_barang) - 1); // Pilih index barang acak
    $beli[] = $nama_barang[$index];
    $jumlah_beli = rand(1, 5); // Jumlah acak 1–5
    $jumlah[] = $jumlah_beli;
    $total[] = $harga_barang[$index] * $jumlah_beli;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POLGAN MART</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h2 {
            margin: 0;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h2>POLGAN MART - Dashboard</h2>
        <div>
            <span>Halo, <strong><?php echo htmlspecialchars($username); ?></strong></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <h3>Simulasi Penjualan (Random)</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan (Rp)</th>
                <th>Total Harga (Rp)</th>
            </tr>
            <?php
            for ($i = 0; $i < count($beli); $i++) {
                // Cari harga satuan dari array asli berdasarkan nama
                $index_barang = array_search($beli[$i], $nama_barang);
                $harga_satuan = $harga_barang[$index_barang];

                echo "<tr>";
                echo "<td>" . ($i + 1) . "</td>";
                echo "<td>{$beli[$i]}</td>";
                echo "<td>{$jumlah[$i]}</td>";
                echo "<td>" . number_format($harga_satuan, 0, ',', '.') . "</td>";
                echo "<td>" . number_format($total[$i], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
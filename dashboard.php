<?php
session_start();

// Pastikan user sudah login
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
$beli = [];
$jumlah = [];
$total = [];
$grandtotal = 0;

// Simulasikan pembelian 3 barang random
for ($i = 0; $i < 3; $i++) {
    $index = rand(0, count($kode_barang) - 1);
    $beli[] = $nama_barang[$index];
    $jumlah_beli = rand(1, 5);
    $jumlah[] = $jumlah_beli;
    $harga_satuan = $harga_barang[$index];
    $total_harga = $harga_satuan * $jumlah_beli;
    $total[] = $total_harga;
    $grandtotal += $total_harga;
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
        .total-row {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .summary {
            margin-top: 20px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .summary h4 {
            margin: 0;
            color: #333;
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
        <h3>Detail Pembelian</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan (Rp)</th>
                <th>Total Harga (Rp)</th>
            </tr>
            <?php
            $no = 1;
            foreach ($beli as $key => $nama) {
                $harga_satuan = $total[$key] / $jumlah[$key];
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>{$nama}</td>";
                echo "<td>{$jumlah[$key]}</td>";
                echo "<td>" . number_format($harga_satuan, 0, ',', '.') . "</td>";
                echo "<td>" . number_format($total[$key], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
            <tr class="total-row">
                <td colspan="4">Grand Total</td>
                <td><?php echo number_format($grandtotal, 0, ',', '.'); ?></td>
            </tr>
        </table>

        <div class="summary">
            <h4>Total Belanja Anda: <span style="color:#007bff;"><?php echo "Rp " . number_format($grandtotal, 0, ',', '.'); ?></span></h4>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Update Data Peminjaman</title>
</head>
<body>
    <?php
    include "config.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Ambil customer_id dari parameter GET
    if (isset($_GET['peminjaman_id'])) {
        $peminjaman_id = $_GET['peminjaman_id'];

        // Query untuk mengambil data customer berdasarkan customer_id
        $sql = "SELECT * FROM peminjaman WHERE peminjaman_id=?";
        $stmt = mysqli_prepare($config, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $peminjaman_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Periksa apakah data ditemukan
            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
            } else {
                echo "Data peminjaman tidak ditemukan.";
                exit;
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare statement. Error: " . mysqli_error($config);
        }
    } else {
        echo "ID supplier tidak ditemukan.";
        exit;
    }
    ?>

    <h3>Update Tabel Data Peminjaman</h3>
    <form method="POST" action="DataPeminjaman_action.php">
        <table>
            <tr>
                <td>Peminjaman id</td>
                <td>:</td>
                <td><input type="number" name="peminjamanid" value="<?php echo $data['peminjaman_id'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Customer id</td>
                <td>:</td>
                <td><input type="number" name="customerid" value="<?php echo $data['customer_id'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Barang id</td>
                <td>:</td>
                <td><input type="number" name="barangid" value="<?php echo $data['barang_id'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Tanggal Reservasi</td>
                <td>:</td>
                <td><input type="date" name="tanggalreservasi" value="<?php echo $data['tanggal_reservasi'] ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Pinjam</td>
                <td>:</td>
                <td><input type="date" name="tanggalpinjam" value="<?php echo $data['tanggal_pinjam'] ?>"></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input type="number" name="jumlah" value="<?php echo $data['jumlah'] ?>"></td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <input type="number" step="0.01" name="totalharga" value="<?php echo $data['total_harga'] ?>">
            </tr>
            <tr>
                <td>Kondisi Awal</td>
                <td>:</td>
                <td><input type="text" name="kondisiawal" value="<?php echo $data['kondisiawal'] ?>"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="ubah" value="Simpan">
                    <input type="reset" value="Batal">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

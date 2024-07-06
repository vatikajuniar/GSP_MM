<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peminjaman_id = isset($_POST['peminjamanid']) ? $_POST['peminjamanid'] : null;
    $customer_id = isset($_POST['customerid']) ? $_POST['customerid'] : null;
    $barang_id = isset($_POST['barangid']) ? $_POST['barangid'] : null;
    $tanggal_reservasi = isset($_POST['tanggalreservasi']) ? $_POST['tanggalreservasi'] : null;
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : null;
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : null;
    $total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : null;
    $kondisi_awal = isset($_POST['kondisi_awal']) ? $_POST['kondisi_awal'] : null;

    // Pastikan semua variabel ada sebelum melanjutkan
    if ($peminjaman_id && $customer_id && $barang_id && $tanggal_reservasi && $tanggal_pinjam && $jumlah && $total_harga && $kondisi_awal) {
        // SQL query to update customer data using prepared statement
        $sql = "UPDATE peminjaman SET customer_id=?, barang_id=?, tanggal_reservasi=?, tanggal_pinjam=?, jumlah=?, total_harga=?, kondisi_awal=? WHERE peminjaman_id=?";
        $stmt = mysqli_prepare($config, $sql);

        if ($stmt) {
            // Bind parameter ke statement
            mysqli_stmt_bind_param($stmt, "iisssisi", $customer_id, $barang_id, $tanggal_reservasi, $tanggal_pinjam, $jumlah, $total_harga, $kondisi_awal, $peminjaman_id);

            // Eksekusi statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Data berhasil diubah";
            } else {
                echo "Data gagal diubah. Error: " . mysqli_stmt_error($stmt);
                var_dump(mysqli_error($config)); // Debugging error MySQL
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare statement. Error: " . mysqli_error($config);
        }

        mysqli_close($config);
    } else {
        echo "Data tidak lengkap.";
    }
} else {
    echo "Metode request tidak valid.";
}
?>
<br>Kembali ke <a href="Peminjaman.html">Data Peminjaman</a>

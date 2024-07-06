<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pengembalian_id = isset($_POST['pengembalianid']) ? $_POST['pengembalianid'] : null;
    $peminjaman_id = isset($_POST['peminjamanid']) ? $_POST['peminjamanid'] : null;
    $tanggal_kembali = isset($_POST['tanggalkembali']) ? $_POST['tanggalkembali'] : null;
    $kondisi_akhir = isset($_POST['kondisiAkhir']) ? $_POST['kondisiAkhir'] : null;
    $denda = isset($_POST['denda']) ? $_POST['denda'] : null;

    // Pastikan semua variabel ada sebelum melanjutkan
    if ($pengembalian_id && $peminjaman_id && $tanggal_kembali && $kondisi_akhir && $denda) {
        // SQL query to update pengembalian data using prepared statement
        $sql = "UPDATE pengembalian SET peminjaman_id=?, tanggal_kembali=?, kondisi_akhir=?, denda=? WHERE pengembalian_id=?";
        $stmt = mysqli_prepare($config, $sql);

        if ($stmt) {
            // Bind parameter ke statement
            mysqli_stmt_bind_param($stmt, "isssi", $peminjaman_id, $tanggal_kembali, $kondisi_akhir, $denda, $pengembalian_id);

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
<br>Kembali ke <a href="Pengembalian.html">Data Pengembalian</a>

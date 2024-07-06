<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stock'];
    $harga_sewa = str_replace('.', '', $_POST['harga_sewa']); // Remove format for storing in database
    $supplier_id = $_POST['supplier_id'];


    // Check if supplier_id is set and not empty
    if (!empty($supplier_id)) {
        // Check if supplier_id exists in supplier table
        $check_supplier_sql = "SELECT supplier_id FROM supplier WHERE supplier_id = ?";
        $stmt = mysqli_prepare($config, $check_supplier_sql);
        mysqli_stmt_bind_param($stmt, "i", $supplier_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 0) {
            echo "Supplier ID tidak valid.";
            mysqli_stmt_close($stmt);
            exit;
        }
        mysqli_stmt_close($stmt);
    } else {
        $supplier_id = NULL; // Set supplier_id to NULL if not provided
    }

    // SQL query to update barang data using prepared statement
    $sql = "UPDATE barang SET nama_barang=?, kategori=?, stok=?, harga_sewa=?, supplier_id=? WHERE barang_id=?";
    mysqli_commit($config);
    $stmt = mysqli_prepare($config, $sql);

    if ($stmt) {
        // Check if supplier_id is NULL and bind parameters accordingly
        if ($supplier_id === NULL) {
            mysqli_stmt_bind_param($stmt, "ssisis", $nama_barang, $kategori, $stok, $harga_sewa, $supplier_id, $id_barang);
        } else {
            mysqli_stmt_bind_param($stmt, "ssissi", $nama_barang, $kategori, $stok, $harga_sewa, $supplier_id, $id_barang);
        }

        if (mysqli_stmt_execute($stmt)) {
            echo "Data berhasil diubah";
        } else {
            echo "Data gagal diubah. Error: " . mysqli_error($config);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare statement. Error: " . mysqli_error($config);
    }

    mysqli_close($config);
}
?>
<br>Kembali ke <a href="DataBarang.html">Data Barang</a>

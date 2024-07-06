<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customerid'];
    $nama_customer = $_POST['namacustomer'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // SQL query to update customer data using prepared statement
    $sql = "UPDATE customer SET nama_customer=?, alamat=?, telepon=?, email=? WHERE customer_id=?";
    $stmt = mysqli_prepare($config, $sql);

    if ($stmt) {
        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "ssssi", $nama_customer, $alamat, $telepon, $email, $customer_id);

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
    echo "Metode request tidak valid.";
}
?>
<br>Kembali ke <a href="DataCustomer.html">Data Customer</a>

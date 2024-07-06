<!DOCTYPE html>
<html>
<head>
    <title>Halaman Update Data Customer</title>
</head>
<body>
    <?php
    include "config.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Ambil customer_id dari parameter GET
    if (isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];

        // Query untuk mengambil data customer berdasarkan customer_id
        $sql = "SELECT * FROM customer WHERE customer_id=?";
        $stmt = mysqli_prepare($config, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $customer_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Periksa apakah data ditemukan
            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
            } else {
                echo "Data customer tidak ditemukan.";
                exit;
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare statement. Error: " . mysqli_error($config);
        }
    } else {
        echo "ID customer tidak ditemukan.";
        exit;
    }
    ?>

    <h3>Update Tabel Data Customer</h3>
    <form method="POST" action="DataCustomer_action.php">
        <table>
            <tr>
                <td>Customer id</td>
                <td>:</td>
                <td><input type="number" name="customerid" value="<?php echo $data['customer_id'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td><input type="text" name="namacustomer" value="<?php echo $data['nama_customer'] ?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat" value="<?php echo $data['alamat'] ?>"></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>:</td>
                <td><input type="integer" name="telepon" value="<?php echo $data['telepon'] ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="email" name="email" value="<?php echo $data['email'] ?>"></td>
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

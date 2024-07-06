<!DOCTYPE html>
<html>
<head>
    <title>Halaman Update Data Pengembalian</title>
</head>
<body>
    <?php
    include "config.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Ambil pengembalian_id dari parameter GET
    if (isset($_GET['pengembalian_id'])) {
        $pengembalian_id = $_GET['pengembalian_id'];

        // Query untuk mengambil data pengembalian berdasarkan pengembalian_id
        $sql = "SELECT * FROM pengembalian WHERE pengembalian_id=?";
        $stmt = mysqli_prepare($config, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $pengembalian_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Periksa apakah data ditemukan
            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
            } else {
                echo "Data pengembalian tidak ditemukan.";
                exit;
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare statement. Error: " . mysqli_error($config);
        }
    } else {
        echo "ID pengembalian tidak ditemukan.";
        exit;
    }
    ?>

    <h3>Update Tabel Data Pengembalian</h3>
    <form method="POST" action="DataPengembalian_action.php">
        <table>
            <tr>
                <td>Pengembalian id</td>
                <td>:</td>
                <td><input type="number" name="pengembalianid" value="<?php echo $data['pengembalian_id'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Peminjaman id</td>
                <td>:</td>
                <td><input type="number" name="peminjamanid" value="<?php echo $data['peminjaman_id'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td>:</td>
                <td><input type="date" name="tanggalkembali" value="<?php echo $data['tanggal_kembali'] ?>"></td>
            </tr>
            <tr>
                <td>Konsisi Akhir</td>
                <td>:</td>
                <td><input type="text" name="kondisiAkhir" value="<?php echo $data['kondisi_Akhir'] ?>"></td>
            </tr>
            <tr>
                <td>Denda</td>
                <td>:</td>
                <td><input type="number" step="0.01" name="denda" value="<?php echo $data['denda'] ?>"></td>
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

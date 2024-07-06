<!DOCTYPE html>
<html>
<head>
   <title>Halaman Update Data Barang</title>
</head>
<body>
    <?php
        include "config.php";

        if (isset($_GET['barang_id'])) {
            $barang_id = $_GET['barang_id'];

            $sql = "SELECT * FROM barang WHERE barang_id='$barang_id'";
            $hasil = mysqli_query($config, $sql);
            if ($hasil) {
                $data = mysqli_fetch_assoc($hasil);
            } else {
                echo "Data tidak ditemukan.";
                exit;
            }
        } else {
            echo "ID barang tidak ditemukan.";
            exit;
        }
    ?>

    <h3>Update Tabel Data Barang</h3>
    <form method="POST" action="update_databarang_action.php">
        <table>
            <tr>
                <td>Id barang</td>
                <td>:</td>
                <td>
                <input type="number" name="Idbarang" value="<?php echo $data['barang_id'] ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Nama barang</td>
                <td> : </td>
                <td>
                    <input type="text" name="namabarang" value="<?php echo $data['nama_barang'] ?>">
                </td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td> : </td>
                <td>
                    <input type="text" name="Kategori" value="<?php echo $data['kategori'] ?>">
                </td>
            </tr>
            <tr>
                <td>Stok</td>
                <td> : </td>
                <td>
                    <input type="number" name="Stok" value="<?php echo $data['stok'] ?>">
                </td>
            </tr>
            <tr>
                <td>Harga sewa</td>
                <td> : </td>
                <td>
                    <input type="number" step="0.01" name="hargasewa" value="<?php echo $data['harga_sewa'] ?>">
                </td>
            </tr>
            <tr>
                <td>Supplier id</td>
                <td> : </td>
                <td>
                    <input type="i" name="Supplierid" value="<?php echo $data['supplier_id'] ?>">
                </td>
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

<?php
include 'koneksi.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Hapus data dari database
    $query = "DELETE FROM data WHERE id = $id";
    $result = $koneksi->query($query);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $koneksi->error;
    }
} else {
    echo "ID tidak valid";
}
?>

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $gambar = $_FILES["gambar"]["name"];
    $temp_file = $_FILES["gambar"]["tmp_name"];

    // Pindahkan file gambar ke folder yang diinginkan
    move_uploaded_file($temp_file, "uploads/" . $gambar);

    // Simpan data ke database
    $query = "INSERT INTO data (nama, gambar) VALUES ('$nama', '$gambar')";
    $result = $koneksi->query($query);

    if ($result) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Gagal menyimpan data: " . $koneksi->error;
    }
}
header("Location: index.php");
exit();

?>

<?php
include 'koneksi.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Ambil data dari database berdasarkan ID
    $query = "SELECT * FROM data WHERE id = $id";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row["nama"];
        $gambar = $row["gambar"];
    } else {
        echo "Data tidak ditemukan";
        exit();
    }
} else {
    echo "ID tidak valid";
    exit();
}

// Handle form submission untuk update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_baru = $_POST["nama"];
    $gambar_baru = $_FILES["gambar"]["name"];
    $temp_file = $_FILES["gambar"]["tmp_name"];

    // Pindahkan file gambar ke folder yang diinginkan
    move_uploaded_file($temp_file, "uploads/" . $gambar_baru);

    // Update data ke database
    $query_update = "UPDATE data SET nama = '$nama_baru', gambar = '$gambar_baru' WHERE id = $id";
    $result_update = $koneksi->query($query_update);

    if ($result_update) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal mengupdate data: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" class="form-control-file" name="gambar" accept="image/*" required>
                <img src="uploads/<?php echo $gambar; ?>" alt="Gambar saat ini" class="mt-2 img-thumbnail">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include 'koneksi.php';

// Menampilkan data terbaru
$query = "SELECT * FROM data ORDER BY id DESC LIMIT 5"; // Mengambil 5 data terbaru
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .input-container {
            margin-bottom: 20px;
        }

        .input-container label {
            font-weight: bold;
        }

        .input-container input[type="text"], .input-container input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .input-container input[type="file"] {
            margin-top: 5px;
        }

        .input-container input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .input-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 3px;
            background-color: #f9f9f9;
        }

        .action-links a:hover {
            background-color: #e3e3e3;
        }

        .input-button {
            margin-bottom: 10px;
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .input-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-3">Data Terbaru</h2>
        <button class="btn btn-success mb-3" onclick="toggleForm()">Input Data</button>

        <div class="input-container" id="inputForm" style="display: none;">
            <form action="proses.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar:</label>
                    <input type="file" class="form-control-file" name="gambar" accept="image/*" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td><img src='uploads/" . $row["gambar"] . "' alt='Gambar' /></td>";
                    echo "<td class='action-links'>
                            <a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function toggleForm() {
            var form = document.getElementById("inputForm");
            form.style.display = (form.style.display === "none") ? "block" : "none";
        }
    </script>
</body>
</html>

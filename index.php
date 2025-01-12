<?php
session_start();
include 'db.php';

// Cek jika pengguna sudah login, jika tidak arahkan ke halaman registrasi
if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit();
}

// Tampil data kalibrasi alat
$sql = "SELECT * FROM kalibrasi_alat";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalibrasi Alat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Dashboard Kalibrasi Alat</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="create.php">Tambah Kalibrasi Alat</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="container">
    <h2>Data Kalibrasi Alat</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Alat</th>
                <th>Tipe Alat</th>
                <th>Tanggal Kalibrasi</th>
                <th>Hasil Kalibrasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama_alat']; ?></td>
                    <td><?php echo $row['tipe_alat']; ?></td>
                    <td><?php echo $row['tanggal_calibration']; ?></td>
                    <td><?php echo $row['hasil_calibration']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

</body>
</html>

<?php
session_start();
include 'db.php';

// Cek jika pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Tampil data kalibrasi alat
$sql = "SELECT * FROM kalibrasi_alat";
$result = $conn->query($sql);
?>

<h1>Dashboard Kalibrasi Alat</h1>
<a href="logout.php">Logout</a>
<h2>Data Kalibrasi</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Alat</th>
        <th>Tipe Alat</th>
        <th>Tanggal Kalibrasi</th>
        <th>Hasil Kalibrasi</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nama_alat']; ?></td>
        <td><?php echo $row['tipe_alat']; ?></td>
        <td><?php echo $row['tanggal_calibration']; ?></td>
        <td><?php echo $row['hasil_calibration']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<a href="create.php">Tambah Kalibrasi Alat</a>

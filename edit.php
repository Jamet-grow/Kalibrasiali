<?php
session_start();
include 'db.php';

// Cek jika pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Ambil data kalibrasi berdasarkan ID
$sql = "SELECT * FROM kalibrasi_alat WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_alat = $_POST['nama_alat'];
    $tipe_alat = $_POST['tipe_alat'];
    $tanggal_calibration = $_POST['tanggal_calibration'];
    $hasil_calibration = $_POST['hasil_calibration'];

    // Query untuk memperbarui kalibrasi alat
    $sql = "UPDATE kalibrasi_alat SET nama_alat = '$nama_alat', tipe_alat = '$tipe_alat', tanggal_calibration = '$tanggal_calibration', hasil_calibration = '$hasil_calibration' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST" action="edit.php?id=<?php echo $id; ?>">
    Nama Alat: <input type="text" name="nama_alat" value="<?php echo $row['nama_alat']; ?>" required><br>
    Tipe Alat: <input type="text" name="tipe_alat" value="<?php echo $row['tipe_alat']; ?>"><br>
    Tanggal Kalibrasi: <input type="date" name="tanggal_calibration" value="<?php echo $row['tanggal_calibration']; ?>" required><br>
    Hasil Kalibrasi: <textarea name="hasil_calibration" required><?php echo $row['hasil_calibration']; ?></textarea><br>
    <button type="submit">Simpan Perubahan</button>
</form>

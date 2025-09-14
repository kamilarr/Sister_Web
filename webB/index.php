<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost:8080/sso/login.php?redirect=webB");
    exit;
}
include "config.php";

$result = $conn->query("SELECT k.id, m.nama as nama_mhs, d.nama as nama_dosen, mat.nama_matkul, k.nilai 
    FROM kuliah k 
    JOIN mhs m ON k.nim=m.nim 
    JOIN dosen d ON k.nip=d.nip 
    JOIN matkul mat ON k.kode_matkul=mat.kode_matkul");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Web B - Perkuliahan</title>
</head>
<body>
    <h2>Halo, <?php echo $_SESSION['username']; ?>! Selamat datang di Web B (Perkuliahan)</h2>
    <a href="http://localhost:8080/sso/logout.php">Logout</a>
    <h3>Data Perkuliahan</h3>
    <table border="1">
        <tr><th>ID</th><th>Mahasiswa</th><th>Dosen</th><th>Mata Kuliah</th><th>Nilai</th></tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama_mhs'] ?></td>
            <td><?= $row['nama_dosen'] ?></td>
            <td><?= $row['nama_matkul'] ?></td>
            <td><?= $row['nilai'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

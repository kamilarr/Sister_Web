<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost:8080/sso/login.php?redirect=webA");
    exit;
}
include "config.php";
$result = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Web A - Perpustakaan</title>
</head>
<body>
    <h2>Halo, <?php echo $_SESSION['username']; ?>! Selamat datang di Web A (Perpustakaan)</h2>
    <a href="http://localhost:8080/sso/logout.php">Logout</a>
    <h3>Daftar Buku</h3>
    <table border="1">
        <tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Kategori</th><th>Stok</th></tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['buku_id'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td><?= $row['stok'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

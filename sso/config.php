<?php
$conn = new mysqli("localhost", "root", "", "db_auth", 3307);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

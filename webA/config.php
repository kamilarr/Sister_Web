<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_perpustakaan"; // database sesuai yang kamu buat

$conn = new mysqli("localhost", "root", "", "db_perpustakaan");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

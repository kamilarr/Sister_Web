<?php
require_once "check_auth.php";
include "config.php";

// Ambil data buku berdasarkan ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM books WHERE buku_id=$id");
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit;
}
$book = $result->fetch_assoc();

// UPDATE buku
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];

    $conn->query("UPDATE books SET judul='$judul', penulis='$penulis', kategori='$kategori', stok='$stok' WHERE buku_id=$id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-amber-800 text-white px-6 py-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold tracking-wide">PERPUSTAKAAN</h1>
        <a href="http://localhost:8080/sso/logout.php" class="hover:underline text-sm font-medium">Logout</a>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-8">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-96 border border-amber-200">
            <h2 class="text-xl font-semibold mb-6 text-amber-800">Edit Buku</h2>

            <form method="POST" class="space-y-4">
                <input type="text" name="judul" placeholder="Judul" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:outline-none"
                       value="<?= htmlspecialchars($book['judul']) ?>">
                <input type="text" name="penulis" placeholder="Penulis" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:outline-none"
                       value="<?= htmlspecialchars($book['penulis']) ?>">
                <input type="text" name="kategori" placeholder="Kategori" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:outline-none"
                       value="<?= htmlspecialchars($book['kategori']) ?>">
                <input type="number" name="stok" placeholder="Stok" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:outline-none"
                       value="<?= $book['stok'] ?>">

                <button type="submit" 
                        class="w-full bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg font-semibold">
                    Update
                </button>
            </form>

            <a href="index.php" class="mt-4 inline-block text-amber-700 hover:underline">Batal</a>
        </div>
    </main>

</body>
</html>

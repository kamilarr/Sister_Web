<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost:8080/sso/login.php?redirect=webA");
    exit;
}

include "config.php";

// Ambil semua buku
$result = $conn->query("SELECT * FROM books");

// Hapus buku
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM books WHERE buku_id=$id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-amber-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-amber-800 text-white px-6 py-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold tracking-wide">PERPUSTAKAAN</h1>
        <a href="http://localhost:8080/sso/logout.php" 
           class="hover:underline text-sm font-medium">Logout</a>
    </nav>

    <main class="flex-1 p-8">
        <h2 class="text-2xl font-bold text-amber-900 mb-6">
            Data Perpustakaan
        </h2>

        <!-- Tabel Katalog Buku -->
        <div class="overflow-x-auto bg-white rounded-2xl shadow-lg border border-amber-200">
            <table class="w-full text-left border-collapse">
                <thead class="bg-amber-100">
                    <tr>
                        <th class="px-6 py-3 text-amber-900">ID</th>
                        <th class="px-6 py-3 text-amber-900">Judul</th>
                        <th class="px-6 py-3 text-amber-900">Penulis</th>
                        <th class="px-6 py-3 text-amber-900">Kategori</th>
                        <th class="px-6 py-3 text-amber-900">Stok</th>
                        <th class="px-6 py-3 text-amber-900 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <tr class="border-b hover:bg-amber-50">
                            <td class="px-6 py-3"><?= $row['buku_id'] ?></td>
                            <td class="px-6 py-3 font-medium"><?= $row['judul'] ?></td>
                            <td class="px-6 py-3"><?= $row['penulis'] ?></td>
                            <td class="px-6 py-3"><?= $row['kategori'] ?></td>
                            <td class="px-6 py-3"><?= $row['stok'] ?></td>
                            <td class="px-6 py-3 text-center">
                                <a href="?delete=<?= $row['buku_id'] ?>" 
                                   onclick="return confirm('Yakin hapus buku ini?')"
                                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg text-sm">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol Create -->
        <div class="flex justify-end mt-6">
            <a href="create.php"
               class="bg-amber-700 hover:bg-amber-800 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md">
               + Tambah Buku
            </a>
        </div>
    </main>
</body>
</html>

<?php
require_once "check_auth.php";
include "config.php";

// DELETE: hapus buku
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM books WHERE buku_id=$id");
    header("Location: index.php");
    exit;
}

// READ: ambil semua buku
$result = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-amber-800 text-white px-6 py-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold tracking-wide">PERPUSTAKAAN</h1>
        <a href="http://localhost:8080/sso/logout.php" class="hover:underline text-sm font-medium">Logout</a>
    </nav>

    <!-- Hero Section -->
    <section class="relative w-full h-64 md:h-80 lg:h-96">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1920&auto=format&fit=crop" 
             alt="Library Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg text-center">
                Welcome to Perpustakaan
            </h1>
        </div>
    </section>

    <main class="flex-1 p-8 max-w-7xl mx-auto w-full">

        <!-- Tabel Buku -->
        <h2 class="text-2xl font-bold text-amber-900 mb-6">Data Buku</h2>
        <div class="overflow-x-auto bg-white rounded-2xl shadow-lg border border-amber-200">
            <table class="w-full text-left border-collapse">
                <thead class="bg-amber-700 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Judul</th>
                        <th class="py-3 px-4 text-left">Penulis</th>
                        <th class="py-3 px-4 text-left">Kategori</th>
                        <th class="py-3 px-4 text-left">Stok</th>
                        <th class="py-3 px-4 text-left text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <tr class="border-b hover:bg-amber-50">
                            <td class="px-6 py-3"><?= $row['buku_id'] ?></td>
                            <td class="px-6 py-3 font-medium"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="px-6 py-3"><?= htmlspecialchars($row['penulis']) ?></td>
                            <td class="px-6 py-3"><?= htmlspecialchars($row['kategori']) ?></td>
                            <td class="px-6 py-3"><?= $row['stok'] ?></td>
                            <td class="px-6 py-3 text-center space-x-2">
                                <a href="edit.php?id=<?= $row['buku_id'] ?>" 
                                   class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600 transition">
                                   Edit
                                </a>
                                <a href="?delete=<?= $row['buku_id'] ?>" 
                                   onclick="return confirm('Yakin hapus buku ini?')"
                                   class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol Create di bawah tabel -->
        <div class="flex justify-end mt-6">
            <a href="create.php" 
               class="bg-amber-700 hover:bg-amber-800 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition">
               + Tambah Buku
            </a>
        </div>

    </main>
</body>
</html>

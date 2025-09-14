<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];

    $conn->query("INSERT INTO books (judul, penulis, kategori, stok) 
                  VALUES ('$judul', '$penulis', '$kategori', '$stok')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Buku</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdfcf9] flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-2xl shadow-lg w-96 border border-[#e7dfd8]">
    <h2 class="text-xl font-semibold mb-6 text-[#5a3825]">Tambah Buku Baru</h2>
    
    <form method="POST" class="space-y-4">
      <input type="text" name="judul" placeholder="Judul" required class="w-full px-4 py-2 border rounded-lg focus:ring-[#5a3825] focus:outline-none">
      <input type="text" name="penulis" placeholder="Penulis" required class="w-full px-4 py-2 border rounded-lg focus:ring-[#5a3825] focus:outline-none">
      <input type="text" name="kategori" placeholder="Kategori" required class="w-full px-4 py-2 border rounded-lg focus:ring-[#5a3825] focus:outline-none">
      <input type="number" name="stok" placeholder="Stok" required class="w-full px-4 py-2 border rounded-lg focus:ring-[#5a3825] focus:outline-none">
      
      <button type="submit" class="w-full bg-[#5a3825] hover:bg-[#462b1d] text-white px-4 py-2 rounded-lg">
        Simpan
      </button>
    </form>
  </div>

</body>
</html>

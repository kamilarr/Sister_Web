<?php
require_once "check_auth.php";
include "config.php"; 
$base = '/webB/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - WebB</title>
  <link rel="stylesheet" href="/public/output.css">
</head>
<body class="bg-amber-50">

  <?php include "navbar.php"; ?>

  <!-- ✅ Hero Section -->
  <section class="relative w-full h-64 md:h-80 lg:h-96">
    <!-- Gambar Latar -->
    <img src="/public/hero.jpg" alt="Informatics Banner"
         class="w-full h-full object-cover">
    <!-- Overlay gelap tipis agar teks lebih terbaca -->
    <div class="absolute inset-0 bg-black/60"></div>
    <!-- Teks di tengah -->
    <div class="absolute inset-0 flex items-center justify-center">
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg text-center">
        Welcome to Informatics's Dashboard
      </h1>
    </div>
  </section>
  <!-- ✅ End Hero -->

  <main class="max-w-7xl mx-auto p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Card Data Dosen -->
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow p-6 text-center">
        <h2 class="text-xl font-semibold text-amber-700 mb-2">Data Dosen</h2>
        <p class="text-gray-600">Lihat dan kelola data dosen</p>
        <a href="<?= $base ?>dosen.php"
           class="mt-4 inline-block bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
          Kelola
        </a>
      </div>

      <!-- Card Data Mahasiswa -->
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow p-6 text-center">
        <h2 class="text-xl font-semibold text-amber-700 mb-2">Data Mahasiswa</h2>
        <p class="text-gray-600">Lihat dan kelola data mahasiswa</p>
        <a href="<?= $base ?>mahasiswa.php"
           class="mt-4 inline-block bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
          Kelola
        </a>
      </div>

      <!-- Card Mata Kuliah -->
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow p-6 text-center">
        <h2 class="text-xl font-semibold text-amber-700 mb-2">Data Mata Kuliah</h2>
        <p class="text-gray-600">Lihat dan kelola data mata kuliah</p>
        <a href="<?= $base ?>matkul.php"
           class="mt-4 inline-block bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
          Kelola
        </a>
      </div>

      <!-- Card Perkuliahan -->
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow p-6 text-center">
        <h2 class="text-xl font-semibold text-amber-700 mb-2">Data Perkuliahan</h2>
        <p class="text-gray-600">Lihat dan kelola data perkuliahan</p>
        <a href="<?= $base ?>perkuliahan.php"
           class="mt-4 inline-block bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
          Kelola
        </a>
      </div>
    </div>
  </main>

</body>
</html>

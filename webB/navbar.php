<?php $current = basename($_SERVER['PHP_SELF']); ?>
<nav class="bg-amber-700 text-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16 flex-wrap">
      
      <!-- Logo -->
      <a href="index.php" class="text-2xl font-bold tracking-wide hover:text-amber-100 transition-colors">
        Manajemen Perkuliahan
      </a>

      <!-- Menu -->
      <div class="flex flex-wrap space-x-4 items-center">
        <a href="index.php"
           class="hover:text-amber-100 transition-colors <?php echo $current=='index.php' ? 'font-bold' : ''; ?>">
           Dashboard
        </a>
        <a href="dosen.php"
           class="hover:text-amber-100 transition-colors <?php echo $current=='dosen.php' ? 'font-bold' : ''; ?>">
           Dosen
        </a>
        <a href="mahasiswa.php"
           class="hover:text-amber-100 transition-colors <?php echo $current=='mahasiswa.php' ? 'font-bold' : ''; ?>">
           Mahasiswa
        </a>
        <a href="matkul.php"
           class="hover:text-amber-100 transition-colors <?php echo $current=='matkul.php' ? 'font-bold' : ''; ?>">
           Mata Kuliah
        </a>
        <a href="perkuliahan.php"
           class="hover:text-amber-100 transition-colors <?php echo $current=='perkuliahan.php' ? 'font-bold' : ''; ?>">
           Perkuliahan
        </a>
        <a href="/sso/logout.php"
           class="bg-white text-amber-700 px-4 py-2 rounded-lg hover:bg-amber-100 transition-colors font-semibold mt-2 sm:mt-0">
           Logout
        </a>
      </div>      

    </div>
  </div>
</nav>

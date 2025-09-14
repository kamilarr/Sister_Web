<?php
require_once "check_auth.php";
include "config.php";

// ===== CREATE =====
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_matkul'];
    $nama = $_POST['nama_matkul'];
    $sks  = $_POST['sks'];

    $sql = "INSERT INTO matkul (kode_matkul, nama_matkul, sks)
            VALUES ('$kode', '$nama', '$sks')";
    mysqli_query($conn, $sql);
    header("Location: matkul.php");
    exit;
}

// ===== UPDATE =====
if (isset($_POST['update'])) {
    $kode = $_POST['kode_matkul'];
    $nama = $_POST['nama_matkul'];
    $sks  = $_POST['sks'];

    $sql = "UPDATE matkul
            SET nama_matkul='$nama', sks='$sks'
            WHERE kode_matkul='$kode'";
    mysqli_query($conn, $sql);
    header("Location: matkul.php");
    exit;
}

// ===== DELETE =====
if (isset($_GET['hapus'])) {
    $kode = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM matkul WHERE kode_matkul='$kode'");
    header("Location: matkul.php");
    exit;
}

// ===== READ (semua data) =====
$result = mysqli_query($conn, "SELECT * FROM matkul ORDER BY kode_matkul ASC");

// ===== Jika sedang edit, ambil data yang dipilih =====
$editData = null;
if (isset($_GET['edit'])) {
    $kodeEdit = $_GET['edit'];
    $editData = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM matkul WHERE kode_matkul='$kodeEdit'")
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Kuliah - WebB</title>
  <link rel="stylesheet" href="/public/output.css">
</head>
<body class="bg-amber-50">

<?php include "navbar.php"; ?>

<main class="max-w-7xl mx-auto p-8">
  <h1 class="text-3xl font-bold text-amber-800 mb-6">Kelola Mata Kuliah</h1>

  <!-- Form Tambah / Edit -->
  <div class="bg-white p-6 rounded-xl shadow mb-8">
    <h2 class="text-xl font-semibold mb-4">
      <?php echo $editData ? "Edit Mata Kuliah" : "Tambah Mata Kuliah"; ?>
    </h2>

    <form method="post" class="space-y-4">
      <div>
        <label class="block text-amber-800 font-medium">Kode Matkul</label>
        <input type="text" name="kode_matkul" required
               value="<?= $editData['kode_matkul'] ?? '' ?>"
               <?= $editData ? 'readonly class="bg-gray-100 cursor-not-allowed w-full p-2 border border-gray-300 rounded-lg"' :
                                'class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-amber-400"' ?>>
      </div>
      <div>
        <label class="block text-amber-800 font-medium">Nama Matkul</label>
        <input type="text" name="nama_matkul" required
               value="<?= $editData['nama_matkul'] ?? '' ?>"
               class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-amber-400">
      </div>
      <div>
        <label class="block text-amber-800 font-medium">SKS</label>
        <input type="number" name="sks" required
               value="<?= $editData['sks'] ?? '' ?>"
               class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-amber-400">
      </div>

      <?php if ($editData): ?>
        <button type="submit" name="update"
                class="bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
          Update
        </button>
        <a href="matkul.php"
           class="inline-block ml-2 px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 transition-colors">
          Batal
        </a>
      <?php else: ?>
        <button type="submit" name="tambah"
                class="bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
          Tambah
        </button>
      <?php endif; ?>
    </form>
  </div>

  <!-- Tabel Data -->
  <div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Mata Kuliah</h2>
    <table class="w-full border border-gray-300">
      <thead class="bg-amber-700 text-white">
        <tr>
          <th class="py-2 px-4 border">Kode Matkul</th>
          <th class="py-2 px-4 border">Nama Matkul</th>
          <th class="py-2 px-4 border">SKS</th>
          <th class="py-2 px-4 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr class="hover:bg-amber-100">
          <td class="py-2 px-4 border"><?= $row['kode_matkul'] ?></td>
          <td class="py-2 px-4 border"><?= $row['nama_matkul'] ?></td>
          <td class="py-2 px-4 border"><?= $row['sks'] ?></td>
          <td class="py-2 px-4 border text-center space-x-2">
            <a href="matkul.php?edit=<?= urlencode($row['kode_matkul']) ?>"
               class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600 transition">Edit</a>
            <a href="matkul.php?delete=<?= urlencode($row['kode_matkul']) ?>"
               onclick="return confirm('Yakin ingin menghapus?')"
               class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>

</body>
</html>

<?php
require_once "check_auth.php";
include "config.php"; // koneksi ke db_webB

// --- CREATE & UPDATE ---
if (isset($_POST['save'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if (!empty($_POST['nim_edit'])) {
        // UPDATE
        $nim_edit = $_POST['nim_edit'];
        $stmt = $conn->prepare("UPDATE mhs SET nim=?, nama=?, alamat=? WHERE nim=?");
        $stmt->bind_param("ssss", $nim, $nama, $alamat, $nim_edit);
        $stmt->execute();
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO mhs (nim, nama, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nim, $nama, $alamat);
        $stmt->execute();
    }
    header("Location: mahasiswa.php");
    exit;
}

// --- DELETE ---
if (isset($_GET['delete'])) {
    $nim = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM mhs WHERE nim=?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    header("Location: mahasiswa.php");
    exit;
}

// --- Ambil semua data ---
$result = $conn->query("SELECT * FROM mhs ORDER BY nim");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa - WebB</title>
  <link rel="stylesheet" href="/public/output.css">
</head>
<body class="bg-amber-50">

<?php include "navbar.php"; ?>

<main class="max-w-7xl mx-auto p-8">
  <h1 class="text-3xl font-bold text-amber-800 mb-6">Kelola Data Mahasiswa</h1>

  <!-- Form Create/Update -->
  <?php
  $nim_edit = $nama_edit = $alamat_edit = "";
  if (isset($_GET['edit'])) {
      $nim_edit = $_GET['edit'];
      $res = $conn->prepare("SELECT * FROM mhs WHERE nim=?");
      $res->bind_param("s", $nim_edit);
      $res->execute();
      $row = $res->get_result()->fetch_assoc();
      if ($row) {
          $nama_edit = $row['nama'];
          $alamat_edit = $row['alamat'];
      }
  }
  ?>
  <form method="POST" class="bg-white shadow rounded-xl p-6 mb-8">
    <div class="grid md:grid-cols-3 gap-4">
      <div>
        <label class="block text-amber-800 font-semibold mb-1">NIM</label>
        <input type="text" name="nim" value="<?= htmlspecialchars($nim_edit) ?>"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
      </div>
      <div>
        <label class="block text-amber-800 font-semibold mb-1">Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama_edit) ?>"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
      </div>
      <div>
        <label class="block text-amber-800 font-semibold mb-1">Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($alamat_edit) ?>"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
      </div>
    </div>
    <?php if ($nim_edit): ?>
      <input type="hidden" name="nim_edit" value="<?= htmlspecialchars($nim_edit) ?>">
    <?php endif; ?>
    <button type="submit" name="save"
            class="mt-4 bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
      <?= $nim_edit ? 'Update' : 'Tambah' ?> Mahasiswa
    </button>
  </form>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="w-full bg-white rounded-xl shadow">
      <thead class="bg-amber-700 text-white">
        <tr>
          <th class="py-3 px-4 text-left">NIM</th>
          <th class="py-3 px-4 text-left">Nama</th>
          <th class="py-3 px-4 text-left">Alamat</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr class="border-b hover:bg-amber-50">
          <td class="py-2 px-4"><?= htmlspecialchars($row['nim']) ?></td>
          <td class="py-2 px-4"><?= htmlspecialchars($row['nama']) ?></td>
          <td class="py-2 px-4"><?= htmlspecialchars($row['alamat']) ?></td>
          <td class="py-2 px-4 text-center space-x-2">
            <a href="mahasiswa.php?edit=<?= urlencode($row['nim']) ?>"
               class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600 transition">Edit</a>
            <a href="mahasiswa.php?delete=<?= urlencode($row['nim']) ?>"
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

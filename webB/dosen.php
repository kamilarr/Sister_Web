<?php
require_once "check_auth.php";
include "config.php"; // koneksi ke db_webB

// --- CREATE & UPDATE ---
if (isset($_POST['save'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Jika ada hidden input id_edit berarti update
    if (!empty($_POST['nip_edit'])) {
        $nip_edit = $_POST['nip_edit'];
        $stmt = $conn->prepare("UPDATE dosen SET nip=?, nama=?, alamat=? WHERE nip=?");
        $stmt->bind_param("ssss", $nip, $nama, $alamat, $nip_edit);
        $stmt->execute();
    } else {
        // insert baru
        $stmt = $conn->prepare("INSERT INTO dosen (nip, nama, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nip, $nama, $alamat);
        $stmt->execute();
    }
    header("Location: dosen.php");
    exit;
}

// --- DELETE ---
if (isset($_GET['delete'])) {
    $nip = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM dosen WHERE nip=?");
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    header("Location: dosen.php");
    exit;
}

// --- Ambil data semua dosen ---
$result = $conn->query("SELECT * FROM dosen ORDER BY nip");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Dosen - WebB</title>
  <link rel="stylesheet" href="/public/output.css">
</head>
<body class="bg-amber-50">

<?php include "navbar.php"; ?>

<main class="max-w-7xl mx-auto p-8">
  <h1 class="text-3xl font-bold text-amber-800 mb-6">Kelola Data Dosen</h1>

  <!-- Form Create/Update -->
  <?php
  $nip_edit = $nama_edit = $alamat_edit = "";
  if (isset($_GET['edit'])) {
      $nip_edit = $_GET['edit'];
      $res = $conn->prepare("SELECT * FROM dosen WHERE nip=?");
      $res->bind_param("s", $nip_edit);
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
        <label class="block text-amber-800 font-semibold mb-1">NIP</label>
        <input type="text" name="nip" value="<?= htmlspecialchars($nip_edit) ?>"
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
    <?php if ($nip_edit): ?>
      <input type="hidden" name="nip_edit" value="<?= htmlspecialchars($nip_edit) ?>">
    <?php endif; ?>
    <button type="submit" name="save"
            class="mt-4 bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 transition-colors">
      <?= $nip_edit ? 'Update' : 'Tambah' ?> Dosen
    </button>
  </form>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="w-full bg-white rounded-xl shadow">
      <thead class="bg-amber-700 text-white">
        <tr>
          <th class="py-3 px-4 text-left">NIP</th>
          <th class="py-3 px-4 text-left">Nama</th>
          <th class="py-3 px-4 text-left">Alamat</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr class="border-b hover:bg-amber-50">
          <td class="py-2 px-4"><?= htmlspecialchars($row['nip']) ?></td>
          <td class="py-2 px-4"><?= htmlspecialchars($row['nama']) ?></td>
          <td class="py-2 px-4"><?= htmlspecialchars($row['alamat']) ?></td>
          <td class="py-2 px-4 text-center space-x-2">
            <a href="dosen.php?edit=<?= urlencode($row['nip']) ?>"
               class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600 transition">Edit</a>
            <a href="dosen.php?delete=<?= urlencode($row['nip']) ?>"
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

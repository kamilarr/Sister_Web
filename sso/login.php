<?php
session_start();
include "config.php";

$redirect = $_GET['redirect'] ?? ($_POST['redirect'] ?? "webA");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // redirect ke web tujuan
        header("Location: http://localhost:8080/$redirect/");
        exit;
    } else {
        $error = "Login gagal! Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login SSO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white to-amber-50">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 border border-amber-200">
        <h2 class="text-2xl font-bold text-center text-amber-800 mb-6">Login SSO</h2>

        <?php if (!empty($error)) { ?>
            <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 border border-red-300 rounded-lg">
                <?= $error ?>
            </div>
        <?php } ?>

        <form method="POST" class="space-y-5">
            <!-- simpan redirect agar tetap kebawa -->
            <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">

            <div>
                <label class="block text-sm font-medium text-amber-900">Username</label>
                <input type="text" name="username" required
                    class="mt-1 w-full rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 px-4 py-2 bg-amber-50 text-amber-900 placeholder-amber-400" 
                    placeholder="Masukkan username">
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-900">Password</label>
                <input type="password" name="password" required
                    class="mt-1 w-full rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 px-4 py-2 bg-amber-50 text-amber-900 placeholder-amber-400"
                    placeholder="Masukkan password">
            </div>

            <button type="submit"
                class="w-full bg-amber-700 hover:bg-amber-800 text-white font-semibold py-2.5 rounded-lg shadow-md transition duration-300">
                Login
            </button>
        </form>
    </div>
</body>
</html>

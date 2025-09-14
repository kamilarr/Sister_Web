<?php
// webB/check_auth.php
session_start();  // penting: ini akan baca session SSO yang sudah dibuat di /sso/login.php

if (!isset($_SESSION['user_id'])) {
    // Belum login → redirect ke halaman login SSO
    header("Location: /sso/login.php?redirect=webB");
    exit;
}

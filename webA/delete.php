<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM books WHERE buku_id=$id");
}
header("Location: index.php");
exit;
?>

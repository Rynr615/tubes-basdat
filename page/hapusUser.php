<?php
require_once '../db/config.php';
include_once '../function/func_user.php';

if (isset($_GET['ID_User'])) {
    $idUser = $_GET['ID_User'];

    if (hapusUser($conn, $idUser)) {
        echo "<script>alert('Data user berhasil dihapus!'); window.location.href = './user.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data user!'); window.location.href = './user.php';</script>";
    }
} else {
    echo "<script>alert('Data user tidak ditemukan!'); window.location.href = './user.php';</script>";
}
?>

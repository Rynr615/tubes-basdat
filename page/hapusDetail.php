<?php
require_once '../db/config.php';
include_once '../function/func_pegawai.php';

if (isset($_GET['ID'])) {
    $idBagian = $_GET['ID'];

    if (hapusBagian($conn, $idBagian)) {
        echo "<script>alert('Data bagian berhasil dihapus!'); window.location.href = './pegawai.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data bagian! Pastikan tidak ada pegawai yang masih terkait bagian ini.'); window.location.href = './pegawai.php';</script>";
    }
} else {
    echo "<script>alert('ID Bagian tidak ditemukan!'); window.location.href = './pegawai.php';</script>";
}
?>

<?php
require_once '../db/config.php';
include_once '../function/func_dokter.php';

if (isset($_GET['NIP'])) {
    $nip = $_GET['NIP'];

    if (hapusDokter($conn, $nip)) {
        echo "<script>alert('Data dokter berhasil dihapus!'); window.location.href = './dokter.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data dokter!'); window.location.href = './dokter.php';</script>";
    }
} else {
    echo "<script>alert('Data dokter tidak ditemukan!'); window.location.href = './dokter.php';</script>";
}
?>

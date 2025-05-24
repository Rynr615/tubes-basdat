<?php
require_once '../db/config.php';
include_once '../function/func_pegawai.php';

if (isset($_GET['idPegawai'])) {
    $idPegawai = $_GET['idPegawai'];

    if (hapusPegawai($conn, $idPegawai)) {
        echo "<script>alert('Data pegawai berhasil dihapus!'); window.location.href = './pegawai.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data pegawai!'); window.location.href = './pegawai.php';</script>";
    }
} else {
    echo "<script>alert('ID Pegawai tidak ditemukan!'); window.location.href = './pegawai.php';</script>";
}
?>

<?php
require_once '../db/config.php';
require_once '../function/func_produk.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $kodeProduk = $_GET['KodeProduk'] ?? null;

    if ($kodeProduk && delDataProduk($conn, $kodeProduk)) {
        header("Location: ../page/product.php");
        exit;
    } else {
        echo "<script>alert('Data gagal dihapus'); window.location.href = '../page/product.php';</script>";
    }
} else {
    header("Location: ../page/product.php");
    exit;
}

<?php

require_once '../db/config.php';
require_once '../function/func_supplier.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $kodeSupplier = $_GET['KodeSupplier'] ?? null;

    if ($kodeSupplier && delDataSupplier($conn, $kodeSupplier)) {
        header("Location: ../page/supplier.php");
        exit;
    } else {
        echo "<script>alert('Data gagal dihapus'); window.location.href = '../page/supplier.php';</script>";
    }
} else {
    header("Location: ../page/supplier.php");
    exit;
}

?>
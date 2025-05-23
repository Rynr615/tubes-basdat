<?php

include "../db/config.php";

// ============ SUPPLIER ==================
function showDataSupplier() {
    global $conn;
    $sql = "SELECT * FROM supplier";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

// ================= tambah data supplier ======================
function insertDataSupplier($conn, $kodeSupplier, $nama, $noHP, $alamat) {
    $query = "INSERT INTO supplier (KodeSupplier, Nama, NoHP, Alamat) 
                VALUES ('$kodeSupplier', '$nama', '$noHP', '$alamat')";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insert') {
    $kodeSupplier = $_POST['kodeSupplier'];
    $namaSupplier = $_POST['namaSupplier'];
    $noHP = $_POST['NoHP'];
    $alamat = $_POST['Alamat'];

    if (insertDataSupplier($conn, $kodeSupplier, $namaSupplier, $noHP, $alamat)) {
        header("Location: ../page/supplier.php");
        exit;
    } else {
        echo "Gagal menambahkan supplier!";
    }
}

// ====================== edit data supplier ========================
function editDataSupplier($conn, $kodeSupplier, $nama, $noHP, $alamat) {
    $query = "UPDATE supplier SET 
                Nama = '$nama',
                NoHP = '$noHP',
                Alamat = '$alamat'
                WHERE KodeSupplier = '$kodeSupplier'";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    if (isset($_POST['kodeSupplier'])) {
        $kodeSupplier = $_POST['kodeSupplier'];
        $nama = $_POST['namaSupplier'];
        $noHP = $_POST['NoHP'];
        $alamat = $_POST['Alamat'];

        if (editDataSupplier($conn, $kodeSupplier, $nama, $noHP, $alamat)) {
            header("Location: ../page/supplier.php");
            exit;
        } else {
            echo "<script>alert('Gagal mengedit data supplier!');</script>";
        }
    }
}

// =================== delete data supplier ==========================
function delDataSupplier($conn, $kodeSupplier) {
    $query = "DELETE FROM supplier WHERE KodeSupplier='$kodeSupplier'";
    return mysqli_query($conn, $query);
}

?>
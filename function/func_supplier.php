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

function generateKodeSupplier($conn) {
    $query = "SELECT MAX(KodeSupplier) AS maxKode FROM supplier";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $lastKode = $data['maxKode'] ?? 'SUP0000';
    $number = (int)substr($lastKode, 3) + 1;
    $newKode = 'SUP' . str_pad($number, 4, '0', STR_PAD_LEFT);

    return $newKode;
}


// ================= tambah data supplier ======================
function insertSupplier($conn, $nama, $nohp, $alamat) {
    $kode = generateKodeSupplier($conn);
    $query = "INSERT INTO supplier (KodeSupplier, Nama, NoHP, Alamat) 
                VALUES ('$kode', '$nama', '$nohp', '$alamat')";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insert') {
    $nama = $_POST['namaSupplier'];
    $nohp = $_POST['NoHP'];
    $alamat = $_POST['Alamat'];

    if (insertSupplier($conn, $nama, $nohp, $alamat)) {
        echo "<script>alert('Data supplier berhasil ditambahkan!'); window.location.href = '../page/supplier.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan supplier!'); window.history.back();</script>";
    }
    exit;
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
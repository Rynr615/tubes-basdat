<?php
include "../db/config.php";

// Produk
function showDataProduk() {
    global $conn;
    $sql = "SELECT * FROM produk";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

// ================= tambah produk ================
function insertDataProduk($conn, $kodeProduk, $nama, $jenis, $harga, $fungsi, $stok, $expired, $kodeSupplier) {
    $query = "INSERT INTO produk (KodeProduk, Nama, Jenis, Harga, Fungsi, Stok, Expired, KodeSupplier) VALUES ('$kodeProduk', '$nama', '$jenis', '$harga', '$fungsi', '$stok', '$expired', '$kodeSupplier')";
    return mysqli_query($conn, $query);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'insert') {
    $kodeProduk = $_POST['kodeProduk'];
    $nama = $_POST['namaProduk'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $fungsi = $_POST['fungsi'];
    $stok = $_POST['stok'];
    $expired = $_POST['expired'];
    $kodeSupplier = $_POST['kodeSupplier'];

    if(insertDataProduk($conn, $kodeProduk, $nama, $jenis, $harga, $fungsi, $stok, $expired, $kodeSupplier)) {
        header("Location: ../page/product.php");
        exit;
    } else {
        echo "Data gagal ditambahkan";
    }
}

// ================= edit produk ==================
function editDataProduct($conn, $KodeProduk, $Nama, $Jenis, $Harga, $Fungsi, $Stok, $Expired, $kodeSupplier) {
    $query = "UPDATE produk 
                SET Nama = '$Nama', 
                    Jenis = '$Jenis', 
                    Harga = '$Harga', 
                    Fungsi = '$Fungsi', 
                    Stok = '$Stok', 
                    Expired = '$Expired', 
                    KodeSupplier = '$kodeSupplier' 
                WHERE KodeProduk = '$KodeProduk'";
    
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'edit') {
    $kodeProduk = $_POST['kodeProduk'];
    $nama = $_POST['namaProduk'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $fungsi = $_POST['fungsi'];
    $stok = $_POST['stok'];
    $expired = $_POST['expired'];
    $kodeSupplier = $_POST['kodeSupplier'];

    if (editDataProduct($conn, $kodeProduk, $nama, $jenis, $harga, $fungsi, $stok, $expired, $kodeSupplier)) {
        header("Location: ../page/product.php");
        exit;
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
    }
}

function delDataProduk($conn, $kodeProduk) {
    $query = "DELETE FROM produk WHERE KodeProduk='$kodeProduk'";
    return mysqli_query($conn, $query);
}

function showDataUser() {
    global $conn;

    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}
?>
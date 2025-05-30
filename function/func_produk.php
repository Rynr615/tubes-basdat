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

function showSupplier() {
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

function generateNoProduk($conn, $jenis) {
    $prefix = '';
    
    if ($jenis == "Obat") {
        $prefix = 'O';
    } else if ($jenis == "BHP") {
        $prefix = 'B';
    } else {
        return null;
    }

    $query = "SELECT KodeProduk FROM produk WHERE KodeProduk LIKE '{$prefix}%' ORDER BY KodeProduk DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $lastKode = mysqli_fetch_assoc($result)['KodeProduk'] ?? null;

    if ($lastKode) {
        $angka = (int)substr($lastKode, 1);
        $angka++;
    } else {
        $angka = 1;
    }

    return $prefix . str_pad($angka, 4, '0', STR_PAD_LEFT);
}



// ================= tambah produk ================
function insertDataProduk($conn, $kodeProduk, $nama, $jenis, $harga, $fungsi, $stok, $expired, $kodeSupplier) {
    $query = "INSERT INTO produk (KodeProduk, Nama, Jenis, Harga, Fungsi, Stok, Expired, KodeSupplier) VALUES ('$kodeProduk', '$nama', '$jenis', '$harga', '$fungsi', '$stok', '$expired', '$kodeSupplier')";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'insert') {
    $nama = $_POST['namaProduk'];
    $jenis = $_POST['jenis'];
    $kodeProduk = generateNoProduk($conn, $jenis);
    $harga = $_POST['harga'];
    $fungsi = $_POST['fungsi'];
    $stok = $_POST['stok'];
    $expired = $_POST['expired'];
    $kodeSupplier = $_POST['kodeSupplier'];

    echo "$kodeProduk";

    if (insertDataProduk($conn, $kodeProduk, $nama, $jenis, $harga, $fungsi, $stok, $expired, $kodeSupplier)) {
        header("Location: ../page/product.php");
        exit;
    } else {
        echo "Data gagal ditambahkan: " . mysqli_error($conn);
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
?>
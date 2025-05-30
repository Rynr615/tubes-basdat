<?php

include "../db/config.php"; 

function showDataPembelianOnline() {
    global $conn;
    $sql = "SELECT * FROM pembelianonline ORDER BY idPembelian DESC";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

function getAllProduk() {
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

function getAllUser() {
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

function getKurir() {
    global $conn;
    $sql = "SELECT * FROM pegawai WHERE IDbagian = 'BD002'";
    $result = $conn->query($sql);
    $data = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;

}

function getInfoHeaderPembelianOnline($idPembelian) {
    global $conn;
    $query = "SELECT * FROM pembelianonline WHERE idPembelian = '$idPembelian'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function showDetailPembelianOnline($idPembelian) {
    global $conn;
    $query = "SELECT d.kodeProduk, p.Nama AS nama, d.jumlahProduk, d.subTotal
                FROM detailpembelianonline d
                JOIN produk p ON d.kodeProduk = p.KodeProduk
                WHERE d.idPembelian = '$idPembelian'";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function generateResiCode($conn) {
    $query = "SELECT Resi FROM delivery WHERE Resi LIKE 'RSI%' ORDER BY Resi DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $lastResi = $row['Resi'];
        $number = (int) substr($lastResi, 3);
        $nextNumber = $number + 1;
        return 'RSI' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    } else {
        return 'RSI00001';
    }
}

function insertPembelianOnline($conn, $idUser , $idPegawai, $tglPembelian, $jenisPembayaran, $kodeProdukArr, $jumlahArr) {
    $totalHarga = 0;
    $subTotals = [];

    foreach ($kodeProdukArr as $i => $kodeProduk) {
        $jumlah = (int)$jumlahArr[$i];

        // Cek stok dulu
        $produkQuery = mysqli_query($conn, "SELECT Harga, Stok FROM produk WHERE KodeProduk = '$kodeProduk'");
        if (!$produkQuery || mysqli_num_rows($produkQuery) == 0) {
            return false;
        }
        $produk = mysqli_fetch_assoc($produkQuery);
        $harga = $produk['Harga'];
        $stok = $produk['Stok'];

        if ($jumlah > $stok) {
            echo "<script>alert('Stok untuk produk $kodeProduk tidak mencukupi!'); window.history.back();</script>";
            exit;
        }

        $subTotal = $jumlah * $harga;
        $totalHarga += $subTotal;
        $subTotals[] = ['kodeProduk' => $kodeProduk, 'jumlah' => $jumlah, 'subTotal' => $subTotal];
    }

    $insertPembelian = "INSERT INTO pembelianonline (idUser , tglPembelian, jenisPembayaran, totalHarga)
                        VALUES ('$idUser', '$tglPembelian', '$jenisPembayaran', '$totalHarga')";
    if (!mysqli_query($conn, $insertPembelian)) {
        return false;
    }

    $idPembelian = mysqli_insert_id($conn);

    foreach ($subTotals as $item) {
        $kodeProduk = $item['kodeProduk'];
        $jumlah = $item['jumlah'];
        $subTotal = $item['subTotal'];

        $query = "INSERT INTO detailpembelianonline (idPembelian, kodeProduk, jumlahProduk, subTotal)
                    VALUES ('$idPembelian', '$kodeProduk', $jumlah, $subTotal)";
        if (!mysqli_query($conn, $query)) {
            return false;
        }

        $updateStok = "UPDATE produk SET Stok = Stok - $jumlah WHERE KodeProduk = '$kodeProduk'";
        if (!mysqli_query($conn, $updateStok)) {
            return false;
        }
    }

    $resi = generateResiCode($conn);
    $insertDelivery = "INSERT INTO delivery (Resi, idPembelian, idPegawai)
                        VALUES ('$resi', '$idPembelian', '$idPegawai')";
    if (!mysqli_query($conn, $insertDelivery)) {
        return false;
    }

    return true;
}

?>
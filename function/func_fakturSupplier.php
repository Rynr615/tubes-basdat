<?php

include "../db/config.php"; 

function showFakturSupplier() {
    global $conn;

    $query = "SELECT * FROM faktursupplier";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function getInfoHeaderFakturSupplier($noFaktur) {
    global $conn;
    $query = "SELECT * FROM faktursupplier WHERE NoFaktur = '$noFaktur'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function showDetailFakturSupplier($noFaktur) {
    global $conn;
    $query = "SELECT d.KodeProduk, p.Nama AS NamaProduk, d.Jumlah, d.SubTotal
                FROM detailfaktursupplier d
                JOIN produk p ON d.KodeProduk = p.KodeProduk
                WHERE d.NoFaktur = '$noFaktur'";
    
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function getAllSupplier() {
    global $conn;
    $query = "SELECT * FROM supplier";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function getAllProduk() {
    global $conn;
    $query = "SELECT * FROM produk";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function generateNoFaktur($conn) {
    $query = "SELECT NoFaktur FROM faktursupplier ORDER BY NoFaktur DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $lastKode = mysqli_fetch_assoc($result)['NoFaktur'] ?? null;

    if ($lastKode) {
        $angka = (int)substr($lastKode, 2);
        $angka++;
    } else {
        $angka = 1;
    }

    return 'FS' . str_pad($angka, 3, '0', STR_PAD_LEFT);
}

function produkSesuaiSupplier($conn, $kodeSupplier, $produkArr) {
    foreach ($produkArr as $kodeProduk) {
        $result = mysqli_query($conn, "SELECT KodeSupplier FROM produk WHERE KodeProduk = '$kodeProduk'");
        $row = mysqli_fetch_assoc($result);

        if (!$row || $row['KodeSupplier'] !== $kodeSupplier) {
            return false;
        }
    }
    return true;
}


function getDetailProdukFromKode($conn, $produkArr) {
    $totalPembayaran = 0;
    $detailData = [];

    foreach ($produkArr as $kodeProduk) {
        $cekProduk = mysqli_query($conn, "SELECT Stok, Harga FROM produk WHERE KodeProduk = '$kodeProduk'");

        if (mysqli_num_rows($cekProduk) > 0) {
            $produk = mysqli_fetch_assoc($cekProduk);
            $jumlah = (int)$produk['Stok'];
            $harga = (int)$produk['Harga'];
            $subTotal = $jumlah * $harga;

            $totalPembayaran += $subTotal;

            $detailData[] = [
                'kodeProduk' => $kodeProduk,
                'jumlah' => $jumlah,
                'subTotal' => $subTotal
            ];
        }
    }

    return ['total' => $totalPembayaran, 'detail' => $detailData];
}

function simpanFakturSupplier($conn, $kodeSupplier, $tanggal, $totalPembayaran, $detailData) {
    if (count($detailData) === 0) {
        echo "<script>alert('Tidak ada produk valid yang ditemukan. Pastikan KodeProduk sesuai dengan yang tersedia.');</script>";
        return;
    }

    $noFaktur = generateNoFaktur($conn);
    if (!$noFaktur) {
        echo "<script>alert('Gagal menghasilkan No Faktur.');</script>";
        return;
    }

    $queryFaktur = "INSERT INTO faktursupplier (NoFaktur, Tanggal, KodeSupplier, TotalPembayaran)
                    VALUES ('$noFaktur', '$tanggal', '$kodeSupplier', '$totalPembayaran')";
    
    $resultFaktur = mysqli_query($conn, $queryFaktur);
    
    if (!$resultFaktur) {
        echo "<script>alert('Gagal menambahkan data faktur: " . mysqli_error($conn) . "');</script>";
        return;
    }

    foreach ($detailData as $item) {
        mysqli_query($conn, "INSERT INTO detailfaktursupplier (NoFaktur, KodeProduk, Jumlah, SubTotal)
                                VALUES ('$noFaktur', '{$item['kodeProduk']}', {$item['jumlah']}, {$item['subTotal']})");
    }

    echo "<script>alert('Faktur berhasil ditambahkan!'); window.location.href = 'fakturSupplier.php';</script>";
    exit;
}


?>
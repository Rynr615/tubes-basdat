<?php

include "../db/config.php"; 

function showDataHeaderPembelianOffline() {
    global $conn;
    $query = "SELECT * FROM pembelianoffline ORDER BY NoTransaksi ASC";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function getInfoHeaderPembelian($noTransaksi) {
    global $conn;

    $query = "SELECT 
    po.NoTransaksi,
    po.idPegawai,
    po.tglPembelian,
    po.jenisPembayaran,
    po.totalHarga,
    p.nama as namaPegawai,
    bd.bagian
FROM pembelianoffline po
LEFT JOIN pegawai p ON po.idPegawai = p.idPegawai
LEFT JOIN bagiandetail bd ON p.IDbagian = bd.ID
WHERE po.NoTransaksi = '$noTransaksi'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}


function showDetailPembelianOffline($noTransaksi) {
    global $conn;

    $query = "SELECT 
    dpo.kodeProduk,
    dpo.jumlahProduk,
    dpo.subTotal,
    pr.Nama as nama,
    pr.Jenis,
    pr.Harga
FROM detailpembelianoffline dpo
LEFT JOIN produk pr ON dpo.kodeProduk = pr.KodeProduk
WHERE dpo.NoTransaksi = '$noTransaksi'
ORDER BY dpo.idDetail";

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
    return mysqli_query($conn, $query)->fetch_all(MYSQLI_ASSOC);
}

function getAllPegawai() {
    global $conn;
    $query = "SELECT * FROM pegawai";
    return mysqli_query($conn, $query)->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insertPembelian') {
    $idPegawai = $_POST['idPegawai'];
    $tgl = $_POST['tglPembelian'];
    $jenis = $_POST['jenisPembayaran'];

    $kodeProdukArr = $_POST['kodeProduk'];
    $jumlahArr = $_POST['jumlahProduk'];
    $totalHarga = 0;

    // Hitung subtotal dan total
    $subTotals = [];
    foreach ($kodeProdukArr as $i => $kodeProduk) {
        $jumlah = (int)$jumlahArr[$i];
        $hargaQuery = mysqli_query($conn, "SELECT Harga FROM produk WHERE KodeProduk = '$kodeProduk'");
        $harga = mysqli_fetch_assoc($hargaQuery)['Harga'];
        $subTotal = $jumlah * $harga;
        $totalHarga += $subTotal;
        $subTotals[] = [
            'kodeProduk' => $kodeProduk,
            'jumlah' => $jumlah,
            'subTotal' => $subTotal
        ];
    }

    // Insert ke pembelianoffline (NoTransaksi auto)
    $insertPembelian = "INSERT INTO pembelianoffline (idPegawai, tglPembelian, jenisPembayaran, totalHarga)
                        VALUES ('$idPegawai', '$tgl', '$jenis', '$totalHarga')";
    mysqli_query($conn, $insertPembelian);

    // Ambil NoTransaksi yang baru saja di-generate
    $noTransaksi = mysqli_insert_id($conn);

    // Insert ke detailpembelianoffline
    foreach ($subTotals as $item) {
        mysqli_query($conn, "INSERT INTO detailpembelianoffline (NoTransaksi, kodeProduk, jumlahProduk, subTotal)
                                VALUES ('$noTransaksi', '{$item['kodeProduk']}', {$item['jumlah']}, {$item['subTotal']})");
    }

    echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href = '../page/pembelianOffline.php';</script>";
    exit;
}




?>
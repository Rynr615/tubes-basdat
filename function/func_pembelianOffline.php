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

    $subTotals = [];

    foreach ($kodeProdukArr as $i => $kodeProduk) {
        $jumlah = (int)$jumlahArr[$i];
        $produkQuery = mysqli_query($conn, "SELECT Harga, Stok FROM produk WHERE KodeProduk = '$kodeProduk'");
        $produkData = mysqli_fetch_assoc($produkQuery);

        if (!$produkData) {
            echo "<script>alert('Produk dengan kode $kodeProduk tidak ditemukan!'); window.history.back();</script>";
            exit;
        }

        $harga = $produkData['Harga'];
        $stokTersedia = $produkData['Stok'];

        if ($jumlah > $stokTersedia) {
            echo "<script>alert('Stok untuk produk $kodeProduk tidak mencukupi!'); window.history.back();</script>";
            exit;
        }

        $subTotal = $jumlah * $harga;
        $totalHarga += $subTotal;

        $subTotals[] = [
            'kodeProduk' => $kodeProduk,
            'jumlah' => $jumlah,
            'subTotal' => $subTotal
        ];
    }

    $insertPembelian = "INSERT INTO pembelianoffline (idPegawai, tglPembelian, jenisPembayaran, totalHarga)
                        VALUES ('$idPegawai', '$tgl', '$jenis', '$totalHarga')";
    mysqli_query($conn, $insertPembelian);

    $noTransaksi = mysqli_insert_id($conn);

    foreach ($subTotals as $item) {
        mysqli_query($conn, "INSERT INTO detailpembelianoffline (NoTransaksi, kodeProduk, jumlahProduk, subTotal)
                                VALUES ('$noTransaksi', '{$item['kodeProduk']}', {$item['jumlah']}, {$item['subTotal']})");

        mysqli_query($conn, "UPDATE produk 
                                SET Stok = Stok - {$item['jumlah']} 
                                WHERE KodeProduk = '{$item['kodeProduk']}'");
    }

    echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href = '../page/pembelianOffline.php';</script>";
    exit;
}

?>
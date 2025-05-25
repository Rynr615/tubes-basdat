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


?>
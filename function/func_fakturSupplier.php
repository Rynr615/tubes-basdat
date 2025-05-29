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

?>
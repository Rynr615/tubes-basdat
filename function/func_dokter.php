<?php

include "../db/config.php"; 

function showData() {
    global $conn;

    $query = "SELECT * FROM dokter";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function insertDokter($conn, $nip, $nama, $jenisKelamin, $spesialis, $noHp, $alamat) {
    global $conn;

    $query = "INSERT INTO dokter(NIP, Nama, JenisKelamin, Spesialis, NoHp, alamat) VALUES ('$nip', '$nama', '$jenisKelamin', '$spesialis', '$noHp', '$alamat')";
    return mysqli_query($conn, $query);
}

?>
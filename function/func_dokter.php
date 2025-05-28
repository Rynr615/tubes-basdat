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

function updateDokter($conn, $nipLama, $nipBaru, $nama, $jenisKelamin, $spesialis, $noHp, $alamat) {
    $query = "UPDATE dokter SET 
        NIP = '$nipBaru',
        Nama = '$nama',
        JenisKelamin = '$jenisKelamin',
        Spesialis = '$spesialis',
        NoHp = '$noHp',
        Alamat = '$alamat' 
        WHERE NIP = '$nipLama'";
    return mysqli_query($conn, $query);
}

function hapusDokter($conn, $nip) {
    $sql = "DELETE FROM dokter WHERE NIP = '$nip'";
    return mysqli_query($conn, $sql);
}

?>
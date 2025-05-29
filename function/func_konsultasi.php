<?php

include "../db/config.php"; 

function showData() {
    global $conn;
    $query = " SELECT 
            k.No_Konsultasi,
            k.Keluhan_Pasien,
            u.ID_User,
            u.Username AS NamaUser,
            d.NIP,
            d.Nama AS NamaDokter,
            d.Spesialis
        FROM konsultasi k
        JOIN user u ON k.ID_User = u.ID_User
        JOIN dokter d ON k.NIP = d.NIP
        ORDER BY k.No_Konsultasi DESC
    ";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}


function showDataDokter() {
    global $conn;
    $query = "SELECT * FROM dokter";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function showDataUser() {
    global $conn;
    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function insertKonsultasi($conn, $idUser, $nip, $keluhan) {
    $query = "INSERT INTO `konsultasi`(`ID_User`, `NIP`, `Keluhan_Pasien`) VALUES ('$idUser','$nip','$keluhan')";
    return mysqli_query($conn, $query);
}

function updateKeluhan($conn, $No_Konsultasi, $nip, $ID_User, $Keluhan_Pasien) {
    $query = "UPDATE `konsultasi` SET `NIP`='$nip',`Keluhan_Pasien`='$Keluhan_Pasien' WHERE No_Konsultasi = '$No_Konsultasi' AND ID_User = '$ID_User'";
    return mysqli_query($conn, $query);
}

?>
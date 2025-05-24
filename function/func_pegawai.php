<?php

include "../db/config.php"; 

function showDataPegawai() {
    global $conn;
    $sql = "SELECT * FROM pegawai";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

function showDetailPegawai() {
    global $conn;
    $sql = "SELECT * FROM bagiandetail";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;   
}

function generateIdPegawai($conn) {
    $query = "SELECT idPegawai FROM pegawai ORDER BY idPegawai DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $lastId = $row['idPegawai'];
        $number = (int) substr($lastId, 2);
        $nextNumber = $number + 1;
        return 'PG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    } else {
        return 'PG001';
    }
}

function generateBagianID($conn) {
    $query = "SELECT MAX(ID) as maxID FROM bagiandetail";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    $lastID = $data['maxID'] ?? 'BD000';
    $number = (int)substr($lastID, 2) + 1;
    $newID = 'BD' . str_pad($number, 3, '0', STR_PAD_LEFT);
    
    return $newID;
}


function insertPegawai($conn, $idPegawai, $nama, $tglLahir, $usia, $noHp, $idBagian, $alamat, $jenisKelamin) {
    $query = "INSERT INTO pegawai (idPegawai, nama, tglLahir, usia, noHp, IDbagian, alamat, jenisKelamin) 
                VALUES ('$idPegawai', '$nama', '$tglLahir', $usia, '$noHp', '$idBagian', '$alamat', '$jenisKelamin')";
    return mysqli_query($conn, $query);
}

function insertBagian($conn, $id, $bagian) {
    $query = "INSERT INTO bagiandetail (ID, bagian) VALUES ('$id', '$bagian')";
    return mysqli_query($conn, $query);
}

function getPegawaiById($conn, $id) {
    $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE idPegawai = '$id'");
    return mysqli_fetch_assoc($result);
}

function updatePegawai($conn, $id, $nama, $tglLahir, $usia, $noHp, $idBagian, $alamat, $jenisKelamin) {
    $sql = "UPDATE pegawai SET 
            nama = '$nama',
            tglLahir = '$tglLahir',
            usia = '$usia',
            noHp = '$noHp',
            IDbagian = '$idBagian',
            alamat = '$alamat',
            jenisKelamin = '$jenisKelamin'
            WHERE idPegawai = '$id'";
    return mysqli_query($conn, $sql);
}

function getBagianById($conn, $id) {
    $result = mysqli_query($conn, "SELECT * FROM bagiandetail WHERE ID = '$id'");
    return mysqli_fetch_assoc($result);
}

function updateBagian($conn, $id, $namaBagian) {
    $sql = "UPDATE bagiandetail SET bagian = '$namaBagian' WHERE ID = '$id'";
    return mysqli_query($conn, $sql);
}
?>
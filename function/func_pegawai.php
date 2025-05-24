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



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'tambahPegawai') {
        $idPegawai = generateIdPegawai($conn);
        $nama = $_POST['nama'];
        $tglLahir = $_POST['tglLahir'];
        $usia = $_POST['usia'];
        $noHp = $_POST['noHp'];
        $idBagian = $_POST['IDbagian'];
        $alamat = $_POST['alamat'];
        $jenisKelamin = $_POST['jenisKelamin'];

        if (insertPegawai($conn, $idPegawai, $nama, $tglLahir, $usia, $noHp, $idBagian, $alamat, $jenisKelamin)) {
            echo "<script>alert('Pegawai berhasil ditambahkan!'); window.location.href = './pegawai.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan pegawai!');</script>";
        }
    } elseif ($action == 'tambahBagian') {
        $bagian = $_POST['bagian'];
        $id = generateBagianID($conn);

        if (insertBagian($conn, $id, $bagian)) {
            echo "<script>alert('Bagian berhasil ditambahkan!'); window.location.href = './pegawai.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan bagian!');</script>";
        }
    }
}
?>
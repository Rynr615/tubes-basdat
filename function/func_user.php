<?php

include "../db/config.php";

function showDataUser() {
    global $conn;

    $sql = "SELECT * FROM user ORDER BY ID_User DESC";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

function insertUser($conn, $idUser, $email, $username, $password, $jenisKelamin, $alamat, $noHp) {
    global $conn;
    
    $query = "INSERT INTO `user`(`ID_User`, `Email`, `Username`, `Password`, `JenisKelamin`, `Alamat`, `NoHP`) VALUES ('$idUser','$email','$username','$password','$jenisKelamin','$alamat','$noHp')";
    return mysqli_query($conn, $query);
}

?>
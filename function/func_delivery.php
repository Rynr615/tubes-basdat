<?php

include "../db/config.php"; 

function showData() {
    global $conn;

    $query = "SELECT 
    d.Resi,
    d.idPembelian,
    u.username AS username_pembeli,
    p.nama AS nama_kurir
FROM 
    delivery d
LEFT JOIN 
    pembelianonline po ON d.idPembelian = po.idPembelian
LEFT JOIN 
    user u ON po.idUser = u.ID_User
LEFT JOIN 
    pegawai p ON d.idPegawai = p.idPegawai;";
    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

?>
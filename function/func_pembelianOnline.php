<?php

include "../db/config.php"; 

function showDataPembelianOnline() {
    global $conn;
    $sql = "SELECT * FROM pembelianonline";
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

?>
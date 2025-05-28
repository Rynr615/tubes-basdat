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

?>
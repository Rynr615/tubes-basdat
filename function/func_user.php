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

?>
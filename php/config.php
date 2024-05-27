<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "my_ivanlin5g";

    $conn = new mysqli($host, $user, $pass, $db);
    if($conn === false) {
        die("Error:". $conn->connect_error);
    }
?>
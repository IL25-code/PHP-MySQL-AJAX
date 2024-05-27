<?php
    require_once('config.php');

    $id = $conn->real_escape_string($_POST['id']);
    $email = $conn->real_escape_string($_POST['email']);
    
    $sql = "UPDATE persone SET email = '$email' WHERE id = '$id'";

    if($conn->query($sql) === true){
        $data = [
            "messaggio" => "Riga modificata con successo",
            "response" => 1
        ];
        echo json_encode($data);
    }else{
        $data = [
            "messaggio" => "Errore durante la modifica della riga",
            "response" => 0
        ];
        echo json_encode($data);
    }
?>
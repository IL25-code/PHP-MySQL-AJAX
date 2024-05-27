<?php
    require_once('config.php');

    $nome = $conn->real_escape_string($_POST['nome']);
    $cognome = $conn->real_escape_string($_POST['cognome']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO persone (nome, cognome, email) VALUES ('$nome','$cognome','$email')";

    if($conn->query($sql) === true){
        $data = [
            "messaggio" => "Riga inserita con successo",
            "response" => 1
        ];
        echo json_encode($data);
    }else{
        $data = [
            "messaggio" => "Errore nell'inserimento della riga",
            "response" => 0
        ];
        echo json_encode($data);
    }
?>
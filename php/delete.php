<?php
    require_once('config.php');

    $id = $conn->real_escape_string($_POST['id']);

    $sql = "DELETE FROM persone WHERE id = '$id'";

    //Aggiunta di Ivan
    $conn->query("ALTER TABLE persone AUTO_INCREMENT=0");


    if($conn->query($sql) === true){
        $data = [
            "messaggio" => "Riga eliminata con successo",
            "response" => 1
        ];
        echo json_encode($data);
    }else{
        $data = [
            "messaggio" => "Errore durante l'eliminazione della riga",
            "response" => 0
        ];
        echo json_encode($data);
    }
?>
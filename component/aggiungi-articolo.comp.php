<?php

    require "include/auth.inc.php";
    
    $connect = new PDO("mysql:host=localhost;dbname=gamestop", "root", "");
    
    if($autenticazione){

        $body = new Template("dtml/aggiungi-articolo.html");

        for($i=2000; $i < 2022; $i++){
            $body -> setContent("Anno",$i);
            $body -> setContent("Anno_value",$i);
        }
        $body -> setContent("selected","selected");



      

        if( isset($_GET['Error']) ){

            if( $_GET['Error'] == "campo_vuoto")
                $body -> setContent("Messaggio_errore", "Registrazione del nuovo indirizzo fallita: inserire tutti i campi richiesti.");
        }
    }
    else header("Location: errore.php");



?>
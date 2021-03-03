<?php

    require "include/auth.inc.php";
     
    if($autenticazione){

        $body = new Template("dtml/aggiungi-immagini.html");

        if( isset($_GET['Error']) ){

            if( $_GET['Error'] == "no_file")
                $body -> setContent("Messaggio_errore", "Prima di proseguire, carica le immagini dell'articolo.");
        }
    }
    else header("Location: errore.php");



?>
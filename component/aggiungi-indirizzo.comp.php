<?php

    require "include/auth.inc.php";

    if($autenticazione){

        $body = new Template("dtml/aggiungi-indirizzo.html");

      

        if( isset($_GET['Error']) ){

            if( $_GET['Error'] == "campo_vuoto")
                $body -> setContent("Messaggio_errore", "Registrazione del nuovo indirizzo fallita: inserire tutti i campi richiesti.");
        }
    }
    else header("Location: errore.php");


?>
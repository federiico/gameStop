<?php

    require "include/auth.inc.php";

    if($autenticazione){

        $body = new Template("dtml/my-account.html");

        //------INIZIO DETTAGLI UTENTE-------
        $body -> setContent("Nome",$_SESSION['Nome']);
        $body -> setContent("Cognome",$_SESSION['Cognome']);
        $body -> setContent("Telefono",$_SESSION['Telefono']);
        $body -> setContent("Email",$_SESSION['Email']);
        $body -> setContent("Password",$_SESSION['Password']);
        //------FINE DETTAGLI UTENTE---------


    }
    else header("Location: errore.php");




?>
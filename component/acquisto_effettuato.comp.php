<?php

    require "include/auth.inc.php";
    
    if($autenticazione){

        $body = new Template("dtml/acquisto_effettuato.html");
        
    }
    else header("Location: errore.php");




?>
<?php

    $body = new Template("dtml/login.html"); 

    if( isset($_GET['Errore']) ){
            
        if($_GET['Errore'] == "campo_vuoto")
           $body -> setContent("Messaggio_errore","Autenticazione fallita: inserire tutti i campi richiesti.");
        else 
            if($_GET['Errore'] == "credenziali_errate")
                $body -> setContent("Messaggio_errore", "Autenticazione fallita: email e/o password errati.");
    }


?>
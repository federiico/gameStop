<?php
    $body = new Template("dtml/registrazione.html");

    if( isset($_GET['error'])){

        if($_GET['error'] == "campo_vuoto")
            $body -> setContent("Messaggio_errore","Registrazione fallita: inserire tutti i campi richiesti.");
        else 
            if($_GET['error'] == "query_error")
                $body -> setContent("Messaggio_errore","Siamo spiacenti, la registrazione non è andata a buon fine.");
        
    }
?>
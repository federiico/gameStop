<?php

    require "include/auth.inc.php";

    if($autenticazione){

        $body = new Template("dtml/aggiungi-modalita.html");

        if( isset($_GET['Error']) ){
            if( $_GET['Error'] == "query_error")
                $body -> setContent("Messaggio_errore","Siamo spiacenti, qualcosa è andato storto. Riprovi.");
            else if( $_GET['Error'] == "campo_vuoto")
                    $body -> setContent("Messaggio_errore","Inserimento fallito: inserire tutti i campi richiesti.");
        }

        $body -> setContent("Circuito","Mastercard");
        $body -> setContent("Circuito_value","Mastercard");

        $body -> setContent("Circuito","Visa");
        $body -> setContent("Circuito_value","Visa");


        for($i=1; $i <= 12; $i++){
            $body -> setContent("Mese",$i);
            $body -> setContent("Mese_value",$i);
        }
        for($i=2021; $i <= 2030; $i++){
            $body -> setContent("Anno",$i);
            $body -> setContent("Anno_value",$i);
        }
    }


?>
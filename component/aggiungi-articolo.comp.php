<?php

    require "include/auth.inc.php";
     
    if($autenticazione){

        $body = new Template("dtml/aggiungi-articolo.html");

        for($i=2000; $i < 2022; $i++){
            $body -> setContent("Anno",$i);
            $body -> setContent("Anno_value",$i);
        }
        $body -> setContent("selected","selected");

        if(isset($_GET['Error'])){

           // if( $_GET['Error'] == "query")
             //   $body -> setContent("Messaggio_errore","Ops, qualcosa è andato storto. Per favore riprova.");
            //else if( $_GET['Error'] == "campo_vuoto")
                     $body -> setContent("Messaggio_errore",$_GET['Error']);

        }

    }
    else header("Location: errore.php");



?>
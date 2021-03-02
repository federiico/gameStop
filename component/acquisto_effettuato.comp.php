<?php

    require "include/auth.inc.php";
    session_start();

    $nome=$_GET["nome"];
    $cognome=$_GET["cognome"];
    $indirizzo=$_GET["indirizzo"];
    $carta=$_GET["carta"];
    $sped=$_GET["sped"];
    $data = date ("Y-m-d");
    $prezzo=0;
    $numero = rand(0,1000);

    if( $nome == "" || $cognome== "" || $carta=="" || $sped=="") header("Location:cassa.php?errore=1");
    else{

        $body = new Template("dtml/acquisto_effettuato.html");
        
        foreach ($_SESSION['Carrello'] as &$Carrello) {

            $query_info ="SELECT * from articolo where Id_articolo = '".$Carrello['Id_articolo']."'";
            $result_info = $mysqli -> query($query_info);
            
            while($gioco = $result_info -> fetch_assoc()){

                $prezzo = $Carrello['quantita'] * $gioco['Prezzo'];

            }

            $query ="UPDATE `disponibilita` set Disponibilita = Disponibilita - '".$Carrello['quantita']."' WHERE Id_articolo = '".$Carrello['Id_articolo']."'";
            $result = $mysqli -> query($query);

            $query_agg ="INSERT INTO ordine (Numero, Data , Id_utente , Id_articolo, Quantita, Prezzo_totale, Id_indirizzo_sped, Id_modalita_pag, Id_tipo_sped) 
                         VALUES ( ".$numero." , ".$data." ,".$_SESSION['Id_utente'].",".$Carrello['Id_articolo'].",".$Carrello['quantita'].", ".$prezzo." ,".$indirizzo.",".$carta.",".$sped.")";
            $result_agg = $mysqli -> query($query_agg);

        }

        unset($_SESSION["Carrello"]);
    }




?>
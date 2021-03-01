<?php

    require "include/auth.inc.php";
    session_start();

    $nome=$_GET["nome"];
    $cognome=$_GET["cognome"];
    $indirizzo=$_GET["indirizzo"];
    $carta=$_GET["carta"];
    $sped=$_GET["sped"];

    if( $nome == "" || $cognome== "" ) header("Location:cassa.php?errore=1");
    else{
        $body = new Template("dtml/acquisto_effettuato.html");
        
        foreach ($_SESSION['Carrello'] as &$Carrello) {
            $query ="UPDATE `disponibilita` set Disponibilita = Disponibilita - '".$Carrello['quantita']."' WHERE Id_articolo = '".$Carrello['Id_articolo']."'";
            $result = $mysqli -> query($query);
        }
        foreach ($_SESSION['Carrello'] as &$Carrello) {
            $query_agg ="INSERT INTO `ordine`(`Numero`, `Data`, `Id_utente`, `Id_articolo`, `Quantita`, `Prezzo_totale`, `Id_indirizzo_sped`, `Id_modalita_pag`, `Id_tipo_sped`) 
                        VALUES (100, ".date ("Y/m/d")." ,".$_SESSION[Id_utente].",".$Carrello[Id_articolo].",".$Carrello[quantità].",0,".$indirizzo.",".$carta.",".$sped.")";
            $result_agg = $mysqli -> query($query_agg);
        }

        unset($_SESSION["Carrello"]);
    }




?>
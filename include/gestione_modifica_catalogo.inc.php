<?php

    require "dbms.inc.php";

    session_start();

     $gioco=$_GET['Id_articolo'];
     $nome=$_GET['Nome'];
     $prezzo=$_GET['Prezzo'];
     $sconto=$_GET['Sconto'];
     $descrizione=$_GET['Descrizione'];
     $Piattaforma=$_GET['Piattaforma'];
     $anno=$_GET['Anno'];
     $produttore=$_GET['Produttore'];
     $casa=$_GET['Casa'];
     $classificazione=$_GET['Classificazione'];
     $genere=$_GET['Genere'];
     $lingua=$_GET['Lingua'];
     $disponibilita=$_GET['Disponibilita'];


    $query = " UPDATE articolo SET Nome='".$nome."', Prezzo='".$prezzo."', Sconto='".$sconto."', Descrizione=\"".$descrizione."\", Piattaforma='".$Piattaforma."', Anno='".$anno."', Produttore ='".$produttore."',
                Classificazione='".$classificazione."', Genere='".$genere."', Lingua='".$lingua."' WHERE Id_articolo = '".$gioco."'" ;
    $result = $mysqli -> query($query);

     

    $query_disp = " UPDATE disponibilita SET Disponibilita = ".$disponibilita." WHERE Id_articolo = " .$gioco ;
    $result_disp = $mysqli -> query($query_disp);

    header("Location: ../catalogo.php")

?>
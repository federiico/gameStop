<?php

    require "dbms.inc.php";
    $gioco = $_GET["gioco"];

    session_start();

    $query = " UPDATE articolo as a JOIN catalogo as  c on (a.Id_articolo=c.Id_articolo) JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo ) SET c.Disponibilita = 0 , d.Disponibilita = 0 WHERE a.Id_articolo = ".$gioco ;

    $result = $mysqli -> query($query);


    $query_delimg = "DELETE i,ia FROM immagine as i JOIN immagine_articolo as ia on (i.Id_immagine = ia.Id_immagine) WHERE ia.Id_articolo=".$gioco;

    $result_img = $mysqli -> query($query_delimg);

    header('Location: ../catalogo.php');
?>
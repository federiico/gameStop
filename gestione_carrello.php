<?php

session_start();
$page = $_SERVER["HTTP_REFERER"];
$gioco = $_GET["gioco"];
$quantita = $_GET["quantita"];
//$azione = $_GET["azione"];

if(isset($_SESSION['Id_utente'])){  

    //if($azione == "add")
        $_SESSION["Carrello"][]=array('Id_articolo'=> $gioco, 'quantita'=> $quantita);
    //if($azione == "del")
        //$_SESSION["Carrello"][]=array('Id_articolo'=> $gioco );
}else{
    
    header("Location: $page?error=1");
}
header("Location: carrello.php");
?>
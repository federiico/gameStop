<?php

    $main = new Template("dtml/common-frame.html"); 

    session_start();

    if(!isset($_SESSION['Id_utente'])){
        $main -> setContent('MyAccount','Accedi');
        $main -> setContent('Link_MyAccount','login.php');
        $main -> setContent("Login-logout",'Registrati');
        $main -> setContent("Link_login-logout",'registrazione.php');

        $main -> setContent("Totale_Carrello",'0 €');
        $main -> setContent("Quantità_Carrello",'0');
        $main -> setContent("Tasto_1",'Accedi');
        $main -> setContent("Link_Tasto_1",'login.php');
        $main -> setContent("Tasto_2",'Registrati');
        $main -> setContent("Link_Tasto_2",'registrazione.php');
        $main -> setContent("hidden",'hidden');
    }
    else{
        
        $main -> setContent('MyAccount','Il Mio Account');
        $main -> setContent('Link_MyAccount','my-account.php');
        $main -> setContent('Login-logout','Logout');
        $main -> setContent("Link_login-logout",'include/logout.inc.php');
        $main -> setContent("Tasto_1",'Vai al Carrello');
        $main -> setContent("Link_Tasto_1",'carrello.php');
        $main -> setContent("Tasto_2","Procedi All' Ordine");
        $main -> setContent("Link_Tasto_2",'');


    }
?>
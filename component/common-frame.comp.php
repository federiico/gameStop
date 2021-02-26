<?php

    $main = new Template("dtml/common-frame.html"); 

    session_start();

    if(!isset($_SESSION['Id_utente'])){
        $main -> setContent('MyAccount','Accedi');
        $main -> setContent('Link_MyAccount','login.php');
        $main -> setContent("Login-logout",'Registrati');
        $main -> setContent("Link_login-logout",'registrazione.php');
    }
    else{
        
        $main -> setContent('MyAccount','Il Mio Account');
        $main -> setContent('Link_MyAccount','my-account.php');
        $main -> setContent('Login-logout','Logout');
        $main -> setContent("Link_login-logout",'include/logout.inc.php');
    }
?>
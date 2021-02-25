<?php
    $main = new Template("dtml/common-frame.html"); 

    if(!isset($_SESSION['Id_account'])){
        $main -> setContent('MyAccount','Accedi');
        $main -> setContent("Login-logout",'Registrati');
    }
    else{
        $main -> setContent('MyAccount','Il Mio Account');
        $main -> setContent('Login-logout','Logout');
    }
?>
<?php

    require "dbms.inc.php";

    $email = $_POST['Email'];
    $password = $_POST['Password'];

    if($email == '' | $password == ''){
        header("Location: ../login.php?Errore=campo_vuoto");
    }
    else{

        $query = "SELECT Id_utente, Nome, Cognome, Telefono, Email, Password
                FROM Utente 
                WHERE Email ='".$email."' 
                AND Password ='".$password."'";
        
        $result = $mysqli -> query($query);

        
        if($result -> num_rows == 0)
            header("Location: ../login.php?Errore=credenziali_errate");
        else{

            $utente = $result -> fetch_assoc();
            session_start();
            
            $_SESSION['Id_utente'] = $utente['Id_utente'];
            $_SESSION['Nome'] = $utente['Nome'];
            $_SESSION['Cognome'] = $utente['Cognome'];
            $_SESSION['Telefono'] = $utente['Telefono'];
            $_SESSION['Email'] = $utente['Email'];
            $_SESSION['Password'] = $utente['Password'];

            $_SERVER['Script'] = "homepage.php";

            header("Location: ../index.php");

        }
    }
    

?>
<?php

    require "dbms.inc.php";

    $email = $_POST['Email'];
    $password = $_POST['Password'];

    if($email == '' | $password == ''){
        header("Location: ../login.php?Errore=campo_vuoto");
    }
    else{

        $query = "SELECT Utente.Id_utente, Utente.Nome AS NomeUtente, Cognome, Telefono, Email, Password, Gruppo.Nome AS NomeGruppo
                FROM Utente, Gruppo, Gruppo_utente
                WHERE Utente.Id_utente = Gruppo_utente.Id_utente
                AND Gruppo.Id_gruppo = Gruppo_utente.Id_gruppo
                AND Email ='".$email."' 
                AND Password ='".$password."'";
        
        $result = $mysqli -> query($query);

        
        if($result -> num_rows == 0)
            header("Location: ../login.php?Errore=credenziali_errate");
        else{

            $utente = $result -> fetch_assoc();
            session_start();
            
            $_SESSION['Id_utente'] = $utente['Id_utente'];
            $_SESSION['Nome'] = $utente['NomeUtente'];
            $_SESSION['Cognome'] = $utente['Cognome'];
            $_SESSION['Telefono'] = $utente['Telefono'];
            $_SESSION['Email'] = $utente['Email'];
            $_SESSION['Password'] = $utente['Password'];
            $_SESSION['Gruppo'] = $utente['NomeGruppo'];

            $_SERVER['Script'] = "homepage.php";

            header("Location: ../index.php");

        }
    }
    

?>
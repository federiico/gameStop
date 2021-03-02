<?php

    require "dbms.inc.php";

    $nome = $_POST['Nome'];
    $cognome = $_POST['Cognome'];
    $telefono = $_POST['Telefono'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    
    if($nome != '' && $cognome != '' && $email != '' && $password != ''){

        $query = "INSERT INTO Utente (Nome,Cognome,Telefono,Email,Password) 
                  VALUES ('".$nome."','".$cognome."','".$telefono."','".$email."','".$password."')";
        
        
        if( $mysqli -> query($query) == true){

            $query = "SELECT Id_utente FROM Utente WHERE Email='".$email."'";
            $result = $mysqli -> query($query);
            $id_utente = $result -> fetch_assoc();

            $query = "INSERT INTO Gruppo_utente (Id_gruppo,Id_utente) 
                      VALUES ( (SELECT Id_gruppo FROM Gruppo WHERE Nome = 'Cliente'),'".$id_utente['Id_utente']."')";
            
            if($mysqli -> query($query) == true){

                session_start();

                $_SESSION['Id_utente'] = $id_utente['Id_utente'];
                $_SESSION['Nome'] = $nome;
                $_SESSION['Cognome'] = $cognome;
                $_SESSION['Telefono'] = $telefono;
                $_SESSION['Email'] = $email;
                $_SESSION['Password'] = $password;
                $_SESSION['Gruppo'] = 'Cliente';

                $_SERVER['Script'] = "homepage.php";

                header("Location: ../index.php");
            }
            else header("Location: ../registrazione.php?error=query_error");
        }
        else header("Location: ../registrazione.php?error=query_error");
    }
    else {
        header("Location: ../registrazione.php?error=campo_vuoto");
    }



?>
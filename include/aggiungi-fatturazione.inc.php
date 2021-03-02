<?php

    require "dbms.inc.php";

    session_start();

    $nome = $_POST['Nome'];
    $cognome = $_POST['Cognome'];
    $telefono = $_POST['Telefono'];
    $stato = $_POST['Stato'];
    $provincia = $_POST['Provincia'];
    $citta = $_POST['Citta'];
    $cap = $_POST['CAP'];
    $indirizzo = $_POST['Indirizzo'];

    
    if($nome != '' && $cognome != '' && $telefono != '' && $stato != '' && $provincia != '' && $citta != '' && $cap != ''
        && $indirizzo != ''){

        $query = "INSERT INTO Indirizzo_fatturazione (Nome,Cognome,Telefono,Indirizzo,Stato,Provincia,Citta,CAP) 
                  VALUES ('".$nome."','".$cognome."','".$telefono."','".$indirizzo."','".$stato."','".$provincia."'
                          ,'".$citta."','".$cap."')";
        
        
        if( $mysqli -> query($query) == true){

            $query = "SELECT MAX(Id_fatturazione) AS lastId FROM Indirizzo_fatturazione";
            $result = $mysqli -> query($query);
            $ris = $result -> fetch_assoc();
            $id_indirizzo = $ris['lastId'];

            $query = "SELECT MAX(Id) AS lastId FROM Modalita_pagamento";
            $result = $mysqli -> query($query);
            $ris = $result -> fetch_assoc();
            $id_modalità = $ris['lastId'];
           
    
            $query = "INSERT INTO Modalita_fatturazione (Id_modalita,Id_indirizzo) 
                        VALUES ('".$id_modalità."','".$id_indirizzo."')";

            
            if($mysqli -> query($query) == true){
                
                header("Location: ../my-account.php?activePage=pagamenti");
            }
            else header("Location: ../aggiungi-fatturazione.php?Error=query");

        }
        else header("Location: ../aggiungi-fatturazione.php?Error=campo_vuoto");
    }
    else {
        header("Location: ../aggiungi-fatturazione.php?Error=campo_vuoto");
    }
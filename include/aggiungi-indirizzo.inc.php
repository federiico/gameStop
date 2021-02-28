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
    $note = $_POST['Note'];

    
    if($nome != '' && $cognome != '' && $telefono != '' && $stato != '' && $provincia != '' && $citta != '' && $cap != ''
        && $indirizzo != ''){

        $query = "INSERT INTO Indirizzo_spedizione (Nome,Cognome,Telefono,Indirizzo,Stato,Provincia,Citta,CAP,Note) 
                  VALUES ('".$nome."','".$cognome."','".$telefono."','".$indirizzo."','".$stato."','".$provincia."'
                          ,'".$citta."','".$cap."','".$note."')";
        
        
        if( $mysqli -> query($query) == true){

            $query = "SELECT MAX(Id_spedizione) AS lastId FROM Indirizzo_spedizione";
    
            $result = $mysqli -> query($query);
    
            $ris = $result -> fetch_assoc();
    
            $id_spedizione = $ris['lastId'];
           
    
            $query = "INSERT INTO Utente_spedizione (Id_utente,Id_spedizione) 
                        VALUES ('".$_SESSION['Id_utente']."','".$id_spedizione."')";

            
            if($mysqli -> query($query) == true){
                
                header("Location: ../my-account.php");
            }
            else header("Location: ../aggiungi-indirizzo.php?Error=query");

        }
        else header("Location: ../aggiungi-indirizzo.php?Error=campo_vuoto");
    }
    else {
        header("Location: ../aggiungi-indirizzo.php?Error=campo_vuoto");
    }



?>
<?php

    require "dbms.inc.php";

    session_start();

    $nominativo = $_POST['Nominativo'];
    $circuito = $_POST['Circuito'];
    $numero = $_POST['Numero'];
    $mese = $_POST['Mese'];
    $anno = $_POST['Anno'];
    $cvv = $_POST['CVV'];
    
    if($nominativo != '' && $circuito != '' && $numero != '' && $mese != '' && $anno != '' && $cvv != ''){

        $scadenza = "".$anno."-".$mese."-28";

        $query = "INSERT INTO Modalita_pagamento (Nominativo,Circuito,Numero,Data_scadenza,CVV) 
                  VALUES ('".$nominativo."','".$circuito."','".$numero."','".$scadenza."','".$cvv."')";
        
        
        if( $mysqli -> query($query) == true){

            $query = "SELECT MAX(Id) AS lastId FROM Modalita_pagamento";
            $result = $mysqli -> query($query);
            $ris = $result -> fetch_assoc();
            $id_modalità = $ris['lastId'];
           
    
            $query = "INSERT INTO Utente_modalita (Id_utente,Id_modalita) 
                        VALUES ('".$_SESSION['Id_utente']."','".$id_modalità."')";

            
            if($mysqli -> query($query) == true){
                
                header("Location: ../aggiungi-fatturazione.php");
            }
            else header("Location: ../aggiungi-modalita.php?Error=query");

        }
        else header("Location: ../aggiungi-modalita.php?Error=query_error");
    }
    else header("Location: ../aggiungi-modalita.php?Error=campo_vuoto");

?>
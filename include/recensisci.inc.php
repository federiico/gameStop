<?php

    require "dbms.inc.php";

    session_start();

    if( isset($_POST['star1']) )
        $num_stelle = 5;
    else
        if( isset($_POST['star2']) )
            $num_stelle = 4;
        else
            if( isset($_POST['star3']) )
                $num_stelle = 3;
            else
                if( isset($_POST['star4']) )
                    $num_stelle = 2; 
                else
                    if( isset($_POST['star5']) )
                        $num_stelle = 1;  
                    else $num_stelle = 0;

    $recensione = $_POST['recensione'];
    $id_utente = $_SESSION['Id_utente'];

    $query = "INSERT INTO Recensione (Stelle,Id_utente,Id_articolo,Descrizione) 
              VALUES ('".$num_stelle."','".$id_utente."','".$_SESSION['Id_articolo']."','".$recensione."')";

    echo $query;

    if($mysqli -> query($query) == true){
        header("Location: ../dettagli-prodotto.php?Id_articolo=".$_SESSION['Id_articolo']);
    }
    else header("Location ../dettagli-prodotto.php?Id_articolo=".$_SESSION['Id_articolo']."&Error=query_error");


?>
    
    
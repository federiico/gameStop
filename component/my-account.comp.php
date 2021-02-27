<?php

    require "include/auth.inc.php";

    if($autenticazione){

        $body = new Template("dtml/my-account.html");

        //------INIZIO DETTAGLI UTENTE-------
        $body -> setContent("Nome",$_SESSION['Nome']);
        $body -> setContent("Cognome",$_SESSION['Cognome']);
        $body -> setContent("Telefono",$_SESSION['Telefono']);
        $body -> setContent("Email",$_SESSION['Email']);
        $body -> setContent("Password",$_SESSION['Password']);
        //------FINE DETTAGLI UTENTE---------


        //------INIZIO ORDINI---------
        $query = "SELECT Ordine.Id_utente, Ordine.Numero, Ordine.Data, Ordine.Quantita, Ordine.Prezzo_totale, Articolo.Nome, Articolo.Piattaforma, Spedizione.Prezzo 
                  FROM Ordine,Spedizione,Articolo 
                  WHERE Ordine.Id_tipo_sped = Spedizione.Id_spedizione 
                  AND Ordine.Id_articolo = Articolo.Id_articolo";

        $result = $mysqli -> query($query);

        $cont = 0;

        while($ordine = $result -> fetch_assoc()){

            if($cont == 0){
                $num_ordine_corrente = $ordine['Numero'];
                $num_ordine_precede = $ordine['Numero'];
            }
            
        }


    }
    else header("Location: errore.php");




?>
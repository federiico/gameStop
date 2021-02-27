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
        $query = "SELECT Ordine.Numero, DAY(Data) AS Giorno, MONTH(Data) AS Mese, YEAR(Data) AS Anno
                  FROM Ordine
                  WHERE Ordine.Id_utente='".$_SESSION['Id_utente']."' ";

        $result = $mysqli -> query($query);

        $cont = 0;

        while($ordine = $result -> fetch_assoc()){

            if($cont == 0){
                $num_ordine_corrente = $ordine['Numero'];
                $num_ordine_precede = $ordine['Numero'];
            }
            else $num_ordine_corrente = $ordine['Numero'];

            if( ($num_ordine_corrente != $num_ordine_precede && $cont != 0) | $cont == 0){

                $body -> setContent("Numero_ordine",$ordine['Numero']);

                $data = $ordine['Giorno']."/".$ordine['Mese']."/".$ordine['Anno'];
                $body -> setContent("Data",$data);

                $query = "SELECT Ordine.Quantita, Ordine.Prezzo_totale, Articolo.Nome, Articolo.Piattaforma, Spedizione.Prezzo 
                          FROM Ordine,Spedizione,Articolo 
                          WHERE Ordine.Id_tipo_sped = Spedizione.Id_spedizione 
                          AND Ordine.Id_articolo = Articolo.Id_articolo 
                          AND Ordine.Numero ='".$ordine['Numero']."'";
                
                $result2 = $mysqli -> query($query);

                $articoli = "";
                $totale = 0;

                while($articolo = $result2 -> fetch_assoc()){

                    $articoli = $articoli.$articolo['Quantita']." x ".$articolo['Nome']." (".$articolo['Piattaforma'].") <br>";

                    $totale = $totale + (float)$articolo['Prezzo_totale'];

                    $costo_spedizione = (float)$articolo['Prezzo'];
                    
                }

                $body -> setContent("Articoli", $articoli);

                $totale = $totale + $costo_spedizione;
                $totale = number_format((float)$totale, 2, '.', '');
                $body -> setContent("Totale", "€ ".$totale);

                $body -> setContent("Link_dettagli_ordine", "dettagli-ordine.php?Numero=".$ordine['Numero']."&Data=".$data."&Articoli=".$articoli."&Totale=".$totale);

                $num_ordine_precede = $ordine['Numero'];

                $cont = $cont + 1;

            }
            else {
                $cont = $cont + 1;
                $num_ordine_precede = $ordine['Numero'];
            }

        }
        //---------FINE ORDINI-----------

        //--------INIZIO INDIRIZZI-------
        $query = "SELECT * FROM Utente_spedizione, Indirizzo_spedizione 
                  WHERE Utente_spedizione.Id_spedizione = Indirizzo_spedizione.Id_spedizione
                  AND Utente_spedizione.Id_utente ='".$_SESSION['Id_utente']."' ";

        $result = $mysqli -> query($query);

        
        while($indirizzo = $result -> fetch_assoc()){

            $body -> setContent("Destinatario", $indirizzo['Cognome']." ".$indirizzo['Nome']);
            
            $indirizzo2 = "";

            $indirizzo2 = $indirizzo['Indirizzo']."<br>".$indirizzo['Citta']." (".$indirizzo['CAP']."), ".$indirizzo['Provincia']."<br>".$indirizzo['Stato'];   
            $body -> setContent("Indirizzo", $indirizzo2);

            $body -> setContent("Telefono2", $indirizzo['Telefono']);

            $body -> setContent("Nota", $indirizzo['Note']);

            $body -> setContent("Link_elimina", "include/elimina_indirizzo.inc.php?Id_indirizzo=".$indirizzo['Id_spedizione']);

        }

        if( isset($_GET['Error']) ){
            if( $_GET['Error'] == "address_error")
                $body -> setContent("Messaggio_errore", "Impossibile eliminare l'indirizzo, è associato ad un ordine.");
            else $body -> setContent("Messaggio_errore", "");
        }else $body -> setContent("Messaggio_errore", "");


        

    }
    else header("Location: errore.php");

?>
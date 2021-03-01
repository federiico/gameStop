<?php
        require "include/auth.inc.php";

        $body = new Template("dtml/cassa.html");
        

        session_start();
        $quantitatotale=0;
        $errore=$_REQUEST["errore"];
        if(isset($errore)) $body -> setContent("errore","CAMPI MANCANTI");

        //DETTAGLI SPEDIZIONE
        //Modalita spedizione
        $query_spedizione ="SELECT * FROM spedizione";
        $result_spedizione = $mysqli -> query($query_spedizione);
        while($spedizione = $result_spedizione -> fetch_assoc()){
            $body -> setContent("Id_spedizione",$spedizione['Id_spedizione']);
            $body -> setContent("Nome_Spedizione",$spedizione['Tipologia'].' ( dai '.$spedizione['Giorni_min'].' ai '.$spedizione['Giorni_max'].' giorni ), € '.$spedizione['Prezzo']);
            $body -> setContent("Prezzo_spedizione", '€ '.$spedizione['Prezzo']);
        }


        //modalita pagamento

        $query_carta ="SELECT Id,SUBSTRING(Numero, 1, 4) AS Inizio , SUBSTRING(Numero, 12, 4) AS Fine , Data_scadenza FROM modalita_pagamento WHERE Id='".$_SESSION["Id_utente"]."'";
        $result_carta = $mysqli -> query($query_carta);
        while($carta = $result_carta -> fetch_assoc()){
            $body -> setContent("Id_carta",$carta['Id']);
            $body -> setContent("Cartadicredito",$carta['Inizio'].'-XXXX-XXXX-'.$carta['Fine'].' Scadenza: '.$carta['Data_scadenza']);
        }

        //Indirizzo

        $query_indirizzo ="SELECT i.Id_spedizione, Indirizzo, Citta, Provincia, Stato, CAP from indirizzo_spedizione as i JOIN utente_spedizione as u on (i.Id_spedizione=u.Id_spedizione) where Id_utente='".$_SESSION["Id_utente"]."'";
        $result_indirizzo = $mysqli -> query($query_indirizzo);
        while($indirizzo = $result_indirizzo -> fetch_assoc()){
            $body -> setContent("Id_indirizzo",$indirizzo['Id_spedizione']);
            $body -> setContent("indirizzo",$indirizzo['Indirizzo'].", ".$indirizzo['Citta']." ( ".$indirizzo['Provincia']." ), ".$indirizzo['Stato'].", ".$indirizzo['CAP']);
        }




        //IL TUO ORDINE:
        $prezzototale=0;
        foreach ($_SESSION['Carrello'] as &$Id_gioco) {
            $query ="SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione,Piattaforma FROM Articolo WHERE Id_articolo = '".$Id_gioco['Id_articolo']."'";
            $result = $mysqli -> query($query);

            $quantitatotale=$Id_gioco['quantita']+$quantitatotale;


            while($gioco = $result -> fetch_assoc()){
            $body -> setContent("Id_prodotto",$Id_gioco['Id_articolo']);     
            //$body -> setContent("Immagine_articolo","getImage.php?Id_articolo=".$gioco['Id_articolo']);
            $body -> setContent("Nome_articolo",$gioco['Nome']);
            $body -> setContent("Console_articolo",$gioco['Piattaforma']);

    
            if($gioco['Sconto'] > 0){

                $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((int)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                //$body -> setContent("Prezzo_articolo", $nuovoPrezzo);
                $totprezzo=$nuovoPrezzo * $Id_gioco['quantita'];
                $body -> setContent("Prezzo_articolo", "€ ".$totprezzo);
            }else {
                //$body -> setContent("Prezzo_articolo","€ ".$gioco['Prezzo']);
                $totprezzo=$gioco ['Prezzo'] * $Id_gioco['quantita'];
                $body -> setContent("Prezzo_articolo", "€ ".$totprezzo);
            }
            $body -> setContent("Link_articolo","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
            $body -> setContent("Quantità_articolo",$Id_gioco['quantita']);

            $prezzototale=$totprezzo+$prezzototale;
            }
            
        }
        $body -> setContent("Totale_Articoli","€ ".$prezzototale);


        $prezzofinale=$prezzototale + 0 ;

        $body -> setContent("Totale","€ ".$prezzofinale);

        if( $quantitatotale == 0 ) header('Location: carrello_vuoto.php');


?>
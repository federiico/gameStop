<?php
        require "include/auth.inc.php";

        if($autenticazione){

            $body = new Template("dtml/carrello.html");
            

            session_start();
            $prezzototale=0;
            $quantitatotale=0;
                foreach ($_SESSION['Carrello'] as &$Id_gioco) {
                    $query ="SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Id_articolo = '".$Id_gioco['Id_articolo']."'";
                    $result = $mysqli -> query($query);

                    $quantitatotale=$Id_gioco['quantita']+$quantitatotale;


                    while($gioco = $result -> fetch_assoc()){
                    $body -> setContent("Id_prodotto",$Id_gioco['Id_articolo']);     
                    $body -> setContent("Immagine_articolo_Carrello","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                    $body -> setContent("Nome_articolo_Carrello",$gioco['Nome']);
            
                    if($gioco['Sconto'] > 0){

                        $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                        $nuovoPrezzo = number_format((int)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                        $body -> setContent("Prezzo_articolo_Carrello", $nuovoPrezzo);
                    }else {
                        $body -> setContent("Prezzo_articolo_Carrello","€ ".$gioco['Prezzo']);
                    }
                    $body -> setContent("Link_articolo_Carrello","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                    $body -> setContent("Quantità_articolo_Carrello",$Id_gioco['quantita']);
                    $totprezzo=$gioco ['Prezzo'] * $Id_gioco['quantita'];
                    $body -> setContent("Prezzo_articolo_Carrelloxqta", "€ ".$totprezzo);
                    $prezzototale=$totprezzo+$prezzototale;
                    }
                    
                }

                $body -> setContent("Prezzo_totale_Carrello", "€ ".$prezzototale);
                if( $quantitatotale == 0 ) header('Location: carrello_vuoto.php');
        }
        else header("Location: errore.php");
            

?>
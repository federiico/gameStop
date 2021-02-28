<?php

    require "include/auth.inc.php";

    if($autenticazione){

        if( isset($_GET['Numero']) && isset($_GET['Data']) && isset($_GET['Articoli']) && isset($_GET['Totale'])){

            $body = new Template("dtml/dettagli-ordine.html");

            $body -> setContent("Numero", $_GET['Numero']);
            $body -> setContent("Data", $_GET['Data']);
            $body -> setContent("Articoli", $_GET['Articoli']);
            $body -> setContent("Totale", "€ ".$_GET['Totale']);
    
            $query = "SELECT Spedizione.Tipologia, Indirizzo_spedizione.Indirizzo, Indirizzo_spedizione.Stato, 
                           Indirizzo_spedizione.Provincia, Indirizzo_spedizione.Citta, Indirizzo_spedizione.CAP, 
                           Modalita_pagamento.Circuito, Modalita_pagamento.Numero
                    FROM Ordine, Spedizione, Indirizzo_spedizione, Modalita_pagamento
                    WHERE Ordine.Id_indirizzo_sped = Indirizzo_spedizione.Id_spedizione
                    AND Ordine.Id_modalita_pag = Modalita_pagamento.Id
                    AND Ordine.Id_tipo_sped = Spedizione.Id_spedizione
                    AND Ordine.Numero ='".$_GET['Numero']."'
                    LIMIT 1";
            
            $result = $mysqli -> query($query);
            
            while( $ordine = $result -> fetch_assoc()){
                
                $body -> setContent("Spedizione", $ordine['Tipologia']);
    
                $indirizzo = $ordine['Indirizzo']."<br>".$ordine['Citta']." (".$ordine['CAP']."), ".$ordine['Provincia']."<br>".$ordine['Stato'];
                $body -> setContent("Indirizzo", $indirizzo);
    
                $pagamento = $ordine['Circuito']." ";
                for($i = 0; $i < 16; $i++){
                    if($i < 12)
                        $pagamento = $pagamento."*";
                    else $pagamento = $pagamento.$ordine['Numero'][$i];
                }
                $body -> setContent("Pagamento", $pagamento);

    
            }
        }
        else header("Location: errore.php");
    }
    else header("Location: errore.php");

?>
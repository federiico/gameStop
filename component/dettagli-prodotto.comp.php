<?php

    require "include/auth.inc.php";

    if($autenticazione){

    
        $body = new Template("dtml/dettagli-prodotto.html");

        $query = "SELECT * FROM Articolo WHERE Id_articolo='".$_GET['Id_articolo']."'";

        $result = $mysqli -> query($query);

        $gioco = $result -> fetch_assoc();
        
        $query = "SELECT Immagine.Id_immagine
                    FROM Immagine_articolo,Immagine 
                    WHERE Immagine_articolo.Id_immagine = Immagine.Id_immagine
                    AND Immagine_articolo.Id_articolo='".$_GET['Id_articolo']."'";

        $result2 = $mysqli -> query($query);
        $cont = 0;
        while($immagine = $result2 -> fetch_assoc()){

            if($cont == 0){
                $body -> setContent("Immagine_principale","getImage.php?Id_immagine=".$immagine['Id_immagine']);
                $body -> setContent("Immagine_secondaria","getImage.php?Id_immagine=".$immagine['Id_immagine']);
            }
            else
                $body -> setContent("Immagine_secondaria","getImage.php?Id_immagine=".$immagine['Id_immagine']);  
                $cont = $cont + 1;
        }

        $body -> setContent("Nome_articolo",$gioco['Nome']);

        $query = "SELECT AVG(Stelle) AS media FROM Recensione WHERE Id_articolo='".$_GET['Id_articolo']."'";

        $result = $mysqli -> query($query);

        $stelle = $result -> fetch_assoc();

        for($i = 0; $i < 5; $i++){
            if($i < (int)$stelle['media'])
                $body -> setContent("Stella_articolo", "fa fa-star");
            else $body -> setContent("Stella_articolo", "ion-android-star-outline");
        }

        if($gioco['Sconto'] > 0){
        
            $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
            $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
            $body -> setContent("Prezzo_vecchio","€ ".$gioco['Prezzo']);
            $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
            }
        else {
            $body -> setContent("Prezzo_vecchio","");
            $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);
        }

        $body -> setContent("Descrizione", $gioco['Descrizione']);
    
        $body -> setContent("Piattaforma", $gioco['Piattaforma']);

        $body -> setContent("Anno", $gioco['Anno']);

        $body -> setContent("Produttore", $gioco['Produttore']);

        $body -> setContent("Casa_sviluppatrice", $gioco['Casa sviluppatrice']);

        $body -> setContent("Classificazione", $gioco['Classificazione']);

        $body -> setContent("Genere", $gioco['Genere']);

        $body -> setContent("Lingua", $gioco['Lingua']);


        $query = "SELECT COUNT(Id_recensione) AS numeroRecensioni FROM Recensione WHERE Id_articolo='".$_GET['Id_articolo']."'";

        $result = $mysqli -> query($query);

        $recensioni = $result -> fetch_assoc();
        
        $body -> setContent("NumRecensioni", $recensioni['numeroRecensioni']);

        $query = "SELECT Recensione.Stelle, Recensione.Descrizione, Utente.Nome 
                FROM Recensione, Utente 
                WHERE Id_articolo='".$_GET['Id_articolo']."'
                AND Recensione.Id_utente = Utente.Id_utente";

        $result = $mysqli -> query($query);

        while($recensione = $result -> fetch_assoc()){
        
            $body -> setContent("Utente", $recensione['Nome']);
            $body -> setContent("DescrizioneRecensione", $recensione['Descrizione']);
            
            for($i = 0; $i < 5; $i++){
                if($i < $recensione['Stelle'])
                    $body -> setContent("Stella_recensione", "fa fa-star");
                else $body -> setContent("Stella_recensione", "ion-android-star-outline");
            }
        }

        $query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo
                WHERE Piattaforma ='".$gioco['Piattaforma']."' 
                AND Genere ='".$gioco['Genere']."'
                AND Id_articolo !='".$gioco['Id_articolo']."'";

        $result = $mysqli -> query($query);

        while($gioco2 = $result -> fetch_assoc()){
        
            $body -> setContent("Immagine_correlata","getImage.php?Id_articolo=".$gioco2['Id_articolo']);
            $body -> setContent("Nome_articolo_correlato",$gioco2['Nome']);

            if($gioco['Sconto'] > 0){

                $body -> setContent("Offerta_correlata","Offerta");
                $nuovoPrezzo = ($gioco2['Prezzo'] - (($gioco2['Prezzo'] / 100) * $gioco2['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_correlato","€ ".$gioco2['Prezzo']);
                $body -> setContent("Prezzo_corrente_correlato","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_correlata","");
                $body -> setContent("Vecchio_prezzo_correlato","");
                $body -> setContent("Prezzo_corrente_correlato","€ ".$gioco2['Prezzo']);
            }
            $body -> setContent("Link_prodotto_correlato","dettagli-prodotto.php?Id_articolo=".$gioco2['Id_articolo']);

        }
    }
    else header("Location: errore.php");

?>
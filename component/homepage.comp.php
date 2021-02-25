<?php

        $body = new Template("dtml/homepage.html"); 
        
    	$query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Piattaforma = 'Playstation 4'";
        $result = $mysqli -> query($query);
        
        while($giocoPS4 = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_PS4","getImage.php?Id_articolo=".$giocoPS4['Id_articolo']);
            $body -> setContent("Nome_articolo_PS4",$giocoPS4['Nome']);
    
            if($giocoPS4['Sconto'] > 0){
    
                $body -> setContent("Offerta_PS4","Offerta");
                $nuovoPrezzo = ($giocoPS4['Prezzo'] - (($giocoPS4['Prezzo'] / 100) * $giocoPS4['Sconto'])); //prezzo scontato
                $nuovoPrezzoPS4 = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_PS4","€ ".$giocoPS4['Prezzo']);
                $body -> setContent("Prezzo_corrente_PS4","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_PS4","");
                $body -> setContent("Vecchio_prezzo_PS4","");
                $body -> setContent("Prezzo_corrente_PS4","€ ".$giocoPS4['Prezzo']);
            }
            $body -> setContent("Link_prodotto_PS4","dettagli-prodotto.php?Id_articolo=".$giocoPS4['Id_articolo']);

        }
    
        $query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Piattaforma = 'Xbox One'";
        $result = $mysqli -> query($query);
        
        while($giocoXbox = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_Xbox","getImage.php?Id_articolo=".$giocoXbox['Id_articolo']);
            $body -> setContent("Nome_articolo_Xbox",$giocoXbox['Nome']);
    
            if($giocoXbox['Sconto'] > 0){
    
                $body -> setContent("Offerta_Xbox","Offerta");
                $nuovoPrezzo = ($giocoXbox['Prezzo'] - (($giocoXbox['Prezzo'] / 100) * $giocoXbox['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_Xbox","€ ".$giocoXbox['Prezzo']);
                $body -> setContent("Prezzo_corrente_Xbox","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_Xbox","");
                $body -> setContent("Vecchio_prezzo_Xbox","");
                $body -> setContent("Prezzo_corrente_Xbox","€ ".$giocoXbox['Prezzo']);
            }
            $body -> setContent("Link_prodotto_Xbox","dettagli-prodotto.php?Id_articolo=".$giocoXbox['Id_articolo']);
        }
    
        $query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Piattaforma = 'Nintendo Switch'";
        $result = $mysqli -> query($query);
        
        while($giocoNintendo = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_Nintendo","getImage.php?Id_articolo=".$giocoNintendo['Id_articolo']);
            $body -> setContent("Nome_articolo_Nintendo",$giocoNintendo['Nome']);
    
            if($giocoNintendo['Sconto'] > 0){
    
                $body -> setContent("Offerta_Nintendo","Offerta");
                $nuovoPrezzo = ($giocoNintendo['Prezzo'] - (($giocoNintendo['Prezzo'] / 100) * $giocoNintendo['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_Nintendo","€ ".$giocoNintendo['Prezzo']);
                $body -> setContent("Prezzo_corrente_Nintendo","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_Nintendo","");
                $body -> setContent("Vecchio_prezzo_Nintendo","");
                $body -> setContent("Prezzo_corrente_Nintendo","€ ".$giocoNintendo['Prezzo']);
            }
            $body -> setContent("Link_prodotto_Nintendo","dettagli-prodotto.php?Id_articolo=".$giocoNintendo['Id_articolo']);
        }
    
        $query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Piattaforma = 'Pc'";
        $result = $mysqli -> query($query);
        
        while($giocoPc = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_Pc","getImage.php?Id_articolo=".$giocoPc['Id_articolo']);
            $body -> setContent("Nome_articolo_Pc",$giocoPc['Nome']);
    
            if($giocoPc['Sconto'] > 0){
    
                $body -> setContent("Offerta_Pc","Offerta");
                $nuovoPrezzo = ($giocoPc['Prezzo'] - (($giocoPc['Prezzo'] / 100) * $giocoPc['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_Pc","€ ".$giocoPc['Prezzo']);
                $body -> setContent("Prezzo_corrente_Pc","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_Pc","");
                $body -> setContent("Vecchio_prezzo_Pc","");
                $body -> setContent("Prezzo_corrente_Pc","€ ".$giocoPc['Prezzo']);
            }
            $body -> setContent("Link_prodotto_Pc","dettagli-prodotto.php?Id_articolo=".$giocoPc['Id_articolo']);
        }
    
    
        $annoCorrente = date('Y');
        $annoCorrente = $annoCorrente -1;
        $query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Anno='".$annoCorrente."' ";
        $result = $mysqli -> query($query);
        
        while($giocoNovita = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_Novita","getImage.php?Id_articolo=".$giocoNovita['Id_articolo']);
            $body -> setContent("Nome_articolo_Novita",$giocoNovita['Nome']);
    
            if($giocoNovita['Sconto'] > 0){
    
                $body -> setContent("Offerta_Novita","Offerta");
                $nuovoPrezzo = ($giocoNovita['Prezzo'] - (($giocoNovita['Prezzo'] / 100) * $giocoNovita['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_Novita","€ ".$giocoNovita['Prezzo']);
                $body -> setContent("Prezzo_corrente_Novita","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_Novita","");
                $body -> setContent("Vecchio_prezzo_Novita","");
                $body -> setContent("Prezzo_corrente_Novita","€ ".$giocoNovita['Prezzo']);
            }
            $body -> setContent("Link_prodotto_Novita","dettagli-prodotto.php?Id_articolo=".$giocoNovita['Id_articolo']);
        }
    
        $query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Sconto > 0";
        $result = $mysqli -> query($query);
        
        while($giocoScontato = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_Sconto","getImage.php?Id_articolo=".$giocoScontato['Id_articolo']);
            $body -> setContent("Nome_articolo_Sconto",$giocoScontato['Nome']);
    
    
            $body -> setContent("Offerta_Sconto","Offerta");
            $nuovoPrezzo = ($giocoScontato['Prezzo'] - (($giocoScontato['Prezzo'] / 100) * $giocoScontato['Sconto'])); //prezzo scontato
            $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
            $body -> setContent("Vecchio_prezzo_Sconto","€ ".$giocoScontato['Prezzo']);
            $body -> setContent("Prezzo_corrente_Sconto","€ ".$nuovoPrezzo);

            $body -> setContent("Link_prodotto_Sconto","dettagli-prodotto.php?Id_articolo=".$giocoScontato['Id_articolo']);
        
        }
    
        $query = "SELECT Articolo.Nome,Articolo.Prezzo,Articolo.Sconto,COUNT(Ordine.Id_ordine), Ordine.Id_articolo
                  FROM Ordine,Articolo
                  WHERE Articolo.Id_articolo = Ordine.Id_articolo
                  GROUP BY Ordine.Id_articolo
                  ORDER BY COUNT(Ordine.Id_articolo) ASC";
        $result = $mysqli -> query($query);
        
        while($giocoVenduto = $result -> fetch_assoc()){
    
            $body -> setContent("Immagine_Venduti","getImage.php?Id_articolo=".$giocoVenduto['Id_articolo']);
            $body -> setContent("Nome_articolo_Venduti",$giocoVenduto['Nome']);
    
            if($giocoVenduto['Sconto'] > 0){
                $body -> setContent("Offerta_Venduti","Offerta");
                $nuovoPrezzo = ($giocoVenduto['Prezzo'] - (($giocoVenduto['Prezzo'] / 100) * $giocoVenduto['Sconto'])); //prezzo scontato
                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                $body -> setContent("Vecchio_prezzo_Venduti","€ ".$giocoVenduto['Prezzo']);
                $body -> setContent("Prezzo_corrente_Venduti","€ ".$nuovoPrezzo);
            }
            else {
                $body -> setContent("Offerta_Venduti","");
                $body -> setContent("Vecchio_prezzo_Venduti","");
                $body -> setContent("Prezzo_corrente_Venduti","€ ".$giocoVenduto['Prezzo']);
            }
            $body -> setContent("Link_prodotto_Venduti","dettagli-prodotto.php?Id_articolo=".$giocoVenduto['Id_articolo']);
        
        }
?>
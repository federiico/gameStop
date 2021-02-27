<?php
        require "include/auth.inc.php";

        $body = new Template("dtml/carrello.html");


        session_start(); 
            
            foreach ($_SESSION['Carrello'] as &$Id_gioco) {
                $query ="SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Id_articolo = '".$Id_gioco['Id_articolo']."'";
                $result = $mysqli -> query($query);
                while($gioco = $result -> fetch_assoc()){
                     
                $body -> setContent("Immagine_articolo_Carrello","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                $body -> setContent("Nome_articolo_Carrello",$gioco['Nome']);
        
                //if($gioco['Sconto'] > 0){

                    //$nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                    //$nuovoPrezzo = number_format((int)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                    //$body -> setContent("Prezzo_articolo_Carrello",$nuovoPrezzo]);
                //}
                //else {
                    $body -> setContent("Prezzo_articolo_Carrello","€ ".$gioco['Prezzo']);
                //}
                $body -> setContent("Link_articolo_Carrello","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                $body -> setContent("Quantita_articolo_Carello",$Id_gioco['quantita']);
                
                }
                
            }
        //unset($Id_gioco);

        /*}else{
            if(isset($_SESSION['Id_utente'])
                header("Location: carrello_vuoto.php");
            if(isset($_SESSION['Carrello'])
            header("Location: errore.php");
        }  */
?>
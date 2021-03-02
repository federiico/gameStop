<?php
        require "include/auth.inc.php";

        if($autenticazione){

            $body = new Template("dtml/catalogo.html");

            $query = "SELECT Articolo.Id_articolo,Nome,Prezzo,Sconto 
                      FROM Articolo, Catalogo
                      WHERE Articolo.Id_articolo = Catalogo.Id_catalogo
                      AND Catalogo.Disponibilita=1";

            $result = $mysqli -> query($query);

            while($gioco = $result -> fetch_assoc()){

                $body -> setContent("Immagine_articolo","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                $body -> setContent("Link_articolo","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                $body -> setContent("Id_articolo", $gioco['Id_articolo']);

                $body -> setContent("Nome_articolo", $gioco['Nome']);

                if($gioco['Sconto'] > 0){
        
                  
                    $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                    $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                    $body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
                    $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
                }
                else {
                    $body -> setContent("Vecchio_prezzo","");
                    $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);
                }

                $body -> setContent("Sconto", $gioco['Sconto']." %");
            }
        }

?>
            
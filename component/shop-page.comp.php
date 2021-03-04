<?php

    require "include/auth.inc.php";

    $page = $_SERVER['SCRIPT_FILENAME'];

    if($autenticazione){

        $body = new Template("dtml/shop-page.html"); 		// sottotemplate per la home
        
        $console=$_GET['console'];
        $categoria=$_GET['categoria'];
        $ordine = $_GET['orderby'];
        $nome = $_GET['ricerca'];
        $promo = $_GET['promo'];

        if($console== "PlayStation4" ) $console="Playstation 4";
        if($console== "XboxOne" ) $console="Xbox One";
        if($console== "NintendoSwitch" ) $console="Nintendo Switch";

        if($ordine==1){ $ordine = "Anno";$verso="ASC";}
        if($ordine==2){ $ordine = "Prezzo"; $verso="ASC";}
        if($ordine==3){ $ordine = "Prezzo"; $verso="DESC";}

        if($categoria=="GiochidiGuida") $categoria="Giochi di guida";

        if((isset($console) && isset($categoria))){
                //Shop by Console+Category
                $body->setContent("NomeCategoria",$verso);
                $query ="SELECT a.Id_articolo as Id_articolo ,Nome,Prezzo,Sconto,Descrizione,d.disponibilita 
                         FROM Articolo as a JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo) 
                         JOIN Catalogo on (a.Id_articolo = Catalogo.Id_articolo) 
                         WHERE Genere = '".$categoria."' AND Piattaforma = '".$console."' 
                         AND Catalogo.Disponibilita=1";
                $result = $mysqli -> query($query);
            
                    while($gioco = $result -> fetch_assoc()){

                        $body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                        $body -> setContent("Nome_articolo",$gioco['Nome']);
                        $body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
                        $body -> setContent("Id_prodotto",$gioco['Id_articolo']);
                        

                        if($gioco['Sconto'] > 0){

                            $body -> setContent("Offerta","Offerta");
                            $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                            $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                            $body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
                            $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
                        }
                        else $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);

                        if( $gioco['disponibilita'] == 0){

                            $body -> setContent("Aggiungi","Prodotto esaurito");
                            $body -> setContent("Link_Carrello",$page);
                
                        }else{
                
                            $body -> setContent("Link_Carrello","include/gestione_carrello.inc.php?gioco=".$gioco['Id_articolo']."gioco=&quantita=1&azione=add");
                            $body -> setContent("Aggiungi","Aggiungi al carrello");
                        }

                        //gestione_carrello.php?gioco=<[Id_prodotto]>&quantita=1&azione=add

                        $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                    }		
        }else{
                //Shop by Console (Promo)
                if((isset($console)) && is_null($nome)){
                    $query = "SELECT a.Id_articolo as Id_articolo,Nome,Prezzo,Sconto,Descrizione,d.disponibilita 
                    FROM Articolo as a JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo) 
                    JOIN Catalogo on (a.Id_articolo = Catalogo.Id_articolo) 
                    WHERE Piattaforma = '".$console."' 
                    AND Catalogo.Disponibilita=1";

                    if($console == "promo") $query = "SELECT a.Id_articolo as Id_articolo,Nome,Prezzo,Sconto,Descrizione,d.disponibilita 
                    FROM Articolo as a JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo) 
                    JOIN Catalogo on (a.Id_articolo = Catalogo.Id_articolo) 
                    WHERE Sconto > 0 AND Catalogo.Disponibilita=1";

                    $result = $mysqli -> query($query);
                    while($gioco = $result -> fetch_assoc()){
      
                        $body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                        $body -> setContent("Nome_articolo",$gioco['Nome']);
                        $body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
                        $body -> setContent("Id_prodotto",$gioco['Id_articolo']);
          
                        if($gioco['Sconto'] > 0){
          
                            $body -> setContent("Offerta","Offerta");
                            $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                            $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                            $body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
                            $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
                        }
                        else {
                            $body -> setContent("Offerta","");
                            $body -> setContent("Vecchio_prezzo","");
                            $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);
                        }
                        if($gioco['disponibilita'] == 0){
                            $body -> setContent("Aggiungi","Prodotto esaurito");
                            $body -> setContent("Link_carrello","");
            
                        }else{
                            $body -> setContent("Link_Carrello","include/gestione_carrello.inc.php?gioco=".$gioco['Id_articolo']."&quantita=1&azione=add");
                            $body -> setContent("Aggiungi","Aggiungi al carrello");
                        }
                        $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                    }
                }
                //Shop by Category
                if((isset($categoria))){
                    $query = "SELECT a.Id_articolo as Id_articolo,Nome,Prezzo,Sconto,Descrizione,d.disponibilita 
                    FROM Articolo as a JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo)
                    JOIN Catalogo on (a.Id_articolo = Catalogo.Id_articolo) 
                    WHERE Genere = '".$categoria."' 
                    AND Catalogo.Disponibilita=1";
                    $result = $mysqli -> query($query);
                
                        while($gioco = $result -> fetch_assoc()){

                            $body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                            $body -> setContent("Nome_articolo",$gioco['Nome']);
                            $body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
                            $body -> setContent("Id_prodotto",$gioco['Id_articolo']);

                            if($gioco['Sconto'] > 0){

                                $body -> setContent("Offerta","Offerta");
                                $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                                $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                                $body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
                                $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
                            }
                            else $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);

                            if( $gioco['disponibilita'] == 0){

                                $body -> setContent("Aggiungi","Prodotto esaurito");
                                $body -> setContent("Link_Carrello",$page);
                    
                            }else{
                    
                                $body -> setContent("Link_Carrello","include/gestione_carrello.inc.php?gioco=".$gioco['Id_articolo']."gioco=&quantita=1&azione=add");
                                $body -> setContent("Aggiungi","Aggiungi al carrello");
                            }

                            $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                        }		
                }
            }
            //Shop By name + console
            
            if((isset($nome)) && isset($console)){
                $query = "SELECT a.Id_articolo as Id_articolo,Nome,Prezzo,Sconto,Descrizione,d.disponibilita 
                FROM Articolo as a JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo) 
                JOIN Catalogo on (a.Id_articolo = Catalogo.Id_articolo) 
                WHERE (Nome LIKE '%".$nome."%' OR Produttore LIKE '%".$nome."%') AND Piattaforma = '".$console."' 
                AND Catalogo.Disponibilita=1";
                $result = $mysqli -> query($query);
                    while($gioco = $result -> fetch_assoc()){

                        $body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                        $body -> setContent("Nome_articolo",$gioco['Nome']);
                        $body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
                        $body -> setContent("Id_prodotto",$gioco['Id_articolo']);

                        if($gioco['Sconto'] > 0){

                            $body -> setContent("Offerta","Offerta");
                            $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                            $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                            $body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
                            $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
                        }
                        else $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);

                        if( $gioco['disponibilita'] == 0){

                            $body -> setContent("Aggiungi","Prodotto esaurito");
                            $body -> setContent("Link_Carrello",$page);
                
                        }else{
                
                            $body -> setContent("Link_Carrello","include/gestione_carrello.inc.php?gioco=".$gioco['Id_articolo']."gioco=&quantita=1&azione=add");
                            $body -> setContent("Aggiungi","Aggiungi al carrello");
                        }

                        $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                        $body -> setContent("conta", $query['conta']);

                    }
                $body -> setContent("conta", $conta['conta']);
            }


            //Shop By name

            if((isset($nome)) && $console=="1" ){
                $query = "SELECT a.Id_articolo as Id_articolo,Nome,Prezzo,Sconto,Descrizione,d.disponibilita 
                FROM Articolo as a JOIN disponibilita as d on (a.Id_articolo = d.Id_articolo) 
                JOIN Catalogo on (a.Id_articolo = Catalogo.Id_articolo) 
                WHERE ( Nome LIKE '%".$nome."%' OR Produttore LIKE '%".$nome."%') 
                AND catalogo.Disponibilita = 1";

                $result = $mysqli -> query($query);

                while($gioco = $result -> fetch_assoc()){
      
                    $body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                    $body -> setContent("Nome_articolo",$gioco['Nome']);
                    $body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
                    $body -> setContent("Id_prodotto",$gioco['Id_articolo']);
      
                    if($gioco['Sconto'] > 0){
      
                    $body -> setContent("Offerta","Offerta");
                    $nuovoPrezzo = ($gioco['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
                    $nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
                    $body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
                    $body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
                    }
                    else {
                        $body -> setContent("Offerta","");
                        $body -> setContent("Vecchio_prezzo","");
                        $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);
                    }
                    if($gioco['disponibilita'] == 0){
                        $body -> setContent("Aggiungi","Prodotto esaurito");
                        $body -> setContent("Link_carrello","");

                    }else{
                        $body -> setContent("Link_Carrello","include/gestione_carrello.inc.php?gioco=".$gioco['Id_articolo']."&quantita=1&azione=add");
                        $body -> setContent("Aggiungi","Aggiungi al carrello");
                    }
                    $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
            }

                       
                        
            }
            
            if(($mysqli -> affected_rows) == 0 ) header("Location: ricerca_vuota.php");

    } 
    else header("Location: errore.php");

?>
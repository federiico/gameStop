<?php

    require "include/auth.inc.php";

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
                $query ="SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Genere = '".$categoria."' AND Piattaforma = '".$console."' ORDER BY '".$ordine."' ".$verso."";
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

                        $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                    }		
        }else{
                //Shop by Console (Promo)
                if((isset($console)) && is_null($nome)){
                    $query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Piattaforma = '".$console."' ORDER BY '".$ordine."' ".$verso."";
                    if($console == "promo") $query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Sconto > 0 ORDER BY '".$ordine."' ".$verso."";
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

                            $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);

                        }
                    $body -> setContent("conta", $conta['conta']);
                }
                //Shop by Category
                if((isset($categoria))){
                    $query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Genere = '".$categoria."' ORDER BY '".$ordine."' ".$verso."";
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

                            $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                        }		
                }
            }
            //Shop By name + console
            
            if((isset($nome)) && isset($console)){
                $query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE (Nome LIKE '%".$nome."%' OR Produttore LIKE '%".$nome."%') AND Piattaforma = '".$console."' ORDER BY '".$ordine."' ".$verso."";
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

                        $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                        $body -> setContent("conta", $query['conta']);

                    }
                $body -> setContent("conta", $conta['conta']);
            }


            //Shop By name

            if((isset($nome)) && $console=="1" ){
                $query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Nome LIKE '%".$nome."%' OR Produttore LIKE '%".$nome."%' ORDER BY '".$ordine."' ".$verso."";
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
            
                        $body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                        $body -> setContent("conta", $query['conta']);
            
                        }
                        $body -> setContent("conta", $conta['conta']);
            }

    } 
    else header("Location: errore.php");

?>
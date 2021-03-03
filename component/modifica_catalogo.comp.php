<?php
    require "include/auth.inc.php";

    if($autenticazione){

        $body = new Template("dtml/modifica_catalogo.html");

        $page = $_SERVER['SCRIPT_FILENAME'];

        $_SESSION['Id_articolo'] = $_GET['gioco'];
 

        $query = "SELECT a.Id_articolo as Id_articolo , Disponibilita, Nome, Anno, Piattaforma, Produttore, Casa_sviluppatrice, Classificazione, Genere, Lingua, Prezzo, Sconto, Descrizione 
                    FROM Articolo as a JOIN Disponibilita as d on ( a.Id_articolo = d.Id_articolo ) WHERE a.Id_articolo='".$_GET['gioco']."'";

        $result = $mysqli -> query($query);

        $gioco = $result -> fetch_assoc();
        
        $query = "SELECT Immagine.Id_immagine
                    FROM Immagine_articolo,Immagine 
                    WHERE Immagine_articolo.Id_immagine = Immagine.Id_immagine
                    AND Immagine_articolo.Id_articolo='".$_GET['gioco']."'";

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
        $body -> setContent("Id_prodotto",$gioco['Id_articolo']);
        $body -> setContent("Disponibilita", $gioco['Disponibilita']);
        $body -> setContent("Sconto", $gioco['Sconto']);
        $body -> setContent("Prezzo_corrente", $gioco['Prezzo']);
        $body -> setContent("Descrizione_prodotto", $gioco['Descrizione']);
        $body -> setContent("Piattaforma_prodotto", $gioco['Piattaforma']);
        $body -> setContent("Anno_prodotto", $gioco['Anno']);
        $body -> setContent("Produttore_prodotto", $gioco['Produttore']);
        $body -> setContent("Casa_Sviluppatrice_prodotto", $gioco['Casa_sviluppatrice']);
        $body -> setContent("Classificazione_prodotto", $gioco['Classificazione']);
        $body -> setContent("Genere_prodotto", $gioco['Genere']);
        $body -> setContent("Lingua_prodotto", $gioco['Lingua']);
        //-------FINE INFO ARTICOLO----------

    }
?>
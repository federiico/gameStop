<?php

    $main = new Template("dtml/common-frame.html"); 

    session_start();

    if(!isset($_SESSION['Id_utente'])){
        $main -> setContent('MyAccount','Accedi');
        $main -> setContent('Link_MyAccount','login.php');
        $main -> setContent("Login-logout",'Registrati');
        $main -> setContent("Link_login-logout",'registrazione.php');

        $main -> setContent("Totale_Carrello",'0 €');
        $main -> setContent("Quantità_Carrello",'0');
        $main -> setContent("Tasto_1",'Accedi');
        $main -> setContent("Link_Tasto_1",'login.php');
        $main -> setContent("Tasto_2",'Registrati');
        $main -> setContent("Link_Tasto_2",'registrazione.php');
        $main -> setContent("hidden",'hidden');
    }
    else{
        $main -> setContent('MyAccount','Il Mio Account');
        $main -> setContent('Link_MyAccount','my-account.php');
        $main -> setContent('Login-logout','Logout');
        $main -> setContent("Link_login-logout",'include/logout.inc.php');
        
                foreach ($_SESSION['Carrello'] as &$Id_gioco) {

                    $query ="SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Id_articolo = '".$Id_gioco['Id_articolo']."'";
                    $result = $mysqli -> query($query);

                    while($gioco = $result -> fetch_assoc()){

                        $quantitatotale=$Id_gioco['quantita']+$quantitatotale;
                        $main -> setContent("Link_articolo_Carrello","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
                        $main -> setContent("Immagine_Carrello","getImage.php?Id_articolo=".$gioco['Id_articolo']);
                        $main -> setContent("Nome_articolo_Carrello",$gioco['Nome']);
                        $main -> setContent("Quantita_carrello_prodotto",$Id_gioco['quantita']);
                        $main -> setContent("Id_prodotto",$Id_gioco['Id_articolo']);
                        $main -> setContent("Prezzo_articolo_Carrello","€ ".$gioco['Prezzo']);
                        $totprezzo=$gioco ['Prezzo'] * $Id_gioco['quantita'];
                        $prezzototale=$totprezzo+$prezzototale;
                        $numeroprodotti = $Id_gioco['quantita'] + $numeroprodotti;               
                    }
                    
                }
            
                if ($quantitatotale>0){
                        $main -> setContent("Quantità_Carrello", $numeroprodotti);
                        $main -> setContent("Totale_Carrello", "€ ".$prezzototale);
                        $main -> setContent("Tasto_1",'Vai al Carrello');
                        $main -> setContent("Link_Tasto_1",'carrello.php');
                        $main -> setContent("Tasto_2","Procedi All' Ordine");
                        $main -> setContent("Link_Tasto_2",'cassa.php');
                }else{
                        $main -> setContent("hidden",'hidden');
                        $main -> setContent("Totale_Carrello",'0 €');
                        $main -> setContent("Quantità_Carrello",'0');
                        $main -> setContent("Tasto_1",'Vai al Carrello');
                        $main -> setContent("Link_Tasto_1",'carrello.php');
                        $main -> setContent("Tasto_2","Procedi All' Ordine");
                        $main -> setContent("Link_Tasto_2",'cassa.php');
                }
    }
?>
<?php

	require "include/dbms.inc.php";
	require "include/template.inc.php";

	$main = new Template("dtml/common-frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("dtml/shop-fullwidth.html"); 		// sottotemplate per la home

    if(!isset($_SESSION['Id_account'])){
        $main -> setContent('MyAccount','Accedi');
        $main -> setContent("Login-logout",'Registrati');
    }
    else{
        $main -> setContent('MyAccount','Il Mio Account');
        $main -> setContent('Login-logout','Logout');
    }   
    if($_GET["console"]=="Playstation4") $body -> setContent('conta','Oleee'); //CONTROLLARE PASSAGGIO PARAMETRI
    $query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Piattaforma = 'Playstation 4'";
	$result = $mysqli -> query($query);
	
	while($gioco = $result -> fetch_assoc()){

		$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
		$body -> setContent("Nome_articolo",$gioco['Nome']);
        $body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

		if($giocoPS4['Sconto'] > 0){

			$body -> setContent("Offerta","Offerta");
			$nuovoPrezzo = ($giocoPS4['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
			$nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
			$body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
			$body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
		}
		else $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);
	}

    $main->setContent("body", $body->get());
	$main->close();
?>
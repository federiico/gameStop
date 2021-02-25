<?php

	require "include/dbms.inc.php";
	require "include/template.inc.php";

	$main = new Template("dtml/common-frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("dtml/homepage.html"); 		// sottotemplate per la home

	if(!isset($_SESSION['Id_account'])){
        $main -> setContent('MyAccount','Accedi');
        $main -> setContent("Login-logout",'Registrati');
    }
    else{
        $main -> setContent('MyAccount','Il Mio Account');
        $main -> setContent('Login-logout','Logout');
    }

	
	$query = "SELECT Id_articolo,Nome,Prezzo,Sconto FROM Articolo WHERE Piattaforma = 'Playstation 4'";
	$result = $mysqli -> query($query);
	
	while($giocoPS4 = $result -> fetch_assoc()){

		$body -> setContent("Immagine_PS4","getImage.php?Id_articolo=".$giocoPS4['Id_articolo']);
		$body -> setContent("Nome_articolo_PS4",$giocoPS4['Nome']);

		if($giocoPS4['Sconto'] > 0){

			$body -> setContent("Offerta_PS4","Offerta");
			$nuovoPrezzo = ($giocoPS4['Prezzo'] - (($giocoPS4['Prezzo'] / 100) * $giocoPS4['Sconto'])); //prezzo scontato
			$nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
			$body -> setContent("Vecchio_prezzo_PS4","€ ".$giocoPS4['Prezzo']);
			$body -> setContent("Prezzo_corrente_PS4","€ ".$nuovoPrezzo);
		}
		else $body -> setContent("Prezzo_corrente_PS4","€ ".$giocoPS4['Prezzo']);
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
		else $body -> setContent("Prezzo_corrente_Xbox","€ ".$giocoXbox['Prezzo']);
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
		else $body -> setContent("Prezzo_corrente_Nintendo","€ ".$giocoNintendo['Prezzo']);
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
		else $body -> setContent("Prezzo_corrente_Pc","€ ".$giocoPc['Prezzo']);
	}

	
	$main->setContent("body", $body->get());
	$main->close();

?>
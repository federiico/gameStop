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

	$console=$_GET['console'];
	$categoria=$_GET['categoria'];

	//Giochi PlayStation4
    if($console =='PlayStation4'){
    	$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Piattaforma = 'PlayStation 4'";
		$result = $mysqli -> query($query);
	
			while($gioco = $result -> fetch_assoc()){

				$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
				$body -> setContent("Nome_articolo",$gioco['Nome']);
				$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

				if($gioco['Sconto'] > 0){

					$body -> setContent("Offerta","Offerta");
					$nuovoPrezzo = ($giocoPS4['Prezzo'] - (($gioco['Prezzo'] / 100) * $gioco['Sconto'])); //prezzo scontato
					$nuovoPrezzo = number_format((float)$nuovoPrezzo, 2, '.', ''); //approssimo a 2 cifre decimali
					$body -> setContent("Vecchio_prezzo","€ ".$gioco['Prezzo']);
					$body -> setContent("Prezzo_corrente","€ ".$nuovoPrezzo);
				}
				else $body -> setContent("Prezzo_corrente","€ ".$gioco['Prezzo']);

				$body -> setContent("Link_prodotto","dettagli-prodotto.php?Id_articolo=".$gioco['Id_articolo']);
				$body -> setContent("conta", $query['conta']);

			}

	}

	//Giochi Xbox
    if($console=='XboxOne'){

    	$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Piattaforma = 'Xbox One'";
		$result = $mysqli -> query($query);
	
			while($gioco = $result -> fetch_assoc()){

				$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
				$body -> setContent("Nome_articolo",$gioco['Nome']);
				$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

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

	//Giochi Nintendo
    if($console=='NintendoSwitch'){

    	$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Piattaforma = 'Nintendo Switch'";
		$result = $mysqli -> query($query);
	
			while($gioco = $result -> fetch_assoc()){

				$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
				$body -> setContent("Nome_articolo",$gioco['Nome']);
				$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

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

	//Giochi Pc
    if($console=='Pc'){

    	$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE Piattaforma = 'Pc'";
		$result = $mysqli -> query($query);
	
			while($gioco = $result -> fetch_assoc()){

				$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
				$body -> setContent("Nome_articolo",$gioco['Nome']);
				$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

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

		//Giochi x Categoria

		//Sport

		if($categoria=='Sport'){

			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Genere = 'Sport'";
			$result = $mysqli -> query($query);
		
				while($gioco = $result -> fetch_assoc()){
	
					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
	
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

		//Giochi Di Guida

		if($categoria=='GiochidiGuida'){

			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Genere = 'Giochi di guida'";
			$result = $mysqli -> query($query);
		
				while($gioco = $result -> fetch_assoc()){
	
					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
	
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

		//Action

		if($categoria=='Action'){

			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Genere = 'Action'";
			$result = $mysqli -> query($query);
		
				while($gioco = $result -> fetch_assoc()){
	
					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
	
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

		//Simulazione

		if($categoria=='Simulazione'){

			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Genere = 'Simulazione'";
			$result = $mysqli -> query($query);
		
				while($gioco = $result -> fetch_assoc()){
	
					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
	
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

		//RPG

		if($categoria=='RPG'){

			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Genere = 'RPG'";
			$result = $mysqli -> query($query);
		
				while($gioco = $result -> fetch_assoc()){
	
					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);
	
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


		//Sparatutto

		if($categoria=='Sparatutto'){

			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Genere = 'sparatutto'";
			$result = $mysqli -> query($query);

				while($gioco = $result -> fetch_assoc()){

					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

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



		//Console + Categoria
		/*if($console == "PlayStation4"){$console = "'Playstation 4'";}
		if($console == 'Xbox One'){$console = "'Xbox One'";}
		if($categoria == "Sport"){$categoria = "'Sport'";}
		if($console == 'PlayStation4'){$console = "'Playstation 4'";}
		
		if($console !=null && $categoria != null){
			$query = "SELECT Id_articolo,Nome,Prezzo,Sconto,Descrizione FROM Articolo WHERE  Piattaforma = "+ $console +" and Genere = "+ $categoria;
			$result = $mysqli -> query($query);

				while($gioco = $result -> fetch_assoc()){

					$body -> setContent("Immagine","getImage.php?Id_articolo=".$gioco['Id_articolo']);
					$body -> setContent("Nome_articolo",$gioco['Nome']);
					$body -> setContent("Descrizione_articolo",$gioco['Descrizione']);

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
		}*/		

    $main->setContent("body", $body->get());
	$main->close();
?>
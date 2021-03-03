<?php

    require "dbms.inc.php";

    session_start();

    $nome = $_POST['Nome'];
    $piattaforma = $_POST['Piattaforma'];
    $anno = $_POST['Anno'];
    $produttore = $_POST['Produttore'];
    $casa = $_POST['Casa'];
    $classificazione = $_POST['Classificazione'];
    $genere = $_POST['Genere'];
    $lingua = $_POST['Lingua'];
    $prezzo = $_POST['Prezzo'];
    $sconto = $_POST['Sconto'];
    $descrizione = $_POST['Descrizione'];
    $disponibilita = $_POST['Disponibilita'];

    
    if($nome != '' && $piattaforma != '' && $anno != '' && $produttore != '' && $casa != '' && $classificazione != '' && $genere != '' && $lingua != '' && $prezzo != '' && $sconto != '' && $descrizione != ''){

        $query = "SELECT * FROM Articolo 
                  WHERE Nome='".$nome."' AND Piattaforma='".$piattaforma."' AND Lingua='".$lingua."'";

        $result = $mysqli -> query($query);

        $sem = 0;

        if($result->num_rows == 0){
            
            $query = "INSERT INTO Articolo (Nome,Piattaforma,Anno,Produttore,Casa_sviluppatrice,Classificazione,Genere,Lingua,Prezzo,Sconto,Descrizione)
                      VALUES ('".$nome."','".$piattaforma."','".$anno."','".$produttore."','".$casa."','".$classificazione."','".$genere."','".$lingua."','".$prezzo."','".$sconto."','".$descrizione."')";

            $result = $mysqli -> query($query);
            
            if($result)
                $sem = 1;

            $id_articolo = $mysqli->insert_id;

            $query = "INSERT INTO Disponibilita (Id_articolo, Disponibilita) VALUES ('".$id_articolo."','".$disponibilita."')";
            $mysqli -> query($query);

            $query = "INSERT INTO Catalogo(Id_articolo, Disponibilita) VALUES ('".$id_articolo."','1')";
            $mysqli -> query($query);

        }
        else{

            $articolo = $result -> fetch_assoc();
            $id_articolo = $articolo['Id_articolo'];
            $query = "UPDATE Articolo SET Nome='".$nome."',Produttore='".$produttore."',Anno='".$anno."',Casa_sviluppatrice='".$casa."'
                      ,Classificazione='".$classificazione."',Genere='".$genere."',Lingua='".$lingua."',Prezzo='".$prezzo."',
                      Sconto='".$sconto."',Descrizione='".$descrizione."' 
                      WHERE Id_articolo='".$id_articolo."' ";

            $result = $mysqli -> query($query);

            if($result)
                $sem = 2;

            $query = "UPDATE Disponibilita SET Disponibilita='".$disponibilita."' WHERE Id_articolo='".$id_articolo."'";
            $mysqli -> query($query);

            $query = "UPDATE Catalogo SET Disponibilita='1' WHERE Id_articolo='".$id_articolo."'";
            $mysqli -> query($query);

        }

        if($sem > 0){

               
                $query = "SELECT Id_immagine FROM Immagine ORDER BY (Id_immagine) DESC LIMIT 4";
                $result = $mysqli -> query($query);

                while($immagine = $result -> fetch_assoc()){

                    $query = "INSERT INTO Immagine_articolo (Id_articolo, Id_immagine) 
                              VALUES ('".$id_articolo."','".$immagine['Id_immagine']."') ";

                    $result2 = $mysqli -> query($query);
                }

                if($result2)
                    header("Location: ../catalogo.php");
                else header("Location: ../aggiungi-articolo.php?Error=query");
        }
        else header("Location: ../aggiungi-articolo.php?Error=query");
    }
    else header("Location: ../aggiungi-articolo.php?Error=campo_vuoto");

?>
<?php

    require "dbms.inc.php";

   /*$connect = new PDO("mysql:host=localhost;dbname=gamestop", "root", "");

    if(count($_FILES["immagine"]["tmp_name"]) > 0)
    {
        for($count = 0; $count < count($_FILES["immagine"]["tmp_name"]); $count++)
        {
        $image_file = addslashes(file_get_contents($_FILES["immagine"]["tmp_name"][$count]));
        $query = "INSERT INTO Immagine(Immagine) VALUES ('$image_file')";
        $statement = $connect->prepare($query);
        $statement->execute();
        }
    }*/
    $pic = base64_encode(file_get_contents($_FILES['immagine']['tmp_name']));

    $query = "INSERT INTO Immagine(Immagine) VALUES ('$pic')";

    $mysqli -> query($query);
    
    $query = "INSERT INTO Articolo (Nome, Piattaforma, Anno, Produttore, 'Casa sviluppatrice', Classificazione, Genere,
              Lingua, Prezzo, Sconto, Descrizione) VALUES ('".$_POST['Nome']."','".$_POST['Piattaforma']."','".$_POST['Anno']."',
              '".$_POST['Produttore']."','".$_POST['Sviluppatrice']."','".$_POST['Classificazione']."','".$_POST['Genere']."'
              ,'".$_POST['Lingua']."','".$_POST['Prezzo']."','".$_POST['Sconto']."','".$_POST['Descrizione']."' )";

   

    if( $mysqli -> query($query) != true){
        header("Location: ../errore.php");
    }

?>
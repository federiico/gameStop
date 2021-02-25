<?php 
    
    require "include/dbms.inc.php";

    $Id_articolo = $_GET['Id_articolo'];
    //$Id_articolo = 1;
    

    $query = "SELECT Immagine 
    FROM Immagine_articolo,Articolo,Immagine
    WHERE Articolo.Id_articolo = Immagine_articolo.Id_articolo
    AND Immagine.Id_immagine = Immagine_articolo.Id_immagine
    AND Articolo.Id_articolo ='".$Id_articolo."'
    LIMIT 1";

    $result = $mysqli -> query($query);
   
    while($data = $result -> fetch_assoc()){
        header("Content-type: image/jpeg");
        echo $data['Immagine'];
    }

?>
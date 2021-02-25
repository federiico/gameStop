<?php 
    
    require "include/dbms.inc.php";

    if(isset($_GET['Id_articolo'])){

        $Id_articolo = $_GET['Id_articolo'];
        
        $query = "SELECT Immagine 
                  FROM Immagine_articolo,Articolo,Immagine
                  WHERE Articolo.Id_articolo = Immagine_articolo.Id_articolo
                  AND Immagine.Id_immagine = Immagine_articolo.Id_immagine
                  AND Articolo.Id_articolo ='".$Id_articolo."'
                  LIMIT 1";
    }
    else if(isset($_GET['Id_immagine'])){

        $Id_immagine = $_GET['Id_immagine'];

        $query = "SELECT Immagine FROM Immagine WHERE Id_immagine='".$Id_immagine."'";

    }   

    

    $result = $mysqli -> query($query);
   
    while($data = $result -> fetch_assoc()){
        header("Content-type: image/jpeg");
        echo $data['Immagine'];
    }

?>
<?php 
    
    require "include/dbms.inc.php";

   
        
        $query = "SELECT Immagine 
                  FROM Immagine WHERE Id_immagine = 151";
 

    

    $result = $mysqli -> query($query);
   
    while($data = $result -> fetch_assoc()){
        header("Content-type: image/jpeg");
        echo $data['Immagine'];
    }

?>
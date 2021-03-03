<?php

    $connect = new PDO("mysql:host=localhost;dbname=gamestop", "root", "");

    if(count($_FILES["immagine"]["tmp_name"]) > 0)
    {
        for($count = 0; $count < count($_FILES["immagine"]["tmp_name"]); $count++)
        {
        $image_file = addslashes(file_get_contents($_FILES["immagine"]["tmp_name"][$count]));
        $query = "INSERT INTO Immagine(Immagine) VALUES ('$image_file')";
        $statement = $connect->prepare($query);
        $statement->execute();
        }
        $connect = null;
    }
   
?>
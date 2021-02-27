<?php

    require "dbms.inc.php";

    $query = "DELETE FROM Indirizzo_spedizione WHERE Id_spedizione='".$_GET['Id_indirizzo']."' ";

    if($mysqli -> query($query) == true){

        header("Location: ../my-account.php");
    }
    else header("Location: ../my-account.php?Error=address_error");



?>
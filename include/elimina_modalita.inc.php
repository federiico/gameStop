<?php

    require "dbms.inc.php";

    $query = "DELETE FROM Modalita_pagamento WHERE Id='".$_GET['Id_modalita']."' ";

    if($mysqli -> query($query) == true){

        header("Location: ../my-account.php");
    }
    else header("Location: ../my-account.php?Error=payment_error");



?>
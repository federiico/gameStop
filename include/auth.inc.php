<?php

    require "dbms.inc.php";

    if(isset($_SESSION['Id_utente'])){

        $query = "SELECT Servizio.Script 
                  FROM Gruppo_utente,Gruppo_servizio,Servizio 
                  WHERE Gruppo_servizio.Id_gruppo = Gruppo_utente.Id_gruppo 
                  AND Gruppo_servizio.Id_servizio = Servizio.Id_script 
                  AND Gruppo_utente.Id_utente ='".$_SESSION['Id_utente']."'";
    
        $result = $mysqli -> query($query);
        $autenticazione = false;
        

        while($script = $result -> fetch_assoc()){
           
            if($script['Script'] == $_SERVER['Script'])
                $autenticazione = true;
        }
      
    }
    else{ 

        
        if($_SERVER['Script'] == "homepage.php" | $_SERVER['Script'] == "shop-page.php" | $_SERVER['Script'] == "dettagli-prodotto.php"
            | $_SERVER['Script'] == "login.php" | $_SERVER['Script'] == "registrazione.php")
            $autenticazione = true;
        else $autenticazione = false;
    }
    
        
    
?>
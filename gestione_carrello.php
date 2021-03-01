<?php

    session_start();

    $page = $_SERVER["HTTP_REFERER"];
    $gioco = $_GET["gioco"];
    $azione = $_GET["azione"];
    $aggiunto = null;

    if(isset($_SESSION['Id_utente'])){  

        if($azione == "add"){
            $quantita = $_GET["quantita"];
            foreach ($_SESSION['Carrello'] as &$carrello) {

                if($carrello['Id_articolo']==$gioco){
                    
                    $carrello['quantita']=$carrello['quantita'] + $quantita;
                    $aggiunto = 1;
                }
            }
                if($carrello['Id_articolo']!=$gioco && $aggiunto != 1){

                    $_SESSION["Carrello"][]=array('Id_articolo'=> $gioco, 'quantita'=> $quantita);
                    $aggiunto = 0;
            }
            header("Location: $page");
        }

        if($azione == "del"){

            foreach ($_SESSION['Carrello'] as &$carrello) {
                
                if($carrello['Id_articolo']==$gioco){
                    if($carrello['quantita']>0){ 
                        $carrello['quantita']=$carrello['quantita']-1;
                    }
                    if($carrello['quantita']==0){
                        unset( $carrello['Id_articolo'] );
                    } 
                }
               header("Location: $page");
            }
        }

        }else{

            header("Location: login.php");
    
    }
?>
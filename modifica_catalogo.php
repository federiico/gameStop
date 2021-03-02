<?php
    $_SERVER['Script'] = "aggiungi-modalita.php";

	require "include/dbms.inc.php";
	require "include/template.inc.php";
    
    require "component/common-frame.comp.php";
    require "component/modifica_catalogo.comp.php";
    
    $main->setContent("body", $body->get());
	$main->close();

?>
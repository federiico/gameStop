<?php

    $_SERVER['Script'] = "registrazione.php";

	require "include/dbms.inc.php";
	require "include/template.inc.php";
    
    require "component/common-frame.comp.php";

    require "component/registrazione.comp.php";
    
    $main->setContent("body", $body->get());
	$main->close();
?>

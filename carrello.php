<?php
	$_SERVER['Script'] = "carrello.php";
    require "include/dbms.inc.php";
    require "include/template.inc.php";

    require "component/common-frame.comp.php";
    require "component/carrello.comp.php";


    $main->setContent("body", $body->get());
    $main->close();

?>
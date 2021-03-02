<?php
	$_SERVER['Script'] = "catalogo.php";

    require "include/dbms.inc.php";
    require "include/template.inc.php";

    require "component/common-frame.comp.php";
    require "component/catalogo.comp.php";


    $main->setContent("body", $body->get());
    $main->close();

?>
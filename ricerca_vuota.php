<?php
	
require "include/dbms.inc.php";
require "include/template.inc.php";

require "component/common-frame.comp.php";
require "component/ricerca_vuota.comp.php";


$main->setContent("body", $body->get());
$main->close();

?>
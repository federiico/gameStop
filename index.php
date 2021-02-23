<?php

	require "include/dbms.inc.php";
	require "include/template.inc.php";

	$main = new Template("dtml/common-frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("dtml/homepage.html"); 		// sottotemplate per la home

	/* banner section */

	/*$result = $mysqli->query("
		SELECT *
		FROM articolo");

	while ($data = $result->fetch_assoc()) {
		foreach($data as $key => $value) {
			$body->setContent($key, $value);
		}
	};*/

	
	$main->setContent("body", $body->get());
	$main->close();

?>
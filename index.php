<?php

	
	require "include/template.inc.php";

	$main = new Template("dtml/common-frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("dtml/homepage.html"); 		// sottotemplate per la home

	/* banner section */

	/*$result = $mysqli->query("
		SELECT news.id AS news_id,
			   news.title AS news_title,
		       category.name AS category_name
		FROM news 
		LEFT JOIN category
        ON category.id = news.category
	    ORDER BY date DESC");

	while ($data = $result->fetch_assoc()) {
		foreach($data as $key => $value) {
			$body->setContent($key, $value);
		}
	};*/

	
	$main->setContent("body", $body->get());
	$main->close();

?>
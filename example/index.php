<?php

include_once "../vendor/autoload.php";

use intrawarez\slim3annotations\AnnotatedApp;

$container = [
	
		"settings" => [
		
			"namespaces" => [
					
					"intrawarez\\slim3annotations\\example\\controllers\\" => __DIR__."/controllers"
					
			]
				
		]
		
];

$app = AnnotatedApp::from($container);

$app->run();

?>
<?php

include_once "../vendor/autoload.php";

use intrawarez\slim\annotations\AnnotatedApp;

$container = [
	
		"settings" => [
		
			"namespaces" => [
					
					"intrawarez\\slim\\annotations\\example\\controllers\\" => "./src/intrawarez/slim/annotations/example/controllers"
					
			]
				
		]
		
];

$app = AnnotatedApp::from($container);

$app->run();

?>
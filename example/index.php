<?php

include_once "../vendor/autoload.php";

use intrawarez\slim3annotations\AnnotatedApp;

$container = [
	
		"settings" => [
		
			"namespaces" => [
					
					"intrawarez\\slim3annotations\\example\\controllers\\" => "./src/intrawarez/slim3annotations/example/controllers"
					
			]
				
		]
		
];

$app = AnnotatedApp::from($container);

$app->run();

?>
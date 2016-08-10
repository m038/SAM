<?php

include_once "../vendor/autoload.php";

use intrawarez\slim\annotations\AnnotatedApp;


$app = AnnotatedApp::from([], [
		"intrawarez\\slim\\annotations\\example\\controllers\\" => "../src/intrawarez/slim/annotations/example/controllers"
]);

$app->run();

?>
[![Build Status](https://travis-ci.org/IntraWarez/slim-annotations.svg?branch=master)](https://travis-ci.org/IntraWarez/slim-annotations)
[![Coverage Status](https://coveralls.io/repos/github/IntraWarez/slim-annotations/badge.svg?branch=master)](https://coveralls.io/github/IntraWarez/slim-annotations?branch=master)
[![Latest Stable Version](https://poser.pugx.org/intrawarez/slim-annotations/v/stable)](https://packagist.org/packages/intrawarez/slim-annotations)
[![License](https://poser.pugx.org/intrawarez/slim-annotations/license)](https://packagist.org/packages/intrawarez/slim-annotations)


# [slim-annotations](https://intrawarez.github.io/slim-annotations/)
Annotations for [Slim](http://www.slimframework.com/).

## Features

Annotation markup currently supports:
- automated ```App::group```-mapping for classes and methods
- automated Dependency Injection for properties

## Installation

```
composer require intrawarez/slim-annotations
```

## Documentation

Documentation can be found [here](http://intrawarez.github.io/slim-annotations/docs/).

## Usage

**DISCLAIMER:** This sections is at Draft Level!

### Setup

#### settings.php
```php
return [

		"@namespaces" => [
				
				"intrawarez\\slim3annotations\\example\\controllers\\" => __DIR__."/controllers"
				
		],
		
		...
		
];
```

#### index.php
```php
use intrawarez\slimannotations\App;

$settings = require __DIR__ . "/path/to/settings.php";

$app = App::create($settings);

...

$app->run();
```

### Groups

#### dependencies.php
```php
$container["twig"] = function (Slim\Container $c) {

	$settings = $c->get("settings");

	$templatePath = $settings["renderer"]["template_path"];

	$loader = new Twig_Loader_Filesystem($templatePath);

	$twig = new Twig_Environment($loader);
	$twig->addGlobal("basePath", dirname($_SERVER["SCRIPT_NAME"]));

	return $twig;

};
```

#### Hello.php
```php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\Dependency;
use intrawarez\slimannotations\annotations\GET;

/** Group(pattern="/") */
class Hello {

	/** @Dependency(id="twig") */
	private $twig;
	
	/** @GET */   
	public function foo (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		
		$res->getBody()->write($this->twig->render("index.twig",[
			"hello" => "World"
		]));
			
		return $res;
		
	}

}

```


## License

The MIT License (MIT)

Copyright (c) 2016 Maximilian Meffert

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

[https://opensource.org/licenses/MIT](https://opensource.org/licenses/MIT)

[![Build Status](https://travis-ci.org/IntraWarez/SAM.svg?branch=master)](https://travis-ci.org/IntraWarez/SAM)
[![Coverage Status](https://coveralls.io/repos/github/IntraWarez/SAM/badge.svg?branch=master)](https://coveralls.io/github/IntraWarez/SAM?branch=master)
[![Latest Stable Version](https://poser.pugx.org/intrawarez/SAM/v/stable)](https://packagist.org/packages/intrawarez/SAM)
[![License](https://poser.pugx.org/intrawarez/SAM/license)](https://packagist.org/packages/intrawarez/SAM)


# [SAM](https://intrawarez.github.io/SAM/) - Slim Annotation Mapping
Annotation driven mapping for [Slim](http://www.slimframework.com/).

## Features

Annotation markup currently supports:
- Group-Mapping for classes using ```@Group``` 
- Action-Mapping for classes or methods using ```@GET```, ```@POST```, ```@PUT```, etc. 
- Middleware-Mapping for classes or methods using ```@Middleware``` 
- Dependency-Mapping for properties using ```@Dependency``` (facilitates automated dependency injection of container elements as class properties)

## Installation

```
composer require intrawarez/slam
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
				
				"intrawarez\\slimannotations\\example\\controllers\\" => __DIR__."/controllers"
				
		],
		
		...
		
];
```

#### index.php
```php
use intrawarez\slam\App;

$settings = require __DIR__ . "/path/to/settings.php";

$app = App::create($settings);

...

$app->run();
```

### Group-Mapping
**MyGroup.php**
```php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use intrawarez\slam\annotations as SLAM;

/** @SLAM\Group(pattern="/hello") */
class MyGroup {
	
	/** @SLAM\GET */   
	public function doFoo (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		...
	}
	
	/** @SLAM\POST(pattern="/bar") */   
	public function doBar (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		...
	}

}
```


### Action-Mapping
**MyAction.php**
```php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use intrawarez\slam\annotations as SLAM;

/** @SLAM\GET(pattern="/hello") */
class MyAction {
	  
	public function __invoke (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		...
	}

}
```

### Middleware-Mapping
**MyGroup.php**
```php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use intrawarez\slam\annotations as SLAM;

/** @SLAM\Group(pattern="/hello")
 *  @SLAM\Middleware(class="\\namespace\\of\\MyMiddlwareClass")
 */
class MyGroup {
	
/** @SLAM\GET 
 *  @SLAM\Middleware(callback="\\namespace\\of\\MyMiddlwareCallback")
 */   
	public function doFoo (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		...
	}

}
```

### Dependency-Mapping
**dependencies.php**
```php
$container["MyDependency"] = function (Slim\Container $c) {
	...
};
```
**MyController.php**
```php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use intrawarez\slam\annotations as SLAM;

class MyController {
	  
	/** @SLAM\Dependency(id="MyDependency") */
	private $myDependency;

}
```


## License

The MIT License (MIT)

Copyright (c) 2016 Maximilian Meffert

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

[https://opensource.org/licenses/MIT](https://opensource.org/licenses/MIT)

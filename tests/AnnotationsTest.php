<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\Middleware;
use intrawarez\slimannotations\annotations\Dependency;
use intrawarez\slimannotations\annotations\Action;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\annotations\Annotations;
use intrawarez\sabertooth\optionals\OptionalInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;

include_once __DIR__."/dummies/DummyNotAnnotatedClass.php";
include_once __DIR__."/dummies/DummyAnnotatedClass.php";

class AnnotationsTest extends TestCase
{
}

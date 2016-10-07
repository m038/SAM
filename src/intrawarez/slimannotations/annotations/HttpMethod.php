<?php
namespace intrawarez\slimannotations\annotations;

/**
 * The base class for HTTP method annotation handlers.
 *
 * @author maxmeffert
 */
abstract class HttpMethod implements SlimAnnotation
{

    public $pattern = "";
}

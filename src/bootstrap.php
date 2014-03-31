<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__).'/../'));

$loader = require_once dirname(__FILE__).'/../vendor/autoload.php';
$loader->add('TripleI\Weather', dirname(__FILE__));


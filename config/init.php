<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/ishop/core');
define("LIBS", ROOT . '/vendor/ishop/core/libs');
define("CACHE", ROOT . '/tmp/cache');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'watches');

$rootUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$rootUrl .= $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$rootUrl = preg_replace("#[^/]+$#", '', $rootUrl);
//http://ishop.loc  ||  //https://ishop.loc
$rootUrl = str_replace('/public/', '', $rootUrl);

define("SITE_URL", $rootUrl);
define("ADMIN", SITE_URL . '/admin');

require_once ROOT . '/vendor/autoload.php';
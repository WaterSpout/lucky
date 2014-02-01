<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
if(isset($_REQUEST['auth']) AND $_REQUEST['auth'] == '99ef8a146258e11acf32c1012ad0c7db9') {
	setcookie("mauth", 'ISAUTH1146258e1199ef', time()+60*60*24*30, "/");
}
if($_COOKIE['mauth'] != 'ISAUTH1146258e1199ef') {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file.');
}
$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

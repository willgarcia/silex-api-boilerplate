<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

$app = require_once __DIR__ . '/../app/app.php';

if (!$app instanceof HttpKernelInterface) {
    throw new \Exception('Unable to initialize application');
}

$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();
$app->terminate($request, $response);

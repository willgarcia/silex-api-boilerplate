<?php

require_once __DIR__.'/../vendor/autoload.php';

use Api\Api;

$app = new Api();
$app['debug'] = true;
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/app.log',
));

$app
    ->get('/test/{name}', 'Api\Controller\ApiController::indexAction')
;

return $app;
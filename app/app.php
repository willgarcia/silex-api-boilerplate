<?php

date_default_timezone_set('Europe/Paris');

require_once __DIR__.'/../vendor/autoload.php';

use Api\Api;

$app = new Api();
$app['debug'] = true;
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/app.log',
));

$app
    ->get('/', 'Api\Controller\ApiController::indexAction')
;

return $app;
<?php

date_default_timezone_set('Europe/Paris');

require_once __DIR__.'/../vendor/autoload.php';
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');

$app = new Api\Application();

// environments
$app['debug'] = getenv('API_ENV') != false;
$app = require __DIR__ . '/env_' . (($app['debug']) ? 'dev' : 'prod') . '.php';

// container services
$app = require __DIR__ . '/services.php';

// routing
$app = require __DIR__ . '/routing.php';

// middlewares: authentication, vnd errors
$app = require __DIR__ . '/middlewares.php';

return $app;

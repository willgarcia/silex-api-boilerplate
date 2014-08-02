<?php

$app['exception_handler']->disable();

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/api_prod.log',
));

return $app;

<?php

$app['debug'] = true;

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/api_dev.log',
));

$credentialsProvider = function ($id) {
    if ('dh37fgj492je' === $id) {
        return new Dflydev\Hawk\Credentials\Credentials(
            'werxhqb98rpaxn39848xrunpaw3489ruxnpa98w4rxn',
            'sha256',
            'dh37fgj492je'
        );
    }
};

return $app;

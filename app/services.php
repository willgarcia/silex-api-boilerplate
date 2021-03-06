<?php

use Api\Lib\VndErrors;

$app['serializer'] = $app->share(function () use ($app) {

    return Hateoas\HateoasBuilder::create()
        ->setDebug($app['debug'])
        ->build();
});

$app['vnd.errors'] = $app->share(function () {
    return (new VndErrors())
        ->build();
});

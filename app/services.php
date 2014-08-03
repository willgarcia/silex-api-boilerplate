<?php

$app['serializer'] = $app->share(function () use ($app) {
    return Hateoas\HateoasBuilder::create()
        ->setDebug($app['debug'])
        ->build();
});

return $app;

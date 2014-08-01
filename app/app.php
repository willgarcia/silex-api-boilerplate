<?php

date_default_timezone_set('Europe/Paris');

require_once __DIR__.'/../vendor/autoload.php';
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');

use Api\Api;
use Dflydev\Hawk\Credentials\Credentials;
use Stack\Builder;

$app = new Api();
$app['debug'] = getenv('API_ENV') != false;

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/app.log',
));


$app['serializer'] = $app->share(function () use ($app) {
    return Hateoas\HateoasBuilder::create()
        ->setDebug($app['debug'])
        //->setDefaultJsonSerializer()
        ->build();
});

$app->get('/', 'Api\Controller\ApiController::indexAction');
$app->get('/api', 'Api\Controller\ApiController::indexAction');

$app->get('/api/versions', 'Api\Controller\VersionsController::indexAction');

$app->get('/api/errors', 'Api\Controller\ErrorsController::indexAction');
$app->get('/api/errors/{code}', 'Api\Controller\ErrorsController::detailAction');

$app->get('/api/{version}/customers', 'Api\Controller\CustomersController::indexAction');
$app->get('/api/{version}/customers/{cid}', 'Api\Controller\CustomersController::detailAction');
$app->get('/api/{version}/customers/{cid}/licenses', 'Api\Controller\CustomersController::licensesAction');
$app->get('/api/{version}/customers/{cid}/licenses/{lid}', 'Api\Controller\CustomersController::licensesDetailAction');

$credentialsProvider = function ($id) {
    $validCredentials = new Credentials('test-key', 'sha256');
    if ($validCredentials === $id) {

        return $validCredentials;
    }
};

$stack = (new Builder())
    ->push('Dflydev\Stack\Hawk', [
        'firewall' => [
            ['path' => '/api/customers'],
        ],
        'credentials_provider' => $credentialsProvider
    ])
;
$app = $stack->resolve($app);



/*

// Error handler
$app['exception_handler']->disable();
$app->error(function (\Exception $e, $code) use ($app) {
    if (405 === $code) {
        return new Response($e->getMessage(), 405, array_merge(
            $e->getHeaders(),
            [ 'Content-Type' => 'text/plain' ]
        ));
    }

    return $app['view_handler']->handle(
        new VndErrorRepresentation($e->getMessage()),
        $code
    );
});*/

return $app;
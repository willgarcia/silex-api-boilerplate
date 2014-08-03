<?php

use Symfony\Component\HttpFoundation\Response;

$app->get('/', 'Api\Controller\ApiController::indexAction');
$app->get('/api', 'Api\Controller\ApiController::indexAction');
$app->get('/api/errors', 'Api\Controller\ErrorsController::indexAction');
$app->get('/api/errors/{code}', 'Api\Controller\ErrorsController::detailAction');
$app->get('/api/customers', 'Api\Controller\CustomersController::indexAction');
$app->get('/api/customers/{cid}', 'Api\Controller\CustomersController::detailAction');
$app->get('/api/customers/{cid}/licenses', 'Api\Controller\CustomersController::licensesAction');
$app->get('/api/customers/{cid}/licenses/{lid}', 'Api\Controller\CustomersController::licensesDetailAction');

$app->error(function (\Exception $e, $code) use ($app) {
    if (405 === $code) {
        return new Response($e->getMessage(), 405, array_merge(
            $e->getHeaders(),
            [ 'Content-Type' => 'text/plain' ]
        ));
    }
});

return $app;

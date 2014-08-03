<?php

$app->get('/', 'Api\Controller\ApiController::indexAction');
$app->get('/api', 'Api\Controller\ApiController::indexAction');
$app->get('/api/versions', 'Api\Controller\VersionsController::indexAction');
$app->get('/api/errors', 'Api\Controller\ErrorsController::indexAction');
$app->get('/api/errors/{code}', 'Api\Controller\ErrorsController::detailAction');
$app->get('/api/{version}/customers', 'Api\Controller\CustomersController::indexAction');
$app->get('/api/{version}/customers/{cid}', 'Api\Controller\CustomersController::detailAction');
$app->get('/api/{version}/customers/{cid}/licenses', 'Api\Controller\CustomersController::licensesAction');
$app->get('/api/{version}/customers/{cid}/licenses/{lid}', 'Api\Controller\CustomersController::licensesDetailAction');

return $app;

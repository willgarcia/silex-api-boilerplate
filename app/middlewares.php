<?php

use Api\Lib\VndErrors;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->before(function (Request $request) use ($app) {

    if ($request->getMethod() === 'OPTIONS') {
        return;
    }

    if (false === $request->headers->has('Authorization')) {

        return new Response(
            $app['serializer']->serialize(
                $app['vnd.errors']->get(VndErrors::AUTH_NEEDED),
                'json'
            ),
            401,
            $request->headers->all()
        );
    }
});

if (true != $app['debug']) {
    $app->error(function (\Exception $e, $code) use ($app) {

        $headers = array('Content-Type' => 'text/plain');
        if (method_exists($e, 'getHeaders')) {
            $headers = $headers + $e->getHeaders();
        }

        return new Response($e->getMessage(), $code, $headers);
    });
}

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET,OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'accept, Authorization');
});

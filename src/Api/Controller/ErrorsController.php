<?php

namespace Api\Controller;

use Api\Lib\VndErrors;
use Hateoas\Representation\CollectionRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorsController
{
    public function indexAction(Request $request, Application $app)
    {
        return new Response(
                $app['serializer']->serialize(
                    new CollectionRepresentation($app['vnd.errors']->get()),
                    'json'
                )
        );
    }

    public function detailAction(Request $request, Application $app)
    {
        $vndError = $app['vnd.errors']->get($request->get('code'));
        $status = 200;

        if (false === $vndError) {
            $vndError = $app['vnd.errors']->get(VndErrors::UNKNOWN_ERROR);
            $status = 404;
        }

        return new Response(
            $app['serializer']->serialize(
                $vndError,
                'json'
            ),
            $status
        );
    }
}

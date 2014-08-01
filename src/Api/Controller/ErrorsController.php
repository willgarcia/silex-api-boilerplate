<?php

namespace Api\Controller;

use Api\Hateoas\Model\Error;
use Hateoas\Configuration\Relation;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\VndErrorRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorsController
{
    private function getVndErrors()
    {
        return array(
            new Error(
                'Authentication needed',
                0,
                new Relation('help', null, null, array('title' => 'Header missing.')),
                new Relation('describes', null, null, array('title' => 'The header \'Authorization\' must be defined (Authorization: apikey=XXX)'))
            ),
            new Error(
                'Authentication failed',
                1,
                new Relation('help', null, null, array('title' => 'Invalid API Key.')),
                new Relation('describes', null, null, array('title' => 'The API key provided was not valid or has expired.'))
            )
        );
    }

    public function indexAction(Request $request, Application $app)
    {
        return new Response(
                $app['serializer']->serialize(
                    new CollectionRepresentation($this->getVndErrors()),
                    'json'
                )
        );
    }

    public function detailAction(Request $request, Application $app)
    {
        $errors = $this->getVndErrors();
        $code = $request->get('code');

        if (false === isset($errors[$code])) {
            return new Response('', 404);
        }

        return new Response(
            $app['serializer']->serialize($errors[$code],
            'json'
            )
        );
    }
}
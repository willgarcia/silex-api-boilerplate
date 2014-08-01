<?php

namespace Api\Controller;

use Api\Hateoas\Model\EntryPoint;
use Api\Hateoas\Model\Version;
use Hateoas\Representation\CollectionRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{
    public function indexAction(Request $request, Application $app)
    {
        return $this->apiAction($request, $app);
    }

    public function apiAction(Request $request, Application $app)
    {
        return new Response($app['serializer']->serialize(new EntryPoint(), 'json'));
    }

}
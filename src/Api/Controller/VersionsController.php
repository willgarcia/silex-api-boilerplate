<?php

namespace Api\Controller;

use Api\Hateoas\Model\Version;
use Hateoas\Representation\CollectionRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VersionsController
{
    protected function getVersions()
    {
        return array(
            new Version(1),
        );
    }

    public function indexAction(Request $request, Application $app)
    {
        return new Response(
                $app['serializer']->serialize(
                    new CollectionRepresentation($this->getVersions()),
                    'json'
                )
        );
    }
}
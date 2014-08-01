<?php

namespace Api\Controller;

use Api\Hateoas\Model\Customer;
use Api\Hateoas\Model\Version;
use Hateoas\Representation\CollectionRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersController
{
    public function getCustomers()
    {
        return array(
            new Customer(12),
            new Customer(17)
        );
    }

    public function indexAction(Request $request, Application $app)
    {
        return new Response(
                $app['serializer']->serialize(
                    new CollectionRepresentation($this->getCustomers()),
                    'json'
                )
        );
    }

    public function detailAction(Request $request, Application $app)
    {
        return new Response(
            $app['serializer']->serialize(
                new Customer($request->get('cid')),
                'json'
            )
        );
    }


    public function licensesAction(Request $request, Application $app)
    {
        return new Response(
            $app['serializer']->serialize(
                new License($request->get('lid')),
                'json'
            )
        );
    }
}
<?php

namespace Api\Controller;

use Api\Hateoas\Model\Customer;
use Api\Hateoas\Model\License;
use Hateoas\Representation\CollectionRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersController
{
    private $versionCompatibility = 1;

    public function getCustomers()
    {
        return array(
            new Customer(
                12,
                $this->versionCompatibility
            ),
            new Customer(
                17,
                $this->versionCompatibility
            )
        );
    }

    public function getLicenses()
    {
        $customers = $this->getCustomers();

        return array(
            new License($customers[0], 1, 'bi'),
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
                new Customer($request->get('cid'), $this->versionCompatibility),
                'json'
            )
        );
    }

    public function licensesAction(Request $request, Application $app)
    {
        $licenses = array();

        foreach($this->getLicenses() as $license) {
            if ($license->getCustomer()->getId() == $request->get('cid')) {
                $licenses[] = $license;
            }
        }

        return new Response(
            $app['serializer']->serialize(
                new CollectionRepresentation($licenses),
                'json'
            )
        );
    }

    public function licensesDetailAction(Request $request, Application $app)
    {
        foreach($this->getLicenses() as $license) {
            if ($license->getCustomer()->getId() == $request->get('cid')
                && $license->getId() == $request->get('lid'))
            {
                return new Response(
                    $app['serializer']->serialize(
                        $license,
                        'json'
                    )
                );
            }
        }

        return new Response(
            '',
            404
        );
    }

}
<?php

namespace Api\Controller;

use Api\Lib\Hateoas\Model\Customer;
use Api\Lib\Hateoas\Model\License;
use Api\Lib\VndErrors;
use Hateoas\Representation\CollectionRepresentation;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersController
{
    private function getCustomers()
    {
        return array(
            new Customer(
                12,
                'Customer 12'
            ),
            new Customer(
                17,
                'Customer 17'
            )
        );
    }

    private function getCustomer($id)
    {
        foreach ($this->getCustomers() as $customer) {
            if ($customer->getId() == $id) {
                return $customer;
            }
        }

        return false;
    }

    public function getLicenses()
    {
        $customers = $this->getCustomers();

        return array(
            new License($customers[0], 1, 'software-1'),
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
        $customer = $this->getCustomer($request->get('cid'));

        if (false == $customer) {
            return new Response(
                $app['serializer']->serialize(
                    $app['vnd.errors']->get(VndErrors::ENTITY_NOTFOUND),
                    'json'
                ),
                404
            );
        }

        return new Response(
            $app['serializer']->serialize(
                $customer,
                'json'
            )
        );
    }

    public function licensesAction(Request $request, Application $app)
    {
        $licenses = array();

        foreach ($this->getLicenses() as $license) {
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
        foreach ($this->getLicenses() as $license) {
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
            $app['serializer']->serialize(
                $app['vnd.errors']->get(VndErrors::ENTITY_NOTFOUND),
                'json'
            ),
            404
        );
    }

}

<?php

namespace Api\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{
    public function indexAction(Request $request, Application $app)
    {
        $app->log(sprintf("Hello '%s'.", $request->get('name')));

        var_dump($request->get('name'));
        die("tata");
    }
}
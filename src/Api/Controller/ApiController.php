<?php

namespace Api\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function indexAction(Request $request, Application $app)
    {
        $app->log(sprintf("Hello '%s'.", $request->get('name')));

        die("tata");
    }
}
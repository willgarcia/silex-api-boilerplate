README
======

silex-api-boilerplate
---------------------

A starting point for building your RESTful API within a Silex application.

Prerequisites
-------------

* PHP >=5.4
* Grunt-cli >= 0.1.6

Components
----------

This project uses the following components:

* [Silex application](http://silex.sensiolabs.org/)
* [HATEOAS API](https://github.com/willdurand/Hateoas)
* [API key authentication](http://stackphp.com/middlewares/)
* [Monolog as a service provider](http://silex.sensiolabs.org/doc/providers/monolog.html)
* Functional tests with [Behat 3](https://github.com/Behat/Behat)

API
---

The provided API stands as an example, and supports the [HAL format](http://stateless.co/hal_specification.html).

API Endpoints (see `app/routing.php`) :

    /api
    /api/errors                         # API errors list
    /api/errors/{code}                  # API error description
    /api/customers                      # Customers list                ; secured route
    /api/customers/{cid}                # Customer informations         ; secured route
    /api/customers/{cid}/licenses       # Customer's licenses list      ; secured route
    /api/customers/{cid}/licenses/{lid} # Customer license informations ; secured route

Installation
------------

    $ composer create-project wooshell/silex-api-boilerplate my-new-api
    $ npm install
    $ grunt


Development
-----------

For development purposes only, you can serve the API by starting a PHP built-in web server:

    $ API_ENV=dev php -S 0.0.0.0:4000 web/index.php

See http://php.net/manual/en/features.commandline.webserver.php

From here, you can access to this URL: `http://localhost:4000`

Tests
-----

    $ bin/behat tests/functional/features/

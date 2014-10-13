README
======

[![Build Status](https://secure.travis-ci.org/willgarcia/silex-api-boilerplate.png)](http://travis-ci.org/willgarcia/silex-api-boilerplate) [![Dependency Status](https://www.versioneye.com/user/projects/543c0a73b2a9c5605f0003de/badge.svg?style=flat)](https://www.versioneye.com/user/projects/543c0a73b2a9c5605f0003de)

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
* [API key authentication]
* [Monolog as a service provider](http://silex.sensiolabs.org/doc/providers/monolog.html)
* Functional tests with [Behat 3](https://github.com/Behat/Behat)

API
---

The provided API stands as an example, and supports the [HAL format](http://stateless.co/hal_specification.html).

API Endpoints (see `app/routing.php`) :

    /api                                # API entry point               ; secured route
    /api/errors                         # API errors list               ; secured route
    /api/errors/{code}                  # API error description         ; secured route
    /api/customers                      # Customers list                ; secured route
    /api/customers/{cid}                # Customer informations         ; secured route
    /api/customers/{cid}/licenses       # Customer's licenses list      ; secured route
    /api/customers/{cid}/licenses/{lid} # Customer license informations ; secured route

Installation
------------

    $ composer create-project willgarcia/silex-api-boilerplate my-new-api -s dev
    $ npm install
    $ grunt


Development
-----------

For development purposes only, you can serve the API by starting a PHP built-in web server:

    $ cp app/env_dev.php-dist app/env_dev.php
    $ API_ENV=dev php -S 0.0.0.0:4000 web/index.php

See http://php.net/manual/en/features.commandline.webserver.php

From here, you can access to this URL: `http://localhost:4000`

Tests
-----

    $ bin/behat tests/functional/features/

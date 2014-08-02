# HAL kit

This repository provides a starting point for building your API with a Silex application. It uses:

* Silex application (http://silex.sensiolabs.org/)
* HATEOAS API (bundle Hateoas)
* API key authentication thanks to the Stackphp middleware Hawk (http://stackphp.com/middlewares/)
* Monolog as a service provider (http://silex.sensiolabs.org/doc/providers/monolog.html)
* Functional tests with Behat 3

And provides an example of API supporting the HAL format [http://stateless.co/hal_specification.html]

## Installation

```shell
composer create-project wooshell/silex-api-bootstrap my-new-api
```

## PHP built-in web server

```shell
API_ENV=dev php -S 0.0.0.0:4000 web/index.php
```

See http://php.net/manual/en/features.commandline.webserver.php

# API entry point

`http://localhost:4000`

# Tests

```shell
bin/behat tests/functional/features/
```

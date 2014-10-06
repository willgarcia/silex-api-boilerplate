<?php

namespace Api\Lib;

use Api\Lib\Hateoas\Model\Error;
use Hateoas\Configuration\Relation;

class VndErrors
{
    const AUTH_NEEDED = 0;
    const AUTH_FAILED = 1;
    const UNKNOWN_ERROR = 2;
    const ENTITY_NOTFOUND = 3;

    protected $errors = array();

    public function build()
    {
        $this->errors = array(
            new Error(
                'Authentication needed',
                self::AUTH_NEEDED,
                new Relation('help', null, null, array('title' => 'Header missing.')),
                new Relation('describes', null, null, array('title' => 'Authorization header must be defined.'))
            ),
            new Error(
                'Authentication failed',
                self::AUTH_FAILED,
                new Relation('help', null, null, array('title' => 'Bad URL or Invalid API Key.')),
                new Relation('describes', null, null, array('title' => 'The provided API URL is wrong / the provided API key is not valid or has expired.'))
            ),
            new Error(
                'Error does not exist',
                self::UNKNOWN_ERROR,
                new Relation('help', null, null, array('title' => 'Undefined error.')),
                new Relation('describes', null, null, array('title' => 'The provided error is not part of the API errors list.'))
            ),
            new Error(
                'Entity does not exist',
                self::ENTITY_NOTFOUND,
                new Relation('help', null, null, array('title' => 'Unknown entity.')),
                new Relation('describes', null, null, array('title' => 'The provided entity is not valid or has been deleted.'))
            )
        );

        return $this;
    }

    public function get($code = null)
    {
        if (null === $code) {
            return $this->errors;
        }

        foreach ($this->errors as $error) {
            if ($error->getLogref() == $code) {
                return $error;
            }
        }

        return false;
    }
}

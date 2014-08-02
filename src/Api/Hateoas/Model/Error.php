<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use Hateoas\Configuration\Relation;
use Hateoas\Representation\VndErrorRepresentation;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("errors")
 *
 * @Hateoas\Relation("self", href = "expr('/api/errors/' ~ object.getLogref())")
 */
class Error extends VndErrorRepresentation
{

    /**
     * @Serializer\Expose
     */
    private $message;

    /**
     * @Serializer\Expose
     */
    private $description;

    public function __construct($message, $logref = null, Relation $help = null, Relation $describes = null)
    {
        parent::__construct($message, $logref, $help, $describes);

        $attributes = $help->getAttributes();
        $this->message = (true === isset($attributes['title'])) ? $attributes['title'] : 'undefined';

        $attributes = $describes->getAttributes();
        $this->description = (true === isset($attributes['title'])) ? $attributes['title'] : 'undefined';
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

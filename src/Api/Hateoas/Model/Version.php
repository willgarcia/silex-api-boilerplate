<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("versions")
 *
 * @Hateoas\Relation("customers", href = "expr('/api/' ~ object.getId() ~ '/customers')")
 */
class Version
{
    /** @Serializer\XmlAttribute */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}

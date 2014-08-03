<?php

namespace Api\Lib\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("customers")
 *
 * @Hateoas\Relation("self", href = "expr('/api/customers/' ~ object.getId())")
 * @Hateoas\Relation("licenses", href = "expr('/api/customers/' ~ object.getId() ~ '/licenses' )")
 */
class Customer
{
    /** @Serializer\XmlAttribute */
    protected $id;

    /** @Serializer\XmlAttribute */
    protected $name;

    /** @Serializer\XmlAttribute */
    protected $updatedAt;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

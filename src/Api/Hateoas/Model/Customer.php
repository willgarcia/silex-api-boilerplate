<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("customers")
 *
 * @Hateoas\Relation("self", href = "expr('/api/' ~ object.getId() ~ '/customers/' ~ object.getId())")
 * @Hateoas\Relation("licenses", href = "expr('/api/' ~ object.getId() ~ '/customers/' ~ object.getId() ~ '/licenses' )")
 */
class Customer
{
    /** @Serializer\XmlAttribute */
    protected $id;
    protected $name;
    protected $updatedAt;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
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
<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("customers")
 *
 * @Hateoas\Relation("self", href = "expr('/api/' ~ object.getVersion() ~ '/customers/' ~ object.getId())")
 * @Hateoas\Relation("licenses", href = "expr('/api/' ~ object.getVersion() ~ '/customers/' ~ object.getId() ~ '/licenses' )")
 */
class Customer
{
    /** @Serializer\XmlAttribute */
    protected $id;
    protected $name;
    protected $updatedAt;

    private $version;

    public function __construct($id, $version)
    {
        $this->id = $id;
        $this->version = $version;
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

    public function getVersion()
    {
        return $this->version;
    }
}

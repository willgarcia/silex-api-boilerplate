<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("licenses")
 *
 * @Hateoas\Relation("self", href = "expr('/api/' ~ object.getCustomer().getVersion() ~ '/customers/' ~ object.getCustomer().getId() ~ '/licenses/' ~ object.getId())")
 * @Hateoas\Relation("download", href = "expr('/api/' ~ object.getCustomer().getVersion() ~ '/customers/' ~ object.getCustomer().getId() ~ '/licenses/' ~ object.getId() ~ '/download/')")
 * @Hateoas\Relation("delete", href = "expr('/api/' ~ object.getCustomer().getVersion() ~ '/customers/' ~ object.getCustomer().getId() ~ '/licenses/' ~ object.getId() ~ '/delete/')")
 * @Hateoas\Relation("update", href = "expr('/api/' ~ object.getCustomer().getVersion() ~ '/customers/' ~ object.getCustomer().getId() ~ '/licenses/' ~ object.getId() ~ '/update/')")
 *
 */
class License
{
    /** @Serializer\XmlAttribute */
    protected $id;
    protected $type;
    protected $size;
    protected $updatedAt;
    protected $md5;
    protected $contentType;

    /** @Serializer\Exclude */
    private $customer;

    public function __construct(Customer $customer, $id, $type)
    {
        $this->customer = $customer;
        $this->id = $id;
        $this->type = $type;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getMd5()
    {
        return $this->md5;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("licenses")
 *
 * @Hateoas\Relation("self", href = "expr('/api/' ~ object.getId() ~ '/customers/' ~ object.getId())")
 * @Hateoas\Relation("licenses", href = "expr('/api/' ~ object.getId() ~ '/customers/' ~ object.getId() ~ '/licenses' )")
 *
 *
 *
 * "self": "/api/customers/%my_sugar_id%/licenses/%id%",
"download": "/api/customers/%my_sugar_id%/licenses/%id%/download",
"multipart-download": "/api/customers/%my_sugar_id%/licenses/%id%/multipart-download",
"delete": "/api/customers/%my_sugar_id%/licenses/%id%/delete",
"update": "/api/customers/%my_sugar_id%/licenses/%id%/update",
 *
 */
class Customer
{
    /** @Serializer\XmlAttribute */
    protected $id;
    protected $type;
    protected $size;
    protected $updatedAt;
    protected $md5;
    protected $contentType;

}
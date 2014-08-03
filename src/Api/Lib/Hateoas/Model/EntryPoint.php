<?php

namespace Api\Lib\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("api")
 *
 * @Hateoas\Relation("customers", href = "/api/customers/")
 * @Hateoas\Relation("errorCodes", href = "/api/errors/")
 */
class EntryPoint
{
}

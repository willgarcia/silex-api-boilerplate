<?php

namespace Api\Hateoas\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("api")
 *
 * @Hateoas\Relation("versions", href = "/api/versions/")
 * @Hateoas\Relation("errorCodes", href = "/api/errors/")
 */
class EntryPoint
{
}

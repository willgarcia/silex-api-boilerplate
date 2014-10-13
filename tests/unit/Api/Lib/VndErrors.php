<?php
namespace tests\units\Api\Lib;

use mageekguy\atoum;
use \mock\Api\Lib\VndErrors as TestedClass;

require_once __DIR__ . '/../../bootstrap.php';

class VndErrors extends atoum\test
{
    public function testBuild()
    {
        $this
            ->if($testedClass = (new TestedClass())->build())
            ->then
                ->array($testedClass->get())->isNotEmpty()
                ->object($testedClass->get(TestedClass::AUTH_NEEDED))->isInstanceOf('\\Api\\Lib\\Hateoas\\Model\\Error')
                ->boolean($testedClass->get(-1))->isFalse()
        ;
    }
}
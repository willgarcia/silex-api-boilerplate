<?php
use mageekguy\atoum;
use mageekguy\atoum\report\fields\runner;

define('TESTS_DIRECTORY', __DIR__ . '/tests/unit');

$runner->setBootstrapFile(__DIR__ . '/tests/unit/bootstrap.php');
$runner->addTestsFromDirectory(TESTS_DIRECTORY);

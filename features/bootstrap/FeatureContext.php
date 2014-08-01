<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;
use Camspiers\JsonPretty\JsonPretty;
use JsonSchema\RefResolver;
use JsonSchema\Validator;

/**
 * Behat context class.
 */
class FeatureContext extends  MinkContext implements SnippetAcceptingContext
{
    protected $jsonPretty;

    public function __construct()
    {
        $this->jsonPretty = new JsonPretty();
    }

    /**
     * @Given I send a :arg1 request to :arg2
     */
    public function iSendARequestTo($method, $url)
    {
        $client = $this->getSession()->getDriver()->getClient();
        $client->followRedirects(false);
        $client->request($method, $this->locatePath($url));
        $client->followRedirects(true);
    }

    /**
     * @Given I send a :arg1 request to :arg2 with the api key :arg3
     */
    public function iSendARequestToWithTheApiKey($method, $url, $apiKey)
    {
        $client = $this->getSession()->getDriver()->getClient();
        $client->followRedirects(false);
        $client->request($method, $this->locatePath($url), array(), array(), array('HTTP_AUTHORIZATION' => 'apikey=' . $apiKey));
        $client->followRedirects(true);
    }

    /**
     * @Then the response content type should be JSON
     */
    public function theResponseContentTypeShouldBeJson()
    {
        $content = $this->getSession()->getPage()->getContent();

        if (false == json_decode($content)) {
            $message = 'The response content is not JSON encoded.';
            throw new ExpectationException($message, $this->getSession());
        }
    }

    /**
     * @Then /^the JSON response should be valid against:$/
     *
     * note: the config parameter %base_url% can be used in schema
     */
    public function theJSONResponseShouldBeValidAgainstPyString(PyStringNode $text)
    {
        $responseText = $this->getMink()->getSession()->getPage()->getContent();
        $schemaText = str_replace('%base_url%', $this->get('base_url'), $text->getRaw());
        $this->validateJSONSchema($schemaText, $responseText);
    }

    /**
     * @param string $schemaText
     * @param string $responseText
     * @throws ExpectationException
     */
    protected function validateJSONSchema($schemaText, $responseText)
    {
        $schema = json_decode($schemaText);
        $json = json_decode($responseText);

        if (null === $schema) {
            $message = sprintf("The schema isn't a valid JSON :\n%s", $schemaText);
            throw new ExpectationException($message, $this->getMink()->getSession());
        }

        if (null === $json) {
            $message = sprintf("The response isn't a valid JSON :\n%s", $responseText);
            throw new ExpectationException($message, $this->getMink()->getSession());
        }

        if (false !== strpos($schemaText, '$ref')) {
            //resolve $ref in json-schema : this requires a valid url in "id" main property
            //!beware the response headers must include 'Content-Type=application/schema+json'
            $refResolver = new RefResolver();
            $refResolver->resolve($schema);
        }

        $validator = new Validator();
        $validator->check($json, $schema);

        if (!$validator->isValid()) {

            $errors = array();
            foreach ($validator->getErrors() as $error) {
                $errors[] = vsprintf(' - %s %s', $error);
            }

            $message = sprintf("The response isn't valid against this json-schema :\n%s", implode(PHP_EOL, $errors));
            throw new ExpectationException($message, $this->getMink()->getSession());
        }
    }

    /**
     * Checks, whether the response content is equal to given text
     *
     * @Then /^the response should be equal to:$/
     */
    public function theResponseShouldBeEqualTo(PyStringNode $expected)
    {
        $expected = str_replace('\\"', '"', $expected);
        $actual   = $this->getSession()->getPage()->getContent();

        if ($expectedJson = @json_decode($expected, true)) {
            $expected = $this->jsonPretty->prettify($expectedJson);
        }

        if ($actualJson = @json_decode($actual, true)) {
            $actual = $this->jsonPretty->prettify($actualJson);
        }

        $message = sprintf('The string is not equal to the following response:%s%s', PHP_EOL, $actual);
        $this->assertEquals($expected, $actual, $message);
    }

    protected function assertEquals($expected, $actual, $message = null)
    {
        if ($expected != $actual) {
            if (is_null($message)) {
                $message = sprintf(
                    'The element "%s" is not equal to "%s"',
                    $actual,
                    $expected
                );
            }
            throw new ExpectationException($message, $this->getSession());
        }
    }
}

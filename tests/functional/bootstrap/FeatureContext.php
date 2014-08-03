<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;
use Camspiers\JsonPretty\JsonPretty;

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
     * @Given I send a :arg1 request to :arg2 with the API key :arg3
     */
    public function iSendARequestToWithTheApiKey($method, $url, $apiKey)
    {
        $credentials = new Dflydev\Hawk\Credentials\Credentials(
            'werxhqb98rpaxn39848xrunpaw3489ruxnpa98w4rxn',
            'sha256',
            'dh37fgj492je'
        );

        $client = Dflydev\Hawk\Client\ClientBuilder::create()
            ->build();

        $request = $client->createRequest(
            $credentials,
            'http://localhost:4000' . $url,
            $method
        );

        $client = $this->getSession()->getDriver()->getClient();
        $client->followRedirects(false);
        $client->request(
            $method,
            $this->locatePath($url),
            array(),
            array(),
            array(
                'HTTP_AUTHORIZATION' => $request->header()->fieldValue()
            )
        );
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

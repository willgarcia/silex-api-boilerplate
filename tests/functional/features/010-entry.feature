@api
Feature: Entry point

  Scenario: Entry point GET
    Given I send a "GET" request to "/" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
          "_links": {
              "customers": {
                  "href": "/api/customers/"
              },
              "errorCodes": {
                  "href": "/api/errors/"
              }
          }
      }
      """

@api
Feature: Entry point

  Scenario: Entry point GET
    Given I send a "GET" request to "/"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
          "_links": {
              "versions": {
                  "href": "/api/versions/"
              },
              "errorCodes": {
                  "href": "/api/errors/"
              }
          }
      }
      """

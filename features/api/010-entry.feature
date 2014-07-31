@api
Feature: Entry point

  Scenario: Entry point GET
    Given I send a "GET" request to "/api"
     Then the response should be in JSON
     Then the response code should be equal to "200"
     Then the response content should be equal to:
      """
      {
        "versions":
        {
          "_links": { "versions": "/api/versions" }
        }
      }
      """

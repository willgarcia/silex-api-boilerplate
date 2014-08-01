@api
Feature: Versions & Errors

  Scenario: Versions - List
    Given I send a "GET" request to "/api/versions"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
          "_embedded": {
              "items": [
                  {
                      "id": 1,
                      "_links": {
                          "models": {
                              "href": "/api/1"
                          }
                      }
                  }
              ]
          }
      }
      """

  Scenario: Version - Authenticated request - Bad credentials
    Given I send a "GET" request to "/api/1" with the api key "inexistant-key"
      And the response should be equal to:
    """
      {
        "code": 2,
        "key": "authentication-failed",
        "message" : "Authentication failed",
        "_links": { "self": "/api/errors/2" }
      }
      """

  Scenario: Version - Authenticated request - Success
    Given I send a "GET" request to "/api/1" with the api key "test-key"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
    """
      {
        "_links" : { "customers": "/api/customers" }
      }
      """

  Scenario: Version - 404
    Given I send a "GET" request to "/api/v2/"
     Then the response content type should be JSON
     Then the response status code should be 404

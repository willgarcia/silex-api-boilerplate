Feature: Versions & Errors

  Scenario: API - Versions
    Given I send a "GET" request to "/api/versions"
    Then the response should be in JSON
    Then the response code should be equal to "200"
    Then the response content should be equal to:
      [
        "version":
        {
          "id": "1.0",
          "_links":
          {
            "errors": "/api/1.0/errors"
            "self": "/api/1.0"
          }
        }
      ]

  Scenario: Errors
    Given I send a "GET" request to "/api/errors"
    Then the response should be in JSON
    Then the response code should be equal to "200"
    Then the response content should be equal to:
      [
        {
          "code": 1,
          "key": "authentication-needed",
          "cause": "Authentication needed: 'Authentication' header missing",
          "message": "Authentication needed",
          "_links": { "self": "/api/errors/1" }
        },
        {
          "code": 2,
          "key": "authentication-failed",
          "cause": "Authentication failed: bad token provided",
          "message": "Authentication failed",
          "_links": { "self": "/api/errors/2" }
        }
      ]

  Scenario: Error
    Given I send a "GET" request to "/api/errors/1"
    Then the response should be in JSON
    Then the response code should be equal to "200"
    Then the response content should be equal to:
      {
        "code": 1,
        "key": "authentication-needed",
        "technicalMessage": "Authentication needed: 'Authentication' header missing",
        "userMessage": "Authentication needed",
        "_links": { "self": "/api/errors/1" }
      }

  Scenario: Error - Not found
    Given I send a "GET" request to "/api/errors/-1"
    Then the response should be in JSON
    Then the response code should be equal to "404"

  Scenario: Version - Unauthenticated request
    Given I send a "GET" request to "/api/"
    Then the response should be in JSON
    Then the response code should be equal to "401"
    Then the response content should be equal to:
      {
        "code": 1,
        "key": "authentication-needed",
        "message": "Authentication needed",
        "_links": { "details": "/api/errors/1" }
      },

  Scenario: Version - Authenticated request - Bad credentials
    Given I send a "GET" request to "/api/v1" with an header "Authorization: Token MY-TOKEN"
    Then the response content should be equal to:
    Then the response should be in JSON
    Then the response code should be equal to "403"
    Then the response content should be equal to:
      {
        "code": 2,
        "key": "authentication-failed",
        "message" : "Authentication failed",
        "_links": { "self": "/api/errors/2" }
      }

  Scenario: Version - Authenticated request - Success
    Given I send a "GET" request to "/api/v1" with an header "Authorization: Token MY-TOKEN"
    Then the response content should be equal to:
    Then the response should be in JSON
    Then the response code should be equal to "403"
    Then the response content should be equal to:
      {
        "_links" : { "customers": "/api/customers" }
      }

  Scenario: Version - 404
    Given I send a "GET" request to "/api/v2/"
    Then the response should be in JSON
    Then the response code should be equal to "404"

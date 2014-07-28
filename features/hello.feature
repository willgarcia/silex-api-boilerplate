Feature: API

  Scenario: API Entry point
    Given I send a "GET" request to "http://localhost:4000/"
     Then the response should be in JSON
     Then the response should be equal to "200"

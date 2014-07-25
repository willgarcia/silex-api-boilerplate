# features/table.feature
Feature: Hello

  Scenario: Hello 1
    When I request "/hello/tata"
    Then the response status code should be 200
     And the response is JSON

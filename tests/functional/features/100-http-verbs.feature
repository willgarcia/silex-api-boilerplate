@api
Feature: HTTP Verbs

  Scenario Outline: Allowed HTTP methods
    Given I send a "POST" request to "<service>"
     Then the response status code should be 405

    Given I send a "PUT" request to "<service>"
     Then the response status code should be 405

    Given I send a "DELETE" request to "<service>"
     Then the response status code should be 405

    Given I send a "PATCH" request to "<service>"
     Then the response status code should be 405

    Given I send a "OPTIONS" request to "<service>"
     Then the response status code should be 405

    Given I send a "HEAD" request to "<service>"
     Then the response status code should be 405

    Given I send a "GET" request to "<service>"
     Then the response status code should not be 405

  Examples:
    | service                                            |
    | /api                                               |
    | /api/versions                                      |
    | /api/errors                                        |
    | /api/customers                                     |
    | /api/customers/%customer_id%                       |
    | /api/customers/%customer_id%/licenses              |
    | /api/customers/%customer_id%/licenses/%license_id% |




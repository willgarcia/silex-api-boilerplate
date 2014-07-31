@api
Feature: HTTP Verbs

  Scenario Outline: Allowed HTTP methods
    Given I send a "POST" request to <service>
     Then the response code should be equal to "405"

    Given I send a "PUT" request to <service>
     Then the response code should be equal to "405"

    Given I send a "DELETE" request to <service>
     Then the response code should be equal to "405"

    Given I send a "PATCH" request to <service>
     Then the response code should be equal to "405"

    Given I send a "OPTIONS" request to <service>
     Then the response code should be equal to "405"

    Given I send a "HEAD" request to "<service>
     Then the response code should be equal to "405"

    Given I send a "GET" request to "<service>
     Then the response code should not be equal to "405"

  Examples:
  | service                                            |
  | /api                                               |
  | /api/versions                                      |
  | /api/codes                                         |
  | /api/customers                                     |
  | /api/customers/%customer_id%                       |
  | /api/customers/%customer_id%/licenses              |
  | /api/customers/%customer_id%/licenses/%license_id% |




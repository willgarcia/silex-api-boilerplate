@api
Feature: Customer

  Scenario: Customer - Detail
    Given I send a "GET" request to "/api/customers/12" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
      	"id": 12,
      	"name": "Customer 12",
      	"_links": {
      		"self": {
      			"href": "\/api\/customers\/12"
      		},
      		"licenses": {
      			"href": "\/api\/customers\/12\/licenses"
      		}
      	}
      }
      """

  Scenario: Customer - Not found
    Given I send a "GET" request to "/api/customers/-1" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 404
      And the response should be equal to:
      """
      {
      	"message": "Unknown entity.",
      	"logref": 3,
      	"description": "The provided service does not exist or the service entity is not valid \/ has been deleted.",
      	"_links": {
      		"self": {
      			"href": "\/api\/errors\/3"
      		}
      	}
      }
      """


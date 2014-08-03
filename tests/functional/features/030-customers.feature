@api
Feature: Customers

  Scenario: Customers - unauthenticated request
    Given I send a "GET" request to "/api/customers"
     Then the response status code should be 401

  Scenario: Customers - list
    Given I send a "GET" request to "/api/customers" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
      	"_embedded": {
      		"items": [
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
      			},
      			{
      				"id": 17,
      				"name": "Customer 17",
      				"_links": {
      					"self": {
      						"href": "\/api\/customers\/17"
      					},
      					"licenses": {
      						"href": "\/api\/customers\/17\/licenses"
      					}
      				}
      			}
      		]
      	}
      }
      """

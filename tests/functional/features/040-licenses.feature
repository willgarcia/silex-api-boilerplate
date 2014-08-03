@api
Feature: Licenses

  Scenario: Licenses - list
    Given I send a "GET" request to "/api/customers/12/licenses" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
      	"_embedded": {
      		"items": [
      			{
      				"id": 1,
      				"type": "software-1",
      				"_links": {
      					"self": {
      						"href": "\/api\/customers\/12\/licenses\/1"
      					},
      					"download": {
      						"href": "\/api\/customers\/12\/licenses\/1\/download\/"
      					},
      					"delete": {
      						"href": "\/api\/customers\/12\/licenses\/1\/delete\/"
      					},
      					"update": {
      						"href": "\/api\/customers\/12\/licenses\/1\/update\/"
      					}
      				}
      			}
      		]
      	}
      }
      """

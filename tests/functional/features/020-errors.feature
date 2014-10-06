@api
Feature: Errors

  Scenario: Errors
    Given I send a "GET" request to "/api/errors" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
      	"_embedded": {
      		"items": [
      			{
      				"message": "Header missing.",
      				"logref": 0,
      				"description": "Authorization header must be defined.",
      				"_links": {
      					"self": {
      						"href": "\/api\/errors\/0"
      					}
      				}
      			},
      			{
      				"message": "Bad URL or Invalid API Key.",
      				"logref": 1,
      				"description": "The provided API URL is wrong \/ the provided API key is not valid or has expired.",
      				"_links": {
      					"self": {
      						"href": "\/api\/errors\/1"
      					}
      				}
      			},
      			{
      				"message": "Undefined error.",
      				"logref": 2,
      				"description": "The provided error is not part of the API errors list.",
      				"_links": {
      					"self": {
      						"href": "\/api\/errors\/2"
      					}
      				}
      			},
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
      		]
      	}
      }
      """

  Scenario: Error
    Given I send a "GET" request to "/api/errors/1" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
      {
      	"message": "Bad URL or Invalid API Key.",
      	"logref": 1,
      	"description": "The provided API URL is wrong \/ the provided API key is not valid or has expired.",
      	"_links": {
      		"self": {
      			"href": "\/api\/errors\/1"
      		}
      	}
      }
      """

  Scenario: Error - Not found
    Given I send a "GET" request to "/api/errors/-1" with the API key "dh37fgj492je"
     Then the response status code should be 404

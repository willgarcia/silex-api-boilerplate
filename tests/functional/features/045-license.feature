@api
Feature: License

  Scenario: License - Detail
    Given I send a "GET" request to "/api/customers/12/licenses/1" with the API key "dh37fgj492je"
     Then the response content type should be JSON
     Then the response status code should be 200
      And the response should be equal to:
      """
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
      """

  Scenario: License - Not found
    Given I send a "GET" request to "/api/customers/12/licenses/-1" with the API key "dh37fgj492je"
    Then the response content type should be JSON
    Then the response status code should be 404
    And the response should be equal to:
    """
    {
      	"message": "Unknown entity.",
      	"logref": 3,
      	"description": "The provided entity is not valid or has been deleted.",
      	"_links": {
      		"self": {
      			"href": "\/api\/errors\/3"
      		}
      	}
    }
    """

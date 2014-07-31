Feature: Customers

  Scenario: Customers
    Given I send a "GET" request to "/api/customers" with an header "Authorization: Token MY-TOKEN"
     Then the response should be in JSON
     Then the response code should be equal to "200"
     Then the response content should be equal to:
      [
        {
          "id": "%my_sugar_id%",
          "name": "My Customer",
          "updated_at": "2014-01-08"
          "_links":
            {
              "self": "/api/customers/%my_sugar_id%"
              "licenses": "/api/customers/%my_sugar_id%/licenses"
            }
        }
      ]
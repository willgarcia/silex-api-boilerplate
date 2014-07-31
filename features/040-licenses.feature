Feature: Licenses

  Scenario: Licenses
    Given I send a "GET" request to "/api/customers/%my_sugar_id%/licenses" with an header "Authorization: Token MY-TOKEN"
    Then the response should be in JSON
    Then the response code should be equal to "200"
    Then the response content should be equal to:
      [
        {
          "id": "%filename%"
          "type": "%bi/pmsi/bi-patch/pmsi-rootkit%",
          "size": "",
          "updated_at": "",
          "md5": "",
          "content-type": "application/zip"
          "_links":
          {
            "self": "/api/customers/%my_sugar_id%/licenses/%id%",
            "download": "/api/customers/%my_sugar_id%/licenses/%id%/download",
            "multipart-download": "/api/customers/%my_sugar_id%/licenses/%id%/multipart-download",
            "delete": "/api/customers/%my_sugar_id%/licenses/%id%/delete",
            "update": "/api/customers/%my_sugar_id%/licenses/%id%/update",
          }
        }
      ]

  Scenario: Licenses - Filter type
    Given I send a "GET" request to "/api/customers/%my_sugar_id%/licenses?filter=bi" with an header "Authorization: Token MY-TOKEN"
    Then the response should be in JSON
    Then the response code should be equal to "200"
    Then the response content should be equal to:
      [
        {
          "type": "%bi%",
          "size": "",
          "updated_at": "2014-01-08"
          "md5": "",
          "content-type": "application/zip"
          "_links":
          {
            "self": "/api/customers/%my_sugar_id%/licenses/%id%",
            "download": "/api/customers/%my_sugar_id%/licenses/%id%/download",
            "multipart-download": "/api/customers/%my_sugar_id%/licenses/%id%/multipart-download",
            "delete": "/api/customers/%my_sugar_id%/licenses/%id%/delete",
            "update": "/api/customers/%my_sugar_id%/licenses/%id%/update",
          }
        }
      ]

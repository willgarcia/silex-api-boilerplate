Feature: License

  Scenario: License - Detail
    Given I send a "GET" request to "/api/customers/%my_sugar_id%/licenses/%id%" with an header "Authorization: Token MY-TOKEN"
    Then the response should be in JSON
    Then the response code should be equal to "200"
    Then the response content should be equal to:
      {
        "type": "%bi/pmsi/bi-patch/pmsi-rootkit%",
        "size": "",
        "updated_at": "2014-01-08"
        "md5": "",
        "content-type": "application/zip"
        "_links":
        {
          "download": "/api/customers/%my_sugar_id%/licenses/%id%/download",
          "multipart-download": "/api/customers/%my_sugar_id%/licenses/%id%/multipart-download",
          "delete": "/api/customers/%my_sugar_id%/licenses/%id%/delete",
          "update": "/api/customers/%my_sugar_id%/licenses/%id%/update",
        }
      }

  Scenario: License - Not found
    Given I send a "GET" request to "/api/customers/%my_sugar_id%/licenses/%invalid_id%" with an header "Authorization: Token MY-TOKEN"
    Then the response should be in JSON
    Then the response code should be equal to "404"

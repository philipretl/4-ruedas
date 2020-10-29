<p align="center"><a href="https://venoudev.com/"><img src="https://venoudev.com/img/venoudev-2.png" width="200" alt="Mallpty"></a>
</p>

# API Docs list  owners.
### List registered owners in 4 ruedas.
- [Base Url](#base_url)
- [Request Parameters](#request_parameters)
- [Responses](#response)
- [Success Responses](#success)

<a name="base_url"></a>
## Base Url

```text
https://4ruedas.venoudev.com
```

<a name="request_parameters"></a>
## Request Parameters

### Endpoint

|Method|URI|
|:-|:-|:-|
|GET|`/api/v1/owner/list`|

|Headers|
|:-|
|[`Accept: application/json`]|

<a name="response"></a>

## Responses

<a name="success"></a>

> {success} Success Response

###Code `200` `Ok`

###Content

```json
{
    "success": true,
    "description": "Empty list of owners registered in 4 ruedas.",
    "data": {},
    "errors": [],
    "messages": [
        {
            "code_message": "EMPTY_LIST",
            "message": "Empty model list solicited."
        }
    ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`EMPTY_LIST`|Empty model list solicited.|

###Code `200` `Ok`

###Content

```json
{
      "success": true,
      "description": "List of owners registered in 4 ruedas.",
      "data": {
        "owners_paginated": {
          "owners": [
            {
              "id": 1,
              "full_name": "Prof. Boris Morissette  Murazik",
              "dni": 548431692
            },
            {
              "id": 2,
              "full_name": "Mr. Gerard Carroll II  Howell",
              "dni": 138593069
            },
            {
              "id": 3,
              "full_name": "Frederik Kilback  Greenholt",
              "dni": 363005147
            }
          ]
          "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://4ruedas.venoudev.com/api/v1/owner/list",
            "per_page": 15,
            "to": 3,
            "total": 3
          },
          "links": {
            "first": "http://4ruedas.venoudev.com/api/v1/owner/list?page=1",
            "last": "http://4ruedas.venoudev.com/api/v1/owner/list?page=1",
            "prev": null,
            "next": null
          }
        }
      },
      "errors": [],
      "messages": [
        {
          "message_code": "PAGINATED_LIST"
          "message": "Paginated model list"
        }
      ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`PAGINATED_LIST`|Paginated model list.|



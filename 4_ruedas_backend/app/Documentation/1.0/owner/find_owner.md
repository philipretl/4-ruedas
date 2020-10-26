<p align="center"><a href="https://venoudev.com/"><img src="https://venoudev.com/img/venoudev-2.png" width="200" alt="Mallpty"></a>
</p>

# API Docs find a owner.
### Find a registered owner in 4 ruedas.

- [Base Url](#base_url)
- [Request Parameters](#request_parameters)
- [Responses](#response)
- [Success Responses](#success)
- [Error Responses](#error)

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
|GET|`/api/v1/owner/find/{owner_id}`|

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
  "description": "Owner found in 4 ruedas successfully.",
  "data": {
    "owner": {
      "id": 1,
      "full_name": "Kaleigh Jenkins  Moen",
      "dni": 526174532,
      "user_id": 1,
      "vehicles":[
        {
          "id": 1,
          "brand": "laudantium brand",
          "model": "ut model",
          "vehicle_plate": "idq981",
          "type": "car"
        },
        {
          "id": 2,
          "brand": "placeat brand",
          "model": "enim model",
          "vehicle_plate": "uyv254",
          "type": "truck"
        },
        {
          "id": 3,
          "brand": "quis brand",
          "model": "iure model",
          "vehicle_plate": "nvn408",
          "type": "truck"
        }
      ]
    }
  },
  "errors": [],
  "messages": [
    {
      "message_code": "FOUND",
      "message": "Model Found."
    }
  ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`FOUND`|Model Found.|


<a name="error"></a>

> {danger} Error Response

###Code `400` `Bad Request`

###Content

```json
{
    "success": false,
    "description": "Exist conflict with the request, please check the errors or messages.",
    "data": {},
    "errors": [
        //errors
    ],
    "messages": [
        //messages
    ]
}
``` 

### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`NOT_FOUND`|Resource not found check your request data.|



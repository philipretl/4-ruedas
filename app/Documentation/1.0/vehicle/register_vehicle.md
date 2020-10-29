<p align="center"><a href="https://venoudev.com/"><img src="https://venoudev.com/img/venoudev-2.png" width="200" alt="Mallpty"></a>
</p>

# API Docs Store vehicle.
### It allows to register a new vehicle in 4 ruedas.
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
|POST|`/api/v1/vehicle/register`|

|Headers|
|:-|
|[`Accept: application/json`]|

### Body 

```text
{
    "vehicle_plate"         : "string", 
    "brand"                 : "string",
    "model"                 : "string",
    "type"                  : ['motorcyle', 'car', 'truck'],
    "owner_id"              : "Numeric" 
}
```

<a name="response"></a>

## Responses

<a name="success"></a>

> {success} Success Response

###Code `200` `Ok`

###Content

```json
{
    "success" : true,
    "description": "Vehicle registered in 4 ruedas successfully.",
    "data" : {
        "vehicle":{
            "id":1,
            "vehicle_plate": "DBA 191",
            "brand" : "Renault",
            "model" : "Sandero",
            "type"  : "car"
        },
        "errors":[],
        "messages":[
            {
                "message_code":"REGISTERED", 
                "message":"Process Completed."
            }
        ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`REGISTERED`|Process completed.|


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
|`CHECK_DATA`|The form has errors whit the inputs.|

### Errors

<larecipe-badge type="danger" circle icon="fa fa-exclamation-triangle"></larecipe-badge> 

|error_code|field|message|
|:-|:-|:-|
|`REQUIRED`|`vehicle_plate`|The vehicle plate field is required.|
|`REQUIRED`|`brand`|The brand field is required.|
|`REQUIRED`|`model`|The model field is required.|
|`REQUIRED`|`type`|The type field is required.|
|`REQUIRED`|`owner_id`|The owner id field is required.|
|`EXISTS`|`owner_id`|The selected owner id is invalid.|
|`UNIQUE`|`vehicle_plate`|The vehicle plate has al ready been taken.|
|`IN`|`type`|The selected type is invalid.|




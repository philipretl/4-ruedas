<p align="center"><a href="https://venoudev.com/"><img src="https://venoudev.com/img/venoudev-2.png" width="200" alt="Mallpty"></a>
</p>

# API Docs Update owner.
### It allows to update a new owner in 4 ruedas.
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
|POST|`/api/v1/owner/update/{owner_id}`|

|Headers|
|:-|
|[`Accept: application/json`]|

### Body 

```json
{
    "name"         : "string", 
    "last_name"    : "string",
    "dni"          : "numeric"
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
    "description": "Owner updated in 4 ruedas successfully.",
    "data" : {
        "owner":{
            "id":1,
            "full_name":"Juan Perez",
            "dni" : 1061737094
            
        },
        "errors":[],
        "messages":[
            {
                "message_code":"UPDATED", 
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
|`REQUIRED`|`name`|The name field is required.|
|`REQUIRED`|`last_name`|The last name field is required.|
|`REQUIRED`|`dni`|The dni field is required.|
|`UNIQUE`|`dni`|The dni has al ready been taken.|
|`NUMERIC`|`dni`|The dni must be a number.|




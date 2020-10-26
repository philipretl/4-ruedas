<p align="center"><a href="https://venoudev.com/"><img src="https://venoudev.com/img/venoudev-2.png" width="200" alt="Mallpty"></a>
</p>

# API Docs delete a owner.
### Delete a registered owner in 4 ruedas.

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
|PUT|`/api/v1/owner/delete/{owner_id}`|

|Headers|
|:-|
|[`Accept: application/json`]|

### Body 

```json
{
    "hard_delete"         : "boolean", 
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
    "description" : "Owner deleted in mallpty successfuly.",
    "data" : {},
    "errors" : [],
    "messages" : [
        {
            "message_code" : "DELETED", 
            "message" : "Process Completed."
        }
    ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`DELETED`|Process completed.|


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


# Landmarks

APIs for managing landmarks

## Tour list




> Example request:

```javascript
const url = new URL(
    "https://dc-history-tour.dedicateddevelopers.us/api/tour-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{
    "status": true,
    "code": 200,
    "message": "Landmark listing",
    "data": [
        {
            "id": 8,
            "title": "QA",
            "audio": "6214bbf764ed91645526007808878.mp3",
            "address": "Kolkata",
            "lat": "20",
            "lng": "25",
            "content": "Testing",
            "is_active": 1,
            "created_at": "2022-02-22T10:33:27.000000Z",
            "updated_at": "2022-02-22T10:33:27.000000Z",
            "landmark_image": [
                {
                    "id": 14,
                    "image": "6214bbf76b58d1645526007151796.jpg",
                    "is_featured": 0,
                    "landmark_id": 8,
                    "created_at": "2022-02-22T10:33:27.000000Z",
                    "updated_at": "2022-02-22T10:33:27.000000Z"
                }
            ]
        }
    ]
}
```
<div id="execution-results-GETapi-tour-list" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-tour-list"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tour-list"></code></pre>
</div>
<div id="execution-error-GETapi-tour-list" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tour-list"></code></pre>
</div>
<form id="form-GETapi-tour-list" data-method="GET" data-path="api/tour-list" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-tour-list', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-tour-list" onclick="tryItOut('GETapi-tour-list');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-tour-list" onclick="cancelTryOut('GETapi-tour-list');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-tour-list" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/tour-list</code></b>
</p>
</form>


## Tour details




> Example request:

```javascript
const url = new URL(
    "https://dc-history-tour.dedicateddevelopers.us/api/tour-details/rerum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{
    "status": true,
    "code": 200,
    "message": "Landmark details",
    "data": {
        "id": 8,
        "title": "QA",
        "audio": "6214bbf764ed91645526007808878.mp3",
        "address": "Kolkata",
        "lat": "20",
        "lng": "25",
        "content": "Testing",
        "is_active": 1,
        "created_at": "2022-02-22T10:33:27.000000Z",
        "updated_at": "2022-02-22T10:33:27.000000Z",
        "landmark_image": [
            {
                "id": 14,
                "image": "6214bbf76b58d1645526007151796.jpg",
                "is_featured": 0,
                "landmark_id": 8,
                "created_at": "2022-02-22T10:33:27.000000Z",
                "updated_at": "2022-02-22T10:33:27.000000Z"
            }
        ]
    }
}
```
<div id="execution-results-GETapi-tour-details--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-tour-details--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tour-details--id-"></code></pre>
</div>
<div id="execution-error-GETapi-tour-details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tour-details--id-"></code></pre>
</div>
<form id="form-GETapi-tour-details--id-" data-method="GET" data-path="api/tour-details/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-tour-details--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-tour-details--id-" onclick="tryItOut('GETapi-tour-details--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-tour-details--id-" onclick="cancelTryOut('GETapi-tour-details--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-tour-details--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/tour-details/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-tour-details--id-" data-component="url" required  hidden>
<br>
integer The ID of Landmark.
</p>
</form>


## Load Gen Form Submit




> Example request:

```javascript
const url = new URL(
    "https://dc-history-tour.dedicateddevelopers.us/api/submit-load-gen-form"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "vel",
    "last_name": "sunt",
    "phone": 14,
    "email": "vel",
    "locations": "est"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json
{
    "status": true,
    "code": 200,
    "message": "Submit successfully",
    "data": ""
}
```
<div id="execution-results-POSTapi-submit-load-gen-form" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-submit-load-gen-form"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-submit-load-gen-form"></code></pre>
</div>
<div id="execution-error-POSTapi-submit-load-gen-form" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-submit-load-gen-form"></code></pre>
</div>
<form id="form-POSTapi-submit-load-gen-form" data-method="POST" data-path="api/submit-load-gen-form" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-submit-load-gen-form', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-submit-load-gen-form" onclick="tryItOut('POSTapi-submit-load-gen-form');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-submit-load-gen-form" onclick="cancelTryOut('POSTapi-submit-load-gen-form');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-submit-load-gen-form" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/submit-load-gen-form</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-submit-load-gen-form" data-component="body" required  hidden>
<br>
The First Name of User.
</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-submit-load-gen-form" data-component="body"  hidden>
<br>
The Last Name of User.
</p>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="phone" data-endpoint="POSTapi-submit-load-gen-form" data-component="body" required  hidden>
<br>
The Phone No of User.
</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-submit-load-gen-form" data-component="body" required  hidden>
<br>
The Email of User.
</p>
<p>
<details>
<summary>
<b><code>locations</code></b>&nbsp;&nbsp;<small>array</small>  &nbsp;
<br>
The Location of User.
</summary>
<br>
<p>
<b><code>locations[].landmark_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="locations.0.landmark_id" data-endpoint="POSTapi-submit-load-gen-form" data-component="body" required  hidden>
<br>
The Ids of Landmark.
</p>
</details>
</p>

</form>




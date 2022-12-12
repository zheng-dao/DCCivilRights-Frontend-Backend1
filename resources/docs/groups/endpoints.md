# Endpoints


## Page Details




> Example request:

```javascript
const url = new URL(
    "https://dc-history-tour.dedicateddevelopers.us/api/pages/nam"
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
"message": "Page details",
"data": [
{
"id": 3,
"title": "About Us",
"slug": "about-us",
"text_content": "test content",
"created_at": "2022-02-22T10:33:27.000000Z",
"updated_at": "2022-02-22T10:33:27.000000Z",
}
]
}
```
<div id="execution-results-GETapi-pages--slug-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-pages--slug-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pages--slug-"></code></pre>
</div>
<div id="execution-error-GETapi-pages--slug-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pages--slug-"></code></pre>
</div>
<form id="form-GETapi-pages--slug-" data-method="GET" data-path="api/pages/{slug}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-pages--slug-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-pages--slug-" onclick="tryItOut('GETapi-pages--slug-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-pages--slug-" onclick="cancelTryOut('GETapi-pages--slug-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-pages--slug-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/pages/{slug}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>slug</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="slug" data-endpoint="GETapi-pages--slug-" data-component="url" required  hidden>
<br>

</p>
</form>




---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://loc.bookify.ai/docs/collection.json)

<!-- END_INFO -->

#BookingPages


<!-- START_e382c4744c200b6b0678ad232899580f -->
## Get
Get BookingPage by ID (or Slug using prefix `slug:` and string)

> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/booking_pages/slug:abc" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_pages/slug:abc"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "user_id": 1,
        "organization_id": null,
        "slug": "a3om77",
        "title": null,
        "use_user_name_as_title": true,
        "use_user_avatar_as_user_avatar": true,
        "welcome_message": "Welcome to my scheduling page. Please follow the instructions to add a booking to my calendar.",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:18:59",
        "deleted_at": null,
        "computed_title": null,
        "user_avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "computed_user_avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "logo": {
            "id": null,
            "url": null
        },
        "user": {
            "id": 1,
            "first_name": "Daniel",
            "last_name": "Runkov",
            "email_verified_at": null,
            "title": "456 1",
            "workplace_name": "sadasd dsadas",
            "workplace_website_url": "http:\/\/www.yandex.ru",
            "country_code": "CA",
            "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
            "locale": "en",
            "date_format": "AMERICAN",
            "time_format": "12H",
            "created_at": "2020-03-24 21:18:59",
            "updated_at": "2020-03-27 21:34:21",
            "deleted_at": null,
            "avatar": {
                "id": null,
                "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
            },
            "media": []
        },
        "media": []
    }
}
```

### HTTP Request
`GET api/v1/booking_pages/{booking_page_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_page_id` |  required  | BookingPage ID or slug:Slug

<!-- END_e382c4744c200b6b0678ad232899580f -->

<!-- START_ebd93af70ff4743fae01090d299212aa -->
## Update
Update BookingPage by ID

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_pages/7/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"booking_page":{}}'

```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_pages/7/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "booking_page": {}
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "user_id": 1,
        "organization_id": null,
        "slug": "a3om77",
        "title": null,
        "use_user_name_as_title": true,
        "use_user_avatar_as_user_avatar": true,
        "welcome_message": "Welcome to my scheduling page. Please follow the instructions to add a booking to my calendar.",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:18:59",
        "deleted_at": null,
        "computed_title": null,
        "user_avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "computed_user_avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "logo": {
            "id": null,
            "url": null
        },
        "user": {
            "id": 1,
            "first_name": "Daniel",
            "last_name": "Runkov",
            "email_verified_at": null,
            "title": "456 1",
            "workplace_name": "sadasd dsadas",
            "workplace_website_url": "http:\/\/www.yandex.ru",
            "country_code": "CA",
            "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
            "locale": "en",
            "date_format": "AMERICAN",
            "time_format": "12H",
            "created_at": "2020-03-24 21:18:59",
            "updated_at": "2020-03-27 21:34:21",
            "deleted_at": null,
            "avatar": {
                "id": null,
                "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
            },
            "media": []
        },
        "media": []
    }
}
```

### HTTP Request
`POST api/v1/booking_pages/{booking_page_id}/update`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_page_id` |  required  | BookingPage ID
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `booking_page` | object |  required  | BookingPage
    
<!-- END_ebd93af70ff4743fae01090d299212aa -->

<!-- START_836d70b2a5fbf4e85e66d9c770b3d875 -->
## Create new BookingType
Create a new BookingType inside this BookingPage

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_pages/7/booking_types/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"booking_type":{}}'

```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_pages/7/booking_types/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "booking_type": {}
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "parent_type": "BookingPage",
        "parent_id": 1,
        "type": "SOLO",
        "slug": "15min",
        "name": "15 Minute Meeting",
        "description": null,
        "locale": "en",
        "period_type": "MOVING",
        "duration": 15,
        "color": "dfc12d",
        "max_invitees": null,
        "timezone_code": null,
        "timezone_type": "LOCAL",
        "max_bookings_per_day": null,
        "min_booking_time": 14400,
        "max_booking_time": 5184000,
        "buffer_before": 0,
        "buffer_after": 0,
        "spot_step": 15,
        "autofill_invitee_information": 0,
        "allow_invitees_to_add_guests": 0,
        "invitee_name_format": "",
        "notification_type": "",
        "is_cancellation_allowed": false,
        "cancellation_policy_text": "",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": false,
        "start_date": null,
        "end_date": null,
        "is_public": true,
        "is_active": true,
        "internal_note": "",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:27:43",
        "is_payment_required": 0,
        "rate_value": "0.00",
        "rate_currency_code": "",
        "is_discount_enabled": 0,
        "discount_value": "0.00",
        "discount_has_expiration": 0,
        "discount_expiration_date": "0000-00-00",
        "is_portfolio_enabled": 0
    }
}
```

### HTTP Request
`POST api/v1/booking_pages/{booking_page_id}/booking_types/create`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_page_id` |  required  | BookingPage ID you want create BookingType for
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `booking_type` | object |  required  | BookingType
    
<!-- END_836d70b2a5fbf4e85e66d9c770b3d875 -->

<!-- START_c31881aa9f5942247e7b85d87f9a1fb0 -->
## Suggest slug for new BookingType
Suggest slug for a new BookingType when text provided

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/booking_pages/7/booking_types/suggest_slug?string=Interview+Meeting" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_pages/7/booking_types/suggest_slug"
);

let params = {
    "string": "Interview Meeting",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": "interview-meeting"
}
```

### HTTP Request
`GET api/v1/booking_pages/{booking_page_id}/booking_types/suggest_slug`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_page_id` |  required  | BookingPage ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `string` |  required  | Text to generate slug from

<!-- END_c31881aa9f5942247e7b85d87f9a1fb0 -->

<!-- START_0a71947b502fb4f28c505ca573dbf260 -->
## Get BookingType
Get the BookingType inside this BookingPage by Slug using prefix `slug:` with string

> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/booking_pages/7/booking_types/slug:abc" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_pages/7/booking_types/slug:abc"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "parent_type": "BookingPage",
        "parent_id": 1,
        "type": "SOLO",
        "slug": "15min",
        "name": "15 Minute Meeting",
        "description": null,
        "locale": "en",
        "period_type": "MOVING",
        "duration": 15,
        "color": "dfc12d",
        "max_invitees": null,
        "timezone_code": null,
        "timezone_type": "LOCAL",
        "max_bookings_per_day": null,
        "min_booking_time": 14400,
        "max_booking_time": 5184000,
        "buffer_before": 0,
        "buffer_after": 0,
        "spot_step": 15,
        "autofill_invitee_information": 0,
        "allow_invitees_to_add_guests": 0,
        "invitee_name_format": "",
        "notification_type": "",
        "is_cancellation_allowed": false,
        "cancellation_policy_text": "",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": false,
        "start_date": null,
        "end_date": null,
        "is_public": true,
        "is_active": true,
        "internal_note": "",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:27:43",
        "is_payment_required": 0,
        "rate_value": "0.00",
        "rate_currency_code": "",
        "is_discount_enabled": 0,
        "discount_value": "0.00",
        "discount_has_expiration": 0,
        "discount_expiration_date": "0000-00-00",
        "is_portfolio_enabled": 0
    }
}
```

### HTTP Request
`GET api/v1/booking_pages/{booking_page_id}/booking_types/{booking_type_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_page_id` |  required  | BookingPage ID
    `booking_type_id` |  required  | BookingType ID (or Slug)

<!-- END_0a71947b502fb4f28c505ca573dbf260 -->

#BookingTypes


<!-- START_f4cdbefe6555818988c65497437ea436 -->
## api/v1/booking_types/portfolio_photos
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_types/portfolio_photos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/portfolio_photos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/booking_types/portfolio_photos`


<!-- END_f4cdbefe6555818988c65497437ea436 -->

<!-- START_a857c0d7c51aaf05013f0eb4defc3a1a -->
## Get
Get BookingType by ID

> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/booking_types/34" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/34"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "parent_type": "BookingPage",
        "parent_id": 1,
        "type": "SOLO",
        "slug": "15min",
        "name": "15 Minute Meeting",
        "description": null,
        "locale": "en",
        "period_type": "MOVING",
        "duration": 15,
        "color": "dfc12d",
        "max_invitees": null,
        "timezone_code": null,
        "timezone_type": "LOCAL",
        "max_bookings_per_day": null,
        "min_booking_time": 14400,
        "max_booking_time": 5184000,
        "buffer_before": 0,
        "buffer_after": 0,
        "spot_step": 15,
        "autofill_invitee_information": 0,
        "allow_invitees_to_add_guests": 0,
        "invitee_name_format": "",
        "notification_type": "",
        "is_cancellation_allowed": false,
        "cancellation_policy_text": "",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": false,
        "start_date": null,
        "end_date": null,
        "is_public": true,
        "is_active": true,
        "internal_note": "",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:27:43",
        "is_payment_required": 0,
        "rate_value": "0.00",
        "rate_currency_code": "",
        "is_discount_enabled": 0,
        "discount_value": "0.00",
        "discount_has_expiration": 0,
        "discount_expiration_date": "0000-00-00",
        "is_portfolio_enabled": 0
    }
}
```

### HTTP Request
`GET api/v1/booking_types/{booking_type_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID

<!-- END_a857c0d7c51aaf05013f0eb4defc3a1a -->

<!-- START_53280a2b5669780395efe9122ceac510 -->
## Update
Update BookingType by ID

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_types/7/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"booking_type":{"name":"voluptates","description":"voluptate","color":"ff00ff","duration":15,"timezone_code":"impedit","timezone_type":"magnam","spot_step":15,"max_bookings_per_day":17,"max_booking_time":7,"min_booking_time":9,"buffer_before":3,"buffer_after":12,"notification_type":"quia","is_cancellation_allowed":true,"cancellation_policy_text":"consequatur","is_invitee_reminder_enabled":false,"is_invitee_sms_reminder_enabled":false,"is_invitee_email_follow_up_enabled":true,"is_payment_required":false,"rate_value":336239406.3153,"rate_currency_code":"quia","is_discount_enabled":true,"discount_value":5468.546507074,"discount_has_expiration":true,"discount_expiration_date":"rerum","locations":[],"rules":[],"questions":[],"coupons":[],"portfolios":[]}}'

```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/7/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "booking_type": {
        "name": "voluptates",
        "description": "voluptate",
        "color": "ff00ff",
        "duration": 15,
        "timezone_code": "impedit",
        "timezone_type": "magnam",
        "spot_step": 15,
        "max_bookings_per_day": 17,
        "max_booking_time": 7,
        "min_booking_time": 9,
        "buffer_before": 3,
        "buffer_after": 12,
        "notification_type": "quia",
        "is_cancellation_allowed": true,
        "cancellation_policy_text": "consequatur",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": true,
        "is_payment_required": false,
        "rate_value": 336239406.3153,
        "rate_currency_code": "quia",
        "is_discount_enabled": true,
        "discount_value": 5468.546507074,
        "discount_has_expiration": true,
        "discount_expiration_date": "rerum",
        "locations": [],
        "rules": [],
        "questions": [],
        "coupons": [],
        "portfolios": []
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "parent_type": "BookingPage",
        "parent_id": 1,
        "type": "SOLO",
        "slug": "15min",
        "name": "15 Minute Meeting",
        "description": null,
        "locale": "en",
        "period_type": "MOVING",
        "duration": 15,
        "color": "dfc12d",
        "max_invitees": null,
        "timezone_code": null,
        "timezone_type": "LOCAL",
        "max_bookings_per_day": null,
        "min_booking_time": 14400,
        "max_booking_time": 5184000,
        "buffer_before": 0,
        "buffer_after": 0,
        "spot_step": 15,
        "autofill_invitee_information": 0,
        "allow_invitees_to_add_guests": 0,
        "invitee_name_format": "",
        "notification_type": "",
        "is_cancellation_allowed": false,
        "cancellation_policy_text": "",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": false,
        "start_date": null,
        "end_date": null,
        "is_public": true,
        "is_active": true,
        "internal_note": "",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:27:43",
        "is_payment_required": 0,
        "rate_value": "0.00",
        "rate_currency_code": "",
        "is_discount_enabled": 0,
        "discount_value": "0.00",
        "discount_has_expiration": 0,
        "discount_expiration_date": "0000-00-00",
        "is_portfolio_enabled": 0
    }
}
```

### HTTP Request
`POST api/v1/booking_types/{booking_type_id}/update`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `booking_type` | object |  required  | BookingType
        `booking_type.name` | string |  optional  | Name
        `booking_type.description` | string |  optional  | Description
        `booking_type.color` | string |  optional  | Color (HEX)
        `booking_type.duration` | integer |  optional  | Duration
        `booking_type.timezone_code` | string |  optional  | Timezone Code
        `booking_type.timezone_type` | string |  optional  | Timezone Type
        `booking_type.spot_step` | integer |  optional  | Spot Step
        `booking_type.max_bookings_per_day` | integer |  optional  | Max Bookings per Day
        `booking_type.max_booking_time` | integer |  optional  | Max Booking Time
        `booking_type.min_booking_time` | integer |  optional  | Min Booking Time
        `booking_type.buffer_before` | integer |  optional  | Buffer Before
        `booking_type.buffer_after` | integer |  optional  | Buffer After
        `booking_type.notification_type` | string |  optional  | Notification Type
        `booking_type.is_cancellation_allowed` | boolean |  optional  | Is Cancelation allowed?
        `booking_type.cancellation_policy_text` | string |  optional  | Concelation Policy Text
        `booking_type.is_invitee_reminder_enabled` | boolean |  optional  | Is Invitee Reminder enabled?
        `booking_type.is_invitee_sms_reminder_enabled` | boolean |  optional  | Is Invitee SMS Reminder enabled?
        `booking_type.is_invitee_email_follow_up_enabled` | boolean |  optional  | Is Invitee Email Follow Up enabled?
        `booking_type.is_payment_required` | boolean |  optional  | Is Payment required?
        `booking_type.rate_value` | float |  optional  | Rate Value
        `booking_type.rate_currency_code` | string |  optional  | Rate Currency Code
        `booking_type.is_discount_enabled` | boolean |  optional  | Is Discount enabled?
        `booking_type.discount_value` | float |  optional  | Discount value
        `booking_type.discount_has_expiration` | boolean |  optional  | Discount has expiration?
        `booking_type.discount_expiration_date` | date |  optional  | Discount Expiration Date
        `booking_type.locations` | array |  optional  | Locations
        `booking_type.rules` | array |  optional  | Rules
        `booking_type.questions` | array |  optional  | Questions
        `booking_type.coupons` | array |  optional  | Coupons
        `booking_type.portfolios` | array |  optional  | Portfolios
    
<!-- END_53280a2b5669780395efe9122ceac510 -->

<!-- START_da6616ee0a19483f99dfe41f6fde364c -->
## Activate
Activate BookingType

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_types/39/activate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/39/activate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "parent_type": "BookingPage",
        "parent_id": 1,
        "type": "SOLO",
        "slug": "15min",
        "name": "15 Minute Meeting",
        "description": null,
        "locale": "en",
        "period_type": "MOVING",
        "duration": 15,
        "color": "dfc12d",
        "max_invitees": null,
        "timezone_code": null,
        "timezone_type": "LOCAL",
        "max_bookings_per_day": null,
        "min_booking_time": 14400,
        "max_booking_time": 5184000,
        "buffer_before": 0,
        "buffer_after": 0,
        "spot_step": 15,
        "autofill_invitee_information": 0,
        "allow_invitees_to_add_guests": 0,
        "invitee_name_format": "",
        "notification_type": "",
        "is_cancellation_allowed": false,
        "cancellation_policy_text": "",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": false,
        "start_date": null,
        "end_date": null,
        "is_public": true,
        "is_active": true,
        "internal_note": "",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:27:43",
        "is_payment_required": 0,
        "rate_value": "0.00",
        "rate_currency_code": "",
        "is_discount_enabled": 0,
        "discount_value": "0.00",
        "discount_has_expiration": 0,
        "discount_expiration_date": "0000-00-00",
        "is_portfolio_enabled": 0
    }
}
```

### HTTP Request
`POST api/v1/booking_types/{booking_type_id}/activate`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID

<!-- END_da6616ee0a19483f99dfe41f6fde364c -->

<!-- START_53538a72257d34ab128776e60144f821 -->
## Deactivate
Deactivate BookingType

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_types/39/deactivate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/39/deactivate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "parent_type": "BookingPage",
        "parent_id": 1,
        "type": "SOLO",
        "slug": "15min",
        "name": "15 Minute Meeting",
        "description": null,
        "locale": "en",
        "period_type": "MOVING",
        "duration": 15,
        "color": "dfc12d",
        "max_invitees": null,
        "timezone_code": null,
        "timezone_type": "LOCAL",
        "max_bookings_per_day": null,
        "min_booking_time": 14400,
        "max_booking_time": 5184000,
        "buffer_before": 0,
        "buffer_after": 0,
        "spot_step": 15,
        "autofill_invitee_information": 0,
        "allow_invitees_to_add_guests": 0,
        "invitee_name_format": "",
        "notification_type": "",
        "is_cancellation_allowed": false,
        "cancellation_policy_text": "",
        "is_invitee_reminder_enabled": false,
        "is_invitee_sms_reminder_enabled": false,
        "is_invitee_email_follow_up_enabled": false,
        "start_date": null,
        "end_date": null,
        "is_public": true,
        "is_active": true,
        "internal_note": "",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-24 21:27:43",
        "is_payment_required": 0,
        "rate_value": "0.00",
        "rate_currency_code": "",
        "is_discount_enabled": 0,
        "discount_value": "0.00",
        "discount_has_expiration": 0,
        "discount_expiration_date": "0000-00-00",
        "is_portfolio_enabled": 0
    }
}
```

### HTTP Request
`POST api/v1/booking_types/{booking_type_id}/deactivate`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID

<!-- END_53538a72257d34ab128776e60144f821 -->

<!-- START_c021c8ceb05a4d833e8808d0d23fb4b9 -->
## Suggest slug
Suggest slug for this BookingType

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/booking_types/283/suggest_slug?string=rerum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/283/suggest_slug"
);

let params = {
    "string": "rerum",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": "some-slug-here"
}
```

### HTTP Request
`GET api/v1/booking_types/{booking_type_id}/suggest_slug`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `string` |  optional  | string required Test you want to generate slug from

<!-- END_c021c8ceb05a4d833e8808d0d23fb4b9 -->

<!-- START_c0454df18b6019fb3c875abe5ff2867e -->
## Get available dates
Get available dates &amp; spots from date to date grouping by Timezone

> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/booking_types/234/available_dates?date_from=2020-03-20T20%3A00%3A00-03%3A00&date_to=2020-03-10T20%3A00%3A00-03%3A00&timezone_code=America%2FToronto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/234/available_dates"
);

let params = {
    "date_from": "2020-03-20T20:00:00-03:00",
    "date_to": "2020-03-10T20:00:00-03:00",
    "timezone_code": "America/Toronto",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "value": "2020-03-20",
            "spots": [
                "2020-03-20T20:00:00-03:00",
                "2020-03-20T20:15:00-03:00",
                "2020-03-20T20:30:00-03:00"
            ]
        }
    ]
}
```

### HTTP Request
`GET api/v1/booking_types/{booking_type_id}/available_dates`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `date_from` |  required  | Date & Time from
    `date_to` |  required  | Date & Time to
    `timezone_code` |  required  | Timezone Code to group available spots into dates

<!-- END_c0454df18b6019fb3c875abe5ff2867e -->

<!-- START_4e5d40c72e8c3c339cb1153df1db9699 -->
## Book
Book this BookingType

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/booking_types/343/book" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"booking":{"start_time":"cumque"},"user":{"email":"aut","first_name":"aspernatur","last_name":"laborum","locality_key":"reiciendis"}}'

```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/booking_types/343/book"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "booking": {
        "start_time": "cumque"
    },
    "user": {
        "email": "aut",
        "first_name": "aspernatur",
        "last_name": "laborum",
        "locality_key": "reiciendis"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": []
}
```

### HTTP Request
`POST api/v1/booking_types/{booking_type_id}/book`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `booking_type_id` |  required  | BookingType ID
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `booking` | object |  required  | Booking
        `booking.start_time` | date |  required  | 
        `user` | object |  optional  | User to register (if you are not authorized)
        `user.email` | email |  required  | Email
        `user.first_name` | string |  required  | First Name
        `user.last_name` | string |  required  | Last Name
        `user.locality_key` | string |  required  | Locality Key
    
<!-- END_4e5d40c72e8c3c339cb1153df1db9699 -->

#Users


<!-- START_6ce881a13ea3bed27b091365cdc5c521 -->
## Get
Get User by ID (or `me` for authenticated User)

> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/users/inventore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/users/inventore"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "first_name": "Daniel",
        "last_name": "Runkov",
        "email_verified_at": null,
        "title": "456 1",
        "workplace_name": "sadasd dsadas",
        "workplace_website_url": "http:\/\/www.yandex.ru",
        "country_code": "CA",
        "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
        "locale": "en",
        "date_format": "AMERICAN",
        "time_format": "12H",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-27 21:34:21",
        "deleted_at": null,
        "avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "media": []
    }
}
```

### HTTP Request
`GET api/v1/users/{user_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user_id` |  required  | User ID (or `me` string)

<!-- END_6ce881a13ea3bed27b091365cdc5c521 -->

<!-- START_f0459c216bfd2def5e952956b82cbcb4 -->
## Update
Update User by ID (or `me` for authenticated User)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/users/me/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user":{"email":"test@email.com","first_name":"Joe","last_name":"Doe","locale":"en","date_format":"24H","time_format":"AMERICAN","locality_key":"ChIJDbdkHFQayUwR7-8fITgxTmU","avatar_file":"dolor","title":"Full-Stuck Developer","workplace_name":"Bookify INC.","workplace_website_url":"https:\/\/www.bookify.ai\/"}}'

```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/users/me/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user": {
        "email": "test@email.com",
        "first_name": "Joe",
        "last_name": "Doe",
        "locale": "en",
        "date_format": "24H",
        "time_format": "AMERICAN",
        "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
        "avatar_file": "dolor",
        "title": "Full-Stuck Developer",
        "workplace_name": "Bookify INC.",
        "workplace_website_url": "https:\/\/www.bookify.ai\/"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "first_name": "Daniel",
        "last_name": "Runkov",
        "email_verified_at": null,
        "title": "456 1",
        "workplace_name": "sadasd dsadas",
        "workplace_website_url": "http:\/\/www.yandex.ru",
        "country_code": "CA",
        "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
        "locale": "en",
        "date_format": "AMERICAN",
        "time_format": "12H",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-27 21:34:21",
        "deleted_at": null,
        "avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "media": []
    }
}
```

### HTTP Request
`POST api/v1/users/{user_id}/update`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user_id` |  required  | User ID (or `me` string)
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user` | object |  required  | User
        `user.email` | email |  optional  | Email
        `user.first_name` | string |  optional  | First Name
        `user.last_name` | string |  optional  | Last Name
        `user.locale` | string |  optional  | Locale
        `user.date_format` | string |  optional  | Date Format
        `user.time_format` | string |  optional  | Time Format
        `user.locality_key` | string |  optional  | Locality Key
        `user.avatar_file` | file |  optional  | Avatar File
        `user.title` | string |  optional  | Title
        `user.workplace_name` | string |  optional  | Workplace Name
        `user.workplace_website_url` | url |  optional  | Workplace Website Url
    
<!-- END_f0459c216bfd2def5e952956b82cbcb4 -->

<!-- START_6af89d390ce029a321ba45382132357b -->
## Change email
Change User email by User ID (or `me` for authenticated User)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/users/neque/change_email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/users/neque/change_email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "first_name": "Daniel",
        "last_name": "Runkov",
        "email_verified_at": null,
        "title": "456 1",
        "workplace_name": "sadasd dsadas",
        "workplace_website_url": "http:\/\/www.yandex.ru",
        "country_code": "CA",
        "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
        "locale": "en",
        "date_format": "AMERICAN",
        "time_format": "12H",
        "created_at": "2020-03-24 21:18:59",
        "updated_at": "2020-03-27 21:34:21",
        "deleted_at": null,
        "avatar": {
            "id": null,
            "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
        },
        "media": []
    }
}
```

### HTTP Request
`POST api/v1/users/{user_id}/change_email`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user_id` |  required  | User ID (or `me` string)

<!-- END_6af89d390ce029a321ba45382132357b -->

<!-- START_e5ae33ff50202a51d524b364d13e00b2 -->
## Get BookingPages
Get BookingPages of this User

> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/users/83/booking_pages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/users/83/booking_pages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "organization_id": null,
            "slug": "a3om77",
            "title": null,
            "use_user_name_as_title": true,
            "use_user_avatar_as_user_avatar": true,
            "welcome_message": "Welcome to my scheduling page. Please follow the instructions to add a booking to my calendar.",
            "created_at": "2020-03-24 21:18:59",
            "updated_at": "2020-03-24 21:18:59",
            "deleted_at": null,
            "computed_title": null,
            "user_avatar": {
                "id": null,
                "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
            },
            "computed_user_avatar": {
                "id": null,
                "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
            },
            "logo": {
                "id": null,
                "url": null
            },
            "user": {
                "id": 1,
                "first_name": "Daniel",
                "last_name": "Runkov",
                "email_verified_at": null,
                "title": "456 1",
                "workplace_name": "sadasd dsadas",
                "workplace_website_url": "http:\/\/www.yandex.ru",
                "country_code": "CA",
                "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
                "locale": "en",
                "date_format": "AMERICAN",
                "time_format": "12H",
                "created_at": "2020-03-24 21:18:59",
                "updated_at": "2020-03-27 21:34:21",
                "deleted_at": null,
                "avatar": {
                    "id": null,
                    "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
                },
                "media": []
            },
            "media": []
        },
        {
            "id": 1,
            "user_id": 1,
            "organization_id": null,
            "slug": "a3om77",
            "title": null,
            "use_user_name_as_title": true,
            "use_user_avatar_as_user_avatar": true,
            "welcome_message": "Welcome to my scheduling page. Please follow the instructions to add a booking to my calendar.",
            "created_at": "2020-03-24 21:18:59",
            "updated_at": "2020-03-24 21:18:59",
            "deleted_at": null,
            "computed_title": null,
            "user_avatar": {
                "id": null,
                "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
            },
            "computed_user_avatar": {
                "id": null,
                "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
            },
            "logo": {
                "id": null,
                "url": null
            },
            "user": {
                "id": 1,
                "first_name": "Daniel",
                "last_name": "Runkov",
                "email_verified_at": null,
                "title": "456 1",
                "workplace_name": "sadasd dsadas",
                "workplace_website_url": "http:\/\/www.yandex.ru",
                "country_code": "CA",
                "locality_key": "ChIJDbdkHFQayUwR7-8fITgxTmU",
                "locale": "en",
                "date_format": "AMERICAN",
                "time_format": "12H",
                "created_at": "2020-03-24 21:18:59",
                "updated_at": "2020-03-27 21:34:21",
                "deleted_at": null,
                "avatar": {
                    "id": null,
                    "url": "http:\/\/loc.bookify.ai\/img\/avatar.png"
                },
                "media": []
            },
            "media": []
        }
    ]
}
```

### HTTP Request
`GET api/v1/users/{user_id}/booking_pages`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user_id` |  required  | User ID (or `me`)

<!-- END_e5ae33ff50202a51d524b364d13e00b2 -->

#general


<!-- START_2be1f0e022faf424f18f30275e61416e -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/login`


<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_4b77551ffe3e806c992cdd1044012aa7 -->
## api/v1/auth/refresh
> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "is_authenticated": false
    }
}
```

### HTTP Request
`GET api/v1/auth/refresh`


<!-- END_4b77551ffe3e806c992cdd1044012aa7 -->

<!-- START_4eff96325064b0bf6061147d28f77ca7 -->
## api/v1/auth/email/check
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/email/check" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/email/check"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/email/check`


<!-- END_4eff96325064b0bf6061147d28f77ca7 -->

<!-- START_623f78fbfc9566609d290c0a47c06c5c -->
## api/v1/auth/email/forget
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/email/forget" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/email/forget"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/email/forget`


<!-- END_623f78fbfc9566609d290c0a47c06c5c -->

<!-- START_a68ff660ea3d08198e527df659b17963 -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->

<!-- START_3157fb6d77831463001829403e201c3e -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/register`


<!-- END_3157fb6d77831463001829403e201c3e -->

<!-- START_5c8ff9b2312a504a5405ad3007610050 -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/password/email`


<!-- END_5c8ff9b2312a504a5405ad3007610050 -->

<!-- START_11eddaef605264cbbe21511716d17d51 -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/password/reset`


<!-- END_11eddaef605264cbbe21511716d17d51 -->

<!-- START_7b05e64da87550906fbf107c8173c53e -->
## Change User password

> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/auth/password/change" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"current_password":"eligendi","password":"quo","password_confirmation":"est"}'

```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/auth/password/change"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "current_password": "eligendi",
    "password": "quo",
    "password_confirmation": "est"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/password/change`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `current_password` | required |  optional  | Current User password
        `password` | required |  optional  | New User password
        `password_confirmation` | New |  optional  | User password confirmation
    
<!-- END_7b05e64da87550906fbf107c8173c53e -->

<!-- START_fe85748c12a3cbca38894583f298c6c8 -->
## api/v1/localities/detect
> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/localities/detect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/localities/detect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": null
}
```

### HTTP Request
`GET api/v1/localities/detect`


<!-- END_fe85748c12a3cbca38894583f298c6c8 -->

<!-- START_007b03beb5761f286b383e07f4716c74 -->
## api/v1/localities/autocomplete
> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/localities/autocomplete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/localities/autocomplete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (422):

```json
{
    "error": "Validation",
    "validation_fields": {
        "query": [
            "The query field must be present."
        ]
    }
}
```

### HTTP Request
`GET api/v1/localities/autocomplete`


<!-- END_007b03beb5761f286b383e07f4716c74 -->

<!-- START_6ff14855385b94e5d4b379e6cf2af389 -->
## api/v1/localities/{locality_key}
> Example request:

```bash
curl -X GET \
    -G "http://loc.bookify.ai/api/v1/localities/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/localities/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "error": "Internal Error"
}
```

### HTTP Request
`GET api/v1/localities/{locality_key}`


<!-- END_6ff14855385b94e5d4b379e6cf2af389 -->

<!-- START_b998f167d7c49fa161367d1ece1f16b6 -->
## api/v1/intro/basic
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/intro/basic" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/intro/basic"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/intro/basic`


<!-- END_b998f167d7c49fa161367d1ece1f16b6 -->

<!-- START_1ed699f6e070edab91e17b3f08059e38 -->
## api/v1/intro/calendar
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/intro/calendar" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/intro/calendar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/intro/calendar`


<!-- END_1ed699f6e070edab91e17b3f08059e38 -->

<!-- START_644f55443f3e8d7ac09eeafb7370205a -->
## api/v1/intro/calendar/settings
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/intro/calendar/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/intro/calendar/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/intro/calendar/settings`


<!-- END_644f55443f3e8d7ac09eeafb7370205a -->

<!-- START_f008b759352d2533c26b787a0c5d0e42 -->
## api/v1/intro/availability
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/intro/availability" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/intro/availability"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/intro/availability`


<!-- END_f008b759352d2533c26b787a0c5d0e42 -->

<!-- START_22c5310e7f9c8bc4893ca7344e247508 -->
## api/v1/intro/role
> Example request:

```bash
curl -X POST \
    "http://loc.bookify.ai/api/v1/intro/role" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://loc.bookify.ai/api/v1/intro/role"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/intro/role`


<!-- END_22c5310e7f9c8bc4893ca7344e247508 -->



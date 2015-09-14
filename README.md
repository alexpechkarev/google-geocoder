Google Geocoder API for Lavarel 5
======================
[![Build Status](https://travis-ci.org/alexpechkarev/google-geocoder.svg?branch=master)](https://travis-ci.org/alexpechkarev/google-geocoder)

This package provides simple facility to make [**The Google Geocoding API v3**]
(https://developers.google.com/maps/documentation/geocoding/) calls with [**Laravel 5**](http://laravel.com/).

See [*Collection of Google Maps API Web Services for Laravel*](https://github.com/alexpechkarev/google-maps) that also includes Google Geocoding API v3.

Dependency
------------
[**PHP cURL**] (http://php.net/manual/en/curl.installation.php) required


Installation
------------

To install edit `composer.json` and add following line:

```javascript
"alexpechkarev/google-geocoder": "dev-master"
```

Run `composer update`


Configuration
-------------

Once installed, register Laravel service provider, in your `config/app.php`:

```php
'providers' => array(
	...
    'Alexpechkarev\GoogleGeocoder\GoogleGeocoderServiceProvider',
)
```

Next, create a `config/google-geocoder.php`, containing:

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Geocoder
    |--------------------------------------------------------------------------
    | Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA")
    | into geographic coordinates (like latitude 37.423021 and longitude -122.083739),
    | which you can use to place markers or position the map.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Application Key
    |--------------------------------------------------------------------------
    |
    | Your application's API key. This key identifies your application for
    | purposes of quota management. Learn how to get a key from the APIs Console.
    */
    'applicationKey' => 'my-api-key',

    /*
    |--------------------------------------------------------------------------
    | Request URL
    |--------------------------------------------------------------------------
    |
    */
    'requestUrl' => [
        'json' => 'https://maps.googleapis.com/maps/api/geocode/json?',
        'xml'  => 'https://maps.googleapis.com/maps/api/geocode/xml?'
    ],
];
```

Usage
-----

Before making calls please ensure you obtain API Key to identify your application and add this key in the configuration file.
More information on API Key please refer to [**The Google Geocoding API**](https://developers.google.com/maps/documentation/geocoding/#api_key).

```php
'applicationKey' => 'your-api-key',
```

Create an array with key=>value pairs specifying address you would like to geocode:

```php
$param = array("address"=>"76 Buckingham Palace Road London SW1W 9TQ");
```

Use following command to receive Geocoding response in json format, use xml as first parameter for XML response.

```php
$response = \Geocoder::geocode('json', $param);
```

To restrict your results to a specific area use component filter [**Component Filtering**](https://developers.google.com/maps/documentation/geocoding/#ComponentFiltering)
by adding it's filters to parameter array.

```php
$param = array(
                "address"=>"76 Buckingham Palace Road London SW1W 9TQ",
                "components"=>"country:GB"
            );
```

Geocoding API supports translation of map coordinates into human-readable address
by reverse geocoding using latitude and longitude parameters. For more details
refer to [**Reverse Geocoding**](https://developers.google.com/maps/documentation/geocoding/#ReverseGeocoding)
To make reverse geocoding request use following:

```php
$param = array("latlng"=>"40.714224,-73.961452");
$response = \Geocoder::geocode('json', $param);
```

All requests will return `string` value. For Response example, Status Codes,
Error Messages and Results please refer to [**Geocoding Responses**]
(https://developers.google.com/maps/documentation/geocoding/#GeocodingResponses)



Support
-------

[Please open an issue on GitHub](https://github.com/alexpechkarev/google-geocoder/issues)


License
-------

Google Geocoder for Laravel 5 is released under the MIT License. See the bundled
[LICENSE](https://github.com/alexpechkarev/google-geocoder/blob/master/LICENSE)
file for details.

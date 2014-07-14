Google Geocoder API for Lavarel 4
======================

This package provides simple wrapper for Google Geocoder API [**The Google Geocoding API**](https://developers.google.com/maps/documentation/geocoding/) 
to use with [**Laravel 4**](http://laravel.com/).


Installation
------------

To install edit `composer.json` and add:

```javascript
"alexpechkarev/google-geocoder": "1.*"
```

Configuration
-------------

Once installed, you need to register Laravel service provider, in your `app/config/app.php`:

```php
'providers' => array(
	...
    'Alexpechkarev\GoogleGeocoder\GoogleGeocoderServiceProvider',
)
```

Register the facade in your `app/config/app.php`:

```php
'aliases' => array(
	...
	'Geocoder'=> 'Alexpechkarev\GoogleGeocoder\Facades\GoogleGeocoderFacade',
)
```



Publish configuration file using Artisan command:

```
$ php artisan config:publish alexpechkarev/google-geocoder --path vendor/alexpechkarev/google-geocoder/src/config/
```


Usage
-----

Before making calls please ensure you obtain API Key to identify your application and add this key in the configuration file.
More information on API Key can be found from [**The Google Geocoding API**](https://developers.google.com/maps/documentation/geocoding/#api_key).

```php
'applicationKey' => 'your-api-key',
```

Prepare address you would like to geocode by creating an array with key=>value pairs

```php
            $param = array("address"=>"76 Buckingham Palace Road London SW1W 9TQ");
```

Prepare address you would like to geocode by creating an array with key=>value pairs

```php
            $param = array("address"=>"76 Buckingham Palace Road London SW1W 9TQ");
```

And use following command to receive Geocoding response in json format, use 'xml' as fist parameter for XML response.

```php

    $reponse = Geocoder::geocode('json', $param);

```

To restrict your results to a specific area use components filter [***Component Filtering***](https://developers.google.com/maps/documentation/geocoding/#ComponentFiltering)
by adding it's filters to parameter array.

```php
            $param = array(
                            "address"=>"76 Buckingham Palace Road London SW1W 9TQ",
                            "componets"=>"country:GB"
                        );
```

Geocoding API supports translation of map coordinates into human-readable address 
by reverse geocoding using latitude and longitude parameters. For more details refer to [***Reverse Geocoding (Address Lookup)***]{https://developers.google.com/maps/documentation/geocoding/#ReverseGeocoding}
To make reverse geocoding request use following:

```php
            $param = array("latlng"=>"40.714224,-73.961452");
```

All request will return `string` result. For Response example, Status Codes, Error Messages and Results please refer to [***Geocoding Responses***](https://developers.google.com/maps/documentation/geocoding/#GeocodingResponses)



Support
-------

[Please open an issue on GitHub](https://github.com/alexpechkarev/google-geocoder/issues)


License
-------

GeocoderLaravel is released under the MIT License. See the bundled
[LICENSE](https://github.com/alexpechkarev/google-geocoder/blob/master/LICENSE)
file for details.
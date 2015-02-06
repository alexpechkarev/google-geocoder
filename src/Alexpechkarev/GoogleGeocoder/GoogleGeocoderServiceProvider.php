<?php

namespace Alexpechkarev\GoogleGeocoder;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class GoogleGeocoderServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        AliasLoader::getInstance()->alias('Geocoder','Alexpechkarev\GoogleGeocoder\Facades\GoogleGeocoderFacade');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['GoogleGeocoder'] = $this->app->share(function($app)
        {
            $config = array();
            $config['applicationKey']   = Config::get('google-geocoder.applicationKey');
            $config['requestUrl']       = Config::get('google-geocoder.requestUrl');

            // Throw an error if request URL is empty
            if (empty($config['requestUrl'])) {
                throw new \InvalidArgumentException('Request URL is empty, please check your config file.');
            }

            return new GoogleGeocoder($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}

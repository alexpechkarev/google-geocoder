<?php 

namespace Alexpechkarev\GoogleGeocoder;

use Illuminate\Support\ServiceProvider;

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
         public function boot(){
            
            $this->package("alexpechkarev/google-geocoder");
            
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
                return new GoogleGeocoder();

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

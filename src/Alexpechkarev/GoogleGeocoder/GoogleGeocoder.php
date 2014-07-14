<?php

/**
 * Description of GoogleGeocoder
 *
 * @author Alexander Pechkarev <alexpechkarev@gmail.com>
 */

namespace Alexpechkarev\GoogleGeocoder;

use Illuminate\Support\Facades\Config;

class GoogleGeocoder {
    
    /*
    |--------------------------------------------------------------------------
    | Application Key
    |--------------------------------------------------------------------------
    |
    | Your application's API key. This key identifies your application for 
    | purposes of quota management. Learn how to get a key from the APIs Console.
    */    
        private $applicationKey;  
        

    /*
    |--------------------------------------------------------------------------
    | Request Url
    |--------------------------------------------------------------------------
    |
    */    
        private $requestUrl; 
        
    /*
    |--------------------------------------------------------------------------
    | Available Output Formats
    |--------------------------------------------------------------------------
    |
    */    
        private $availableFormats;
        
    /*
    |--------------------------------------------------------------------------
    | Requested Format
    |--------------------------------------------------------------------------
    |
    */    
        private $format;        
        
  /*
    |--------------------------------------------------------------------------
    | Geocoding request parameters
    |--------------------------------------------------------------------------
    |
    */    
        private $param;        
        
        private $r;
    
    /**
     * Set Application Key and Request URL
     * 
     * @param string $format - output format json or xml
     * @param array $param - geocoding request parameters
     */
    public function __construct() {
        
        $this->applicationKey   = Config::get('google-geocoder::applicationKey');
        
        // Throw an error if application key is empty
        if(empty($this->applicationKey)):
            throw new \InvalidArgumentException('Application Key is empty, please check your config file.');
        endif;  

        $this->requestUrl       = Config::get('google-geocoder::requestUrl');
                
        // Throw an error if request URL is empty
        if(empty($this->requestUrl)):
            throw new \InvalidArgumentException('Request URL is empty, please check your config file.');
        endif;  
        
        $this->availableFormats  = Config::get('google-geocoder::output');
        // Throw an error if output format not specified
        if(!is_array($this->availableFormats) && count($this->availableFormats) < 1):
            throw new \InvalidArgumentException('Add a least one output format in your config file.');
        endif;        
               
    }
    /***/
    
    
    /**
     * Make cURL call
     * @return string
     * @throws \RuntimeException
     */
    private function call(){
        
        $curl = curl_init();
       
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER      => 1,
            CURLOPT_URL                 => $this->requestUrl[$this->format].$this->param,
            CURLOPT_SSL_VERIFYPEER      => false,
            CURLOPT_FAILONERROR         => true,
        ));
       
        $request = curl_exec($curl);
        
        if(empty($request)):
            throw new \RuntimeException('cURL request retuened following error: '.curl_error($curl) );
        endif;
        
        curl_close($curl);        
        
        
        return $request;        
        
    }
    /***/
    
    
    /**
     * Geocoding request
     * 
     * @param string $format - output format json or xml
     * @param array $param - geocoding request parameters
     * 
     * @return string
     */
    public function geocode($format, $param){      
 
        $this->format     = in_array($format, $this->availableFormats) ? $format : 'json';
        $param['key']     = $this->applicationKey;
        $this->param      = http_build_query($param);  
        
        return $this->call();
    }
    /***/
    

    
}

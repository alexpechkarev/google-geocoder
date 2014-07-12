<?php

/**
 * Description of Client
 *
 * @author Alexander Pechkarev
 */

namespace Alexpechkarev\GoogleGeocoder\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleGeocoderFacade extends Facade{
    
    protected static function getFacadeAccessor() {
        
        return "GoogleGeocoder";
    }
}

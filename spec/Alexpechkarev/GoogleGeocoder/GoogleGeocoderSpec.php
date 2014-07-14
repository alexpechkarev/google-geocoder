<?php

namespace spec\Alexpechkarev\GoogleGeocoder;

use PhpSpec\ObjectBehavior;


class GoogleGeocoderSpec extends ObjectBehavior
{
    
    function let(){
        $constructorArguments = array('applicationKey'=>"my-api-key", 
                                      'requestUrl'=> array(
                                                    'json' => 'https://maps.googleapis.com/maps/api/geocode/json?',
                                                    'xml'  => 'https://maps.googleapis.com/maps/api/geocode/xml?'
                                                )
            );
        $this->beConstructedWith($constructorArguments);
        
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Alexpechkarev\GoogleGeocoder\GoogleGeocoder');
    }
    
    
    function it_throw_missing_argument_exception(){
        
        $this->shouldThrow('PhpSpec\Exception\Example\ErrorException')->during('geocode');
    }
    
    function it_should_return_string(){
        
        $this->geocode('json', array("address"=>"SW1W 9TQ"))->shouldBeString();
    }  
    
    function it_throw_runtime_exception(){
        
        $constructorArguments = array('applicationKey'=>"my-api-key", 
                                      'requestUrl'=> array(
                                                    'json' => 'https://maps.googleapis.com/maps/api/geocode/json&',
                                                    'xml'  => 'https://maps.googleapis.com/maps/api/geocode/xml?'
                                                )
            );
        $this->beConstructedWith($constructorArguments);   

        $this->shouldThrow('\RuntimeException')->during('geocode', array('json', array("address"=>"SW1W 9TQ")));        
        
       
    }    
    
}

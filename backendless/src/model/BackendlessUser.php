<?php
namespace backendless\model;

use backendless\model\Data;
use backendless\exception\BackendlessException;

class BackendlessUser extends Data {
   
    public function  __construct() {
        
        parent::__construct();
        
    }

    public function getUserId() {
    
        return $this->getObjectId();
            
    }
    
    public function getUserToken() {
        
        return ( isset( $this->data["user-token"] ) ) ? $this->data["user-token"] : null;
        
    }
    
    public function unsetUserToken() {
        
        if ( isset( $this->data["user-token"] ) ) {
            
            unset( $this->data["user-token"] );
            
        }
        
    }
    
    public function putProperties( $properties ) {
        
        if( is_array( $properties) ) {
            
            parent::putProperties( $properties );
            
        } else {
            
            throw new BackendlessException( '"putProperties" method argument "$properties" must be array' );
            
        }
        
    }

    public function setProperties( $properties ) {
        
        if( is_array( $properties) ) {
            
            parent::setProperties( $properties );
            
        } else {
            
            throw new BackendlessException( '"setProperties" method argument "$properties" must be array' );
            
        }
        
    }
}

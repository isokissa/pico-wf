<?php

interface StringLoader 
{
    
    public function hasString( $stringName );
    
    /**
     * Sets the context from which the strings will be taken. 
     * The context can be also considerred as namespace. 
     * @throws StringLoaderInvalidContextException if context 
     * does not exist 
     */
    public function setContext( $context );
    
    /**
     * @throws StringLoaderStringNotFoundException if string with 
     * stringName is not found 
     */
    public function getString( $stringName );
    
    public function getAllStringNames();
    
}

class StringLoaderInvalidContextException extends Exception {}

class StringLoaderStringNotFoundException extends Exception {}


?>

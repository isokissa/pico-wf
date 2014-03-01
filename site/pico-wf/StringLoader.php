<?php

abstract class StringLoader 
{

    public function __construct( $pageName, $language )
    {
	$this->init( $pageName, $language );
    }

    abstract protected function init( $pageName, $language );

    abstract public function getString( $name );

    abstract public function getAllNames();

}

class StringLoaderLanguageNotFoundException extends Exception {}

class StringLoaderStringNotFoundException extends Exception {}


?>

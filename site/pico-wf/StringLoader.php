<?php

abstract class StringLoader 
{

    public function __construct( $pageId, $language )
    {
        $this->init( $pageId, $language );
    }

    abstract protected function init( $pageId, $language );

    abstract public function getString( $name );

    abstract public function getAllNames();

}

class StringLoaderLanguageNotFoundException extends Exception {}

class StringLoaderStringNotFoundException extends Exception {}


?>

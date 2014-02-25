<?php

abstract class Page 
{

    public function __construct( $pageName )
    {
	$this->init( $pageName );
    }


    abstract protected function init( $pageName );

    abstract public function getArticle();


}

class PageNotFoundException extends Exception {}


?>

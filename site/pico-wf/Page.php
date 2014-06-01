<?php

abstract class Page 
{

    public function __construct( $pageId )
    {
        $this->init( $pageId );
    }


    abstract protected function init( $pageId );
    
    abstract protected function getId();

    abstract public function getArticle();


}

class PageNotFoundException extends Exception {}


?>

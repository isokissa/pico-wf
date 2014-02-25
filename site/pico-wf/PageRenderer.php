<?php

class PageRenderer 
{
    
    private $site;
    private $page; 
    private $stringLoader;


    public function __construct( $site, $page, $stringLoader )
    {
	$this->site = $site;
	$this->page = $page;
	$this->stringLoader = $stringLoader;
    }


    public function getTitle()
    {
	return $this->stringLoader->getString( "TITLE" );
    }

    public function getMenu()
    {
	return "Menu";
    }

    public function getArticle()
    {
	return "Article";
    }

}


?>
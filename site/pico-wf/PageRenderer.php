<?php

require_once( "Factory.php" );

class PageRenderer 
{
    
    private $site;
    private $page; 
    private $stringLoader;


    public function __construct( $factory, $page, $language )
    {
	$this->site = $factory->makeSite();
	$this->page = $factory->makePage( $page );
	$this->stringLoader = $factory->makeStringLoader( $page, $language );
    }


    public function getTitle()
    {
	return htmlspecialchars( $this->stringLoader->getString( "TITLE" ) );
    }

    public function getMenu()
    {
	return "Menu";
    }

    public function getArticle()
    {
	$rawArticle = $this->page->getArticle();

	return "Article";
    }

}


?>
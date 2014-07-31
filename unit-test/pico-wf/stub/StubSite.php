<?php

require_once( "site/pico-wf/Site.php" );
require_once( "StubPage.php" );


class StubSite extends Site
{

    private $pages;
    private $languages;


    public function __construct()
    {
	$this->pages = [ "page1" => new StubPage( "page1" ), 
					 "page2" => new StubPage( "page2" ) ];
	$this->languages = [ "en" => new Language( "en", "English" ),
						 "fi" => new Language( "fi", "Suomi" ) ];
    }
    
    public function getPage( $pageId ){
	if( !array_key_exists( $pageId, $this->pages ) ){
	    throw new SitePageNotFoundException( $pageId );
	}
	return $this->pages[ $pageId ];
    }

    public function getPageRenderer( $pageId, $language ){
    	return new PageRenderer( $this, $pageId, $language );
    }

    public function getAllPages()
    {
	return $this->pages;
    }

    public function getAllLanguages()
    {
	return $this->languages;
    }
    
}

?>

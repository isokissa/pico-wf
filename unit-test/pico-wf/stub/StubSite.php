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

    public function getPageRenderer( $pageId, $languageId ){
        $realPageId = $pageId;
        if( !array_key_exists( $pageId, $this->pages ) ){
            $realPageId = array_keys( $this->pages )[0];
        }
        $realLanguageId = $languageId;
        if( !array_key_exists( $languageId, $this->languages ) ){
            $realLanguageId = array_keys( $this->languages )[0];
        }
        return new PageRenderer( $this, $realPageId, $realLanguageId );
    }

    public function getAllPages()
    {
        return array_keys( $this->pages );
    }

    public function getAllLanguages()
    {
        return $this->languages;
    }
    
}

?>

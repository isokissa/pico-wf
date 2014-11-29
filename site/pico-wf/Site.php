<?php

require_once( "StringLoader.php" );
require_once( "PageRenderer.php" );
require_once( "Page.php" );


class Site
{
    private $stringLoader;
    private $pageIds;
    private $languages;
    private $globalHeader = ""; 
    private $globalFooter = "";

    public function __construct( $stringLoader )
    {
        $this->stringLoader = $stringLoader;
        $this->loadSiteConfiguration();
    }
    
    private function loadSiteConfiguration()
    {
        $this->stringLoader->setContext( "site.config" );
        $this->extractPageIds( $this->stringLoader->getString( "pages" ) );
        $this->extractLanguages( $this->stringLoader->getString( "languages" ) );
        if( $this->stringLoader->hasString( "global-header" ) ){
            $this->globalHeader = $this->stringLoader->getString( "global-header" );
        }
        if( $this->stringLoader->hasString( "global-footer" ) ){
            $this->globalFooter = $this->stringLoader->getString( "global-footer" );      
        }
    }
    
    private function extractPageIds( $pageIdsString )
    {
        $this->pageIds = array_map( "trim", explode( ",", $pageIdsString ) );
    }
    
    private function extractLanguages( $inputString )
    {
        $languageStrings = array_map( "trim", explode( ";", $inputString ) );
        $this->languages = array();
        foreach( $languageStrings as $oneString ){
            $languageComponents = array_map( "trim", explode( ",", $oneString ) );
            $language = new Language( $languageComponents[0], $languageComponents[1] );
            $this->languages[ $language->id ] = $language;
        } 
    }
    
    
    /**
     * Throws exception SitePageNotFoundException if page with given 
     * pageId is not found.
     * @return Page object for given pageId
     **/
    public function getPage( $pageId ){
        if( !in_array( $pageId, $this->pageIds ) ){
            throw new SitePageNotFoundException( $pageId );
        }
        return new Page( $pageId, $this->stringLoader );
    }

    /**
     * @return PageRenderer object for given pageId and languageId.
     *      If page pageId does not exist, the method will use first page of 
     *      the site. If language languageId does not exist, the method
     *      will use first language of the site. 
     **/
    public function getPageRenderer( $pageId, $languageId ){
        $realPageId = $pageId;
        if( !in_array( $pageId, $this->pageIds ) ){
            $realPageId = $this->pageIds[0];
        }
        $realLanguageId = $languageId;
        if( !array_key_exists( $languageId, $this->languages ) ){
            $realLanguageId = array_keys( $this->languages )[0];
        }
        return new PageRenderer( $this, $realPageId, $realLanguageId );
    }

    /**
     * @return a list of all page ids, for example: 
     *        [ "page1", "page2" ];
     */
    public function getAllPages()
    {
        return $this->pageIds;
    }

    /**
     * @return map [ id => Language ] of all supported languages
     **/
    public function getAllLanguages()
    {
        return $this->languages;
    }
    
    /**
     * @return global header
     */
    public function getGlobalHeader()
    {
        return $this->globalHeader;
    }
    
    /**
     * @return glogal footer
     */
    public function getGlobalFooter()
    {
        return $this->globalFooter;
    }
        
}

class SitePageNotFoundException extends Exception {}

class SitePageLanguageNotFoundException extends Exception {}

class Language
{
    public $id;
    public $name;
    
    public function __construct( $id, $name )
    {
        $this->id = $id;
        $this->name = $name;
    }

}

?>

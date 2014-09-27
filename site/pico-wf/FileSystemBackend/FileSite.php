<?php


require_once( "pico-wf/Site.php" );
require_once( "FilePage.php" );
require_once( "FileStringLoader.php" );


class FileSite extends Site
{
    private $pageIds;
    private $languages;
    private $globalHeader = ""; 
    private $globalFooter = "";

    public function __construct()
    {
        $this->loadSiteConfiguration();
    }
    
    private function loadSiteConfiguration()
    {
        $stringLoader = new FileStringLoader( __DIR__."/../../contents/site.config" );
        $this->extractPageIds( $stringLoader->getString( "pages" ) );
        $this->extractLanguages( $stringLoader->getString( "languages" ) );
        if( $stringLoader->hasString( "global-header" ) ){
            $this->globalHeader = $stringLoader->getString( "global-header" );
        }
        if( $stringLoader->hasString( "global-footer" ) ){
            $this->globalFooter = $stringLoader->getString( "global-footer" );      
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
    
    public function getPage( $pageId ){
        try{
            return new FilePage( $pageId );
        }
        catch( Exception $e ){
            throw new SitePageNotFoundException( $pageId, 0, $e );
        }
    }

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

    public function getAllPages()
    {
        return $this->pageIds;
    }

    public function getAllLanguages()
    {
        return $this->languages;
    }
    
    public function getGlobalHeader()
    {
        return $this->globalHeader;
    }
    
    public function getGlobalFooter()
    {
        return $this->globalFooter;
    }
        
}

?>

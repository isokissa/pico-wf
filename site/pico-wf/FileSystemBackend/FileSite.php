<?php


require_once( "pico-wf/Site.php" );
require_once( "FilePage.php" );
require_once( "FileStringLoader.php" );


class FileSite extends Site
{
    private $pageIds;
    private $languages;

    public function __construct()
    {
        $this->loadSiteConfiguration();
    }
    
    private function loadSiteConfiguration()
    {
        $stringLoader = new FileStringLoader( __DIR__."/../../contents/site.config" );
        $this->extractPageIds( $stringLoader->getString( "pages" ) );
        $this->extractLanguages( $stringLoader->getString( "languages" ) );
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

    public function getPageRenderer( $pageId, $language ){
        return new PageRenderer( $this, $pageId, $language );
    }

    public function getAllPages()
    {
        return $this->pageIds;
    }

    public function getAllLanguages()
    {
        return $this->languages;
    }
        
}

?>

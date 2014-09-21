<?php

require_once( "Factory.php" );

class PageRenderer 
{
    private $site;
    private $page; 
    private $languageId;


    /**
     * Throws exception SitePageLanguageNotFoundException if language is not
     * found. It will throw SitePageNotFoundException if pageId is not found. 
     */
    public function __construct( $site, $pageId, $languageId )
    {
        $this->site = $site;
        $this->page = $this->site->getPage( $pageId );
        if( !array_key_exists( $languageId, $this->site->getAllLanguages() ) ){
            throw new SitePageLanguageNotFoundException( $languageId );
        }
        $this->languageId = $languageId;
    }

    public function getTitle()
    {
        return htmlspecialchars( $this->page->getStringInLanguage( "TITLE", $this->languageId ) );
    }

    public function getMenu()
    {
        $pageIds = $this->site->getAllPages();
        ksort( $pageIds );
        $result = "";
        foreach( $pageIds as $pageId ){
            $page = $this->site->getPage( $pageId );
            $shortName = $page->getStringInLanguage( 'SHORT_TITLE', $this->languageId );
            $result = $result.$this->getMenuItem( $pageId, $shortName );
        }
        return $result;
    }
    
    private function getMenuItem( $pageId, $pageShortName )
    {
        return '<nav class="menu_item"><a href="index.php?'.
               'page='.$pageId.
               '&lang='.$this->languageId.
               '">'.$pageShortName.'</a></nav>';
    }

    public function getLanguageSelector()
    {
        $languages = $this->site->getAllLanguages();
        ksort( $languages );
        $result = ""; 
        foreach( $languages as $languageId => $language ){
            $result = $result.$this->getLanguageSelectorItem( $language->id, $language->name );
        }
        return $result;
    }

    private function getLanguageSelectorItem( $languageId, $languageName )
    {
        return '<nav class="language"><a href="index.php?'.
               'page='.$this->page->getId().
               '&lang='.$languageId.
               '">'.$languageName.'</a></nav>';
    }

    public function getArticle()
    {
        $article = $this->page->getStringInLanguage( "CONTENTS", $this->languageId );
        foreach( $this->page->getAllMacroNames() as $name ) {
            $value = $this->page->getMacro( $name );

            // use preg_replace to match ${`$name`} or $`$name`
            $article = preg_replace(sprintf('/\$\{?%s\}?/', $name), $value, $article);
        }
        // return variable expanded string
        return $article;
    }
}


?>

<?php

require_once( "Factory.php" );

class PageRenderer 
{
    
    private $site;
    private $page; 
    private $stringLoader;
    private $language;
    private $factory;


    public function __construct( $factory, $pageId, $language )
    {
        $this->site = $factory->makeSite();
        $this->page = $factory->makePage( $pageId );
        $this->stringLoader = $factory->makeStringLoader( $pageId, $language );
        $this->factory = $factory;
        $this->language = $language;
    }


    public function getTitle()
    {
        return htmlspecialchars( $this->stringLoader->getString( "TITLE" ) );
    }


    public function getMenu()
    {
        $pages = $this->site->getAllPages();
        ksort( $pages );
        $result = "";
        foreach( $pages as $pageId => $page ){
            $localStringLoader = $this->factory->makeStringLoader( $pageId, $this->language );
            $result = $result.$this->getMenuItem( $pageId, $localStringLoader->getString( 'SHORT_NAME' ) );
        }
        return $result;
    }
    
    private function getMenuItem( $pageId, $pageShortName )
    {
        return '<nav class="menuitem"><a href="index.php?'.
               'page='.$pageId.
               '&lang='.$this->language.
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
        $article = $this->page->getArticle();
    	foreach( $this->stringLoader->getAllNames() as $name ) {
            $value = $this->stringLoader->getString( $name );

            // use preg_replace to match ${`$name`} or $`$name`
            $article = preg_replace(sprintf('/\$\{?%s\}?/', $name), $value, $article);
    	}
        // return variable expanded string
        return $article;
    }



}


?>

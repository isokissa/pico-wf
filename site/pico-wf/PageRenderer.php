<?php

require_once( "Factory.php" );

class PageRenderer 
{
    
    private $site;
    private $page; 
    private $stringLoader;


    public function __construct( $factory, $pageName, $language )
    {
	$this->site = $factory->makeSite();
	$this->page = $factory->makePage( $pageName );
	$this->stringLoader = $factory->makeStringLoader( $pageName, $language );
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
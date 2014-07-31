<?php


require_once( "pico-wf/Site.php" );




class FileSite extends Site
{

    public function __construct()
    {
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

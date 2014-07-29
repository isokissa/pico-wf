<?php


/**
* This is supposed to contain different "admin" methods, for example for 
* checking the consistency etc. 
*/
abstract class Site 
{

    /**
     * Throws exception SitePageNotFoundException if page with given 
     * pageId is not found.
     * @return Page object for given pageId
     **/
    abstract public function getPage( $pageId );

    /**
     * Throws exception SitePageLanguageNotFoundException if language is not
     * found. It will throw SitePageNotFoundException if pageId is not found. 
     * @return get the PageRenderer object for given pageId and languageId
     **/
    abstract public function getPageRenderer( $pageId, $languageId );

    /**
     * @return all page ids and titles as map, for example: 
     *        [ "page1" => "Title of page1", 
     *          "page2" => "Title of page2" ];
     */
    abstract public function getAllPages();

    /**
     * @return map [ id => Language ] of all supported languages
     **/
	abstract public function getAllLanguages();

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

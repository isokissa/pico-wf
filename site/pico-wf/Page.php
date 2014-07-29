<?php


abstract class Page
{

    public function __construct( $pageId )
    {
        $this->init( $pageId );
    }

    abstract protected function init( $pageId );
    
    abstract protected function getId();

    /**
     * @return string for given name. Throws StringNotFoundException
     * if not found
     **/
    abstract public function getString( $name );

    /**
     * @return list of all names available
     **/
    abstract public function getAllStringNames();
    
    /**
     * Throws StringNotFoundException if string not found, or 
     * StringInLanguageNotFoundException if language is not found. 
     * @return string in given language
     **/
    abstract public function getStringInLanguage( $name, $languageId );
    
}

class PageNotFoundException extends Exception {}

class StringNotFoundException extends Exception {}

class StringInLanguageNotFoundException extends Exception {}

?>

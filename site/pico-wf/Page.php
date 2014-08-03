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
     * @return Macro for given name. Throws MacroNotFoundException
     * if not found
     **/
    abstract public function getMacro( $name );

    /**
     * @return list of the names of all available macros
     **/
    abstract public function getAllMacroNames();
    
    /**
     * Throws StringInLanguageNotFoundException if string or 
     * language is not found. 
     * @return string in given language
     **/
    abstract public function getStringInLanguage( $name, $languageId );
    
}

class PageNotFoundException extends Exception {}

class MacroNotFoundException extends Exception {}

class StringInLanguageNotFoundException extends Exception {}

?>

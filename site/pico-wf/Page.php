<?php

require_once( "StringLoader.php" );


class Page 
{
    private $pageId;
    private $stringLoader;
    private $macrosContext;

    public function __construct( $pageId, $stringLoader )
    {
        $this->pageId = $pageId;
        $this->stringLoader = $stringLoader;
        $this->macrosContext = $pageId.".page";
    }

    public function getId()
    {
        return $this->pageId;
    }
    
    /**
     * @return Macro for given name. Throws MacroNotFoundException
     * if not found
     **/
    public function getMacro( $name )
    {
        $this->stringLoader->setContext( $this->macrosContext );
        if( !$this->stringLoader->hasString( $name ) ){
            throw new PageMacroNotFoundException( $name );
        }
        return $this->stringLoader->getString( $name );
    }


    /**
     * @return list of the names of all available macros
     **/
    public function getAllMacroNames()
    {
        $this->stringLoader->setContext( $this->macrosContext );
        return $this->stringLoader->getAllStringNames();
    }


    /**
     * Throws StringInLanguageNotFoundException if string or 
     * language is not found. 
     * @return string in given language
     **/
    public function getStringInLanguage( $name, $languageId )
    {
        if( in_array( $name, array( "PAGE_ID", "SHORT_TITLE", "TITLE", "CONTENTS" ) ) ){            
            try{
                $this->stringLoader->setContext( $this->getId().".".$languageId.".text" );
            }
            catch( Exception $e ){
                throw new PageStringInLanguageNotFoundException( "lang=".$languageId, 0, $e );
            }
            return $this->stringLoader->getString( $name );
        }
        else{
            throw new PageStringInLanguageNotFoundException( $name );
        }
    }


}

class PageNotFoundException extends Exception {}

class PageMacroNotFoundException extends Exception {}

class PageStringInLanguageNotFoundException extends Exception {}


?>

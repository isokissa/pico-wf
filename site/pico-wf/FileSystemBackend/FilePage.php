<?php

require_once( "pico-wf/Page.php" );
require_once( "FileStringLoader.php" );


class FilePage extends Page
{

    private $pathToContents;
    private $macrosStringLoader;
    private $stringsInLanguages;


    public function __construct( $pageId, $pathToContents )
    {
        parent::__construct( $pageId );
        $this->pathToContents = $pathToContents;
        $this->macrosStringLoader = new FileStringLoader( $this->pathToContents."/".$this->pageId.".page" );
        $this->stringsInLanguages = array();
    }

    public function getId()
    {
        return $this->macrosStringLoader->getString( "PAGE-ID" );
    }
        
    public function getMacro( $name )
    {
        if( !$this->macrosStringLoader->hasString( $name ) ){
            throw new MacroNotFoundException( $name );
        }
        return $this->macrosStringLoader->getString( $name );
    }

    public function getAllMacroNames()
    {
        return $this->macrosStringLoader->getAllStringNames();
    }

    public function getStringInLanguage( $name, $languageId )
    {
        if( in_array( $name, array( "PAGE_ID", "SHORT_TITLE", "TITLE", "CONTENTS" ) ) ){
            if( !array_key_exists( $languageId, $this->stringsInLanguages ) ){
                try{
                    $languageStringLoader = 
                        new FileStringLoader( $this->pathToContents."/".$this->getId().".".$languageId.".text" );
                    $this->stringsInLanguages[ $languageId ] = $languageStringLoader; 
                }
                catch( Exception $e ){
                    throw new StringInLanguageNotFoundException( $languageId, 0, $e );
                }
            }
            return $this->stringsInLanguages[ $languageId ]->getString( $name );
        }
        else{
            throw new StringInLanguageNotFoundException( $name );
        }
    }


}

?>

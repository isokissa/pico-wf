<?php

require_once( "pico-wf/Page.php" );
require_once( "FileStringLoader.php" );


class FilePage extends Page
{

    private $macrosStringLoader;
    private $stringsInLanguages;


    protected function init( $pageId )
    {
        $this->macrosStringLoader = new FileStringLoader( __DIR__."/../../contents/".$pageId.".page" );
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
                        new FileStringLoader( __DIR__."/../../contents/".$this->getId().".".$languageId.".text" );
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

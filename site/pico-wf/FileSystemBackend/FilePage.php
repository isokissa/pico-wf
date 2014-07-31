<?php

require_once( "site/pico-wf/Page.php" );


class FilePage extends Page
{

    protected function init( $pageId )
    {
        
    }

    public function getId()
    {
        return $this->s[ "PAGE-ID" ];
    }
        
    public function getString( $name )
    {
        if( !array_key_exists( $name, $this->s ) ){
            throw new StringNotFoundException( $name );
        }
        return $this->s[ $name ];
    }

    public function getAllStringNames()
    {
        return array_keys( $this->s );
    }

    public function getStringInLanguage( $name, $languageId )
    {
        if( in_array( $name, array( "PAGE_ID", "SHORT_TITLE", "TITLE", "CONTENTS" ) ) ){
            if( !array_key_exists( $languageId, $this->sInLanguage ) ){
                throw new StringInLanguageNotFoundException( $languageId );
            }
            return $this->sInLanguage[ $languageId ][ $name ];
        }
        else{
            throw new StringNotFoundException( $name );
        }
    }


}

?>

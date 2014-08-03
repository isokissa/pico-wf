<?php

require_once( "site/pico-wf/Page.php" );


class StubPage extends Page
{

    private $s;
    private $sInLanguage;

    protected function init( $pageId )
    {
        if( $pageId == "page1" ){
            $this->s = array(
                "PAGE-ID" => "page1",
                "str1" => '<a href="sdfd.html">',
                "str2" => '</a>' );
            $this->s[ "long-str" ] = <<<EOS
many lines
with special characters < fdsf >> < $
ending with 
EOS;
            $this->s[ "next-long-str" ] = <<<EOS
first line
second line
EOS;
            $this->sInLanguage = array( 
                "en" => array( 
                        "PAGE_ID" => "page1",
                        "SHORT_TITLE" => "First",
                        "TITLE" => "Page One",
                        "CONTENTS" => <<<'EOS'
Here comes very nice text in English, with some ${str1}links to the 
unknown${str2} that you have to click, in order to try. 
EOS
                ),
                "fi" => array( 
                        "PAGE_ID" => "page1",
                        "SHORT_TITLE" => "Kotisivu",
                        "TITLE" => "Sivu yksi",
                        "CONTENTS" => <<<'EOS'
Täällä tule teksti Suomen kielessä, ${str1} linkit ovat täällä 
voit yrittää${str2} jo niin. 
EOS
                )
            );
        }
        else if( $pageId == "page2" ){
            $this->s = array(
                "PAGE-ID" => "page2",
                "str1" => "fixed string"
            );
            $this->sInLanguage = array( 
                "en" => array( 
                        "PAGE_ID" => "page2",
                        "SHORT_TITLE" => "Second",
                        "TITLE" => "Page two",
                        "CONTENTS" => <<<'EOS'
Second page, with some ${str1} links to the 
unknownthat you have to click, in order to try. 
EOS
                ),
                "fi" => array( 
                        "PAGE_ID" => "page2",
                        "SHORT_TITLE" => "Toinen Sivu",
                        "TITLE" => "Sivu kaksi",
                        "CONTENTS" => <<<'EOS'
Täällä tule teksti Suomen kielessä, ${str1} linkit ovat täällä 
voit bla bla
EOS
                )
            );
        }
        else{
            throw new PageNotFoundException();
        }
    }

    public function getId()
    {
        return $this->s[ "PAGE-ID" ];
    }
        
    public function getMacro( $name )
    {
        if( !array_key_exists( $name, $this->s ) ){
            throw new MacroNotFoundException( $name );
        }
        return $this->s[ $name ];
    }

    public function getAllMacroNames()
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
            throw new StringInLanguageNotFoundException( $name );
        }
    }

}

?>

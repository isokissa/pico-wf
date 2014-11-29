<?php

require_once( "site/pico-wf/StringLoader.php" );

class StubStringLoader implements StringLoader 
{
    private $currentContext = "";
    private $strings = [];
    private $contexts = 
        [ "page1.page" =>
            [ "PAGE-ID" => "page1",
              "str1" => '<a href="sdfd.html">',
              "str2" => '</a>',
              "long-str" => <<<EOS
many lines
with special characters < fdsf >> < $
ending with 
EOS
            ,
            "next-long-str" => <<<EOS
first line
second line
EOS
            ],
          "page1.en.text" => 
            [ "PAGE-ID" => "page1",
              "SHORT_TITLE" => "First",
              "TITLE" => "Page One",
              "CONTENTS" => <<<'EOS'
Here comes very nice text in English, with some ${str1}links to the 
unknown${str2} that you have to click, in order to try. 
EOS
            ],
          "page1.fi.text" => 
            [ "PAGE_ID" => "page1",
              "SHORT_TITLE" => "Kotisivu",
              "TITLE" => "Sivu yksi",
              "CONTENTS" => <<<'EOS'
Täällä tule teksti Suomen kielessä, ${str1} linkit ovat täällä 
voit yrittää${str2} jo niin. 
EOS
            ],
          "page2.page" =>
            [ "PAGE-ID" => "page2",
              "str1" => "fixed string"
            ],            
          "page2.en.text" => 
            [ "PAGE_ID" => "page2",
              "SHORT_TITLE" => "Second",
              "TITLE" => "Page two",
              "CONTENTS" => <<<'EOS'
Second page, with some ${str1} links to the 
unknownthat you have to click, in order to try. 
EOS
            ],
          "page2.fi.text" => 
            [ "PAGE_ID" => "page2",
              "SHORT_TITLE" => "Toinen Sivu",
              "TITLE" => "Sivu kaksi",
              "CONTENTS" => <<<'EOS'
Täällä tule teksti Suomen kielessä, ${str1} linkit ovat täällä 
voit bla bla
EOS
            ],
          "site.config" =>
            [ "pages" => "page1, page2",
              "languages" => "en ,English; fi,Suomi",
              "global-header" => '<img src="header.jpg">',
              "global-footer" => '<img src="footer.jpg">'
            ]

        ];


    public function setContext( $context )
    {
        if( array_key_exists( $context, $this->contexts ) ){
            $this->currentContext = $context; 
            $this->strings = $this->contexts[ $context ];
        }
        else{
            throw new StringLoaderInvalidContextException( $context );
        }
    }
    
    public function hasString( $stringName )
    {
        if( array_key_exists( $stringName, $this->strings ) ){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function getString( $stringName )
    {
        if( array_key_exists( $stringName, $this->strings ) ){
            return $this->strings[ $stringName ];
        }
        else{
            throw new StringLoaderStringNotFoundException( $stringName );
        }
    }
    
    public function getAllStringNames()
    {
        return array_keys( $this->strings ); 
    }
    
}


?>

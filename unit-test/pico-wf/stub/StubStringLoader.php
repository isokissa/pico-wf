<?php

require_once( "site/pico-wf/StringLoader.php" );

class StubStringLoader extends StringLoader
{

    private $pageId;
    private $language;
    private $stubValues;

    public function init( $pageId, $language )
    {
	if( $language !== "en" && $language !== "fi" ){
	    throw new StringLoaderLanguageNotFoundException( $language );
	}
	$this->pageId = $pageId; 
	$this->language = $language;
	$this->stubValues[ 'page1' ] = array( 
	    'en' => array( 
	        'TITLE' => 'Page One',
                'SHORT_NAME' => 'First',
		'str1' => 'test string one',
		'str2' => 'the second string',
	    ),
	    'fi' => array(
	    	'TITLE' => 'Sivu yksi',
		'SHORT_NAME' => 'Kotisivu',
		'str1' => 'ensimmäinen testi stringgi :) ',
		'str2' => 'toinen testi teksti',
	    ),
	);
	$this->stubValues[ 'page2' ] = array( 
	    'en' => array( 
	        'TITLE' => 'Page two',
                'SHORT_NAME' => 'Second',
		'mystr' => 'test string number two',
	    ),
	    'fi' => array(
	    	'TITLE' => 'Toinen sivu',
		'SHORT_NAME' => 'Toinen',
		'mystr' => 'toinen testi stringgi :) ',
	    ),
	);
    }


    public function getString( $name )
    {
	if( isset( $this->stubValues[ $this->pageId ][ $this->language ][ $name ] ) ){
	    return $this->stubValues[ $this->pageId ][ $this->language ][ $name ];
	}
	else{
	    throw new StringLoaderStringNotFoundException( $name );
	}
    }


    public function getAllNames()
    {
	return array_keys( $this->stubValues[ $this->pageId ][ $this->language ] );
    }


}

?>

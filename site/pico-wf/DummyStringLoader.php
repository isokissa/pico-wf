<?php

require_once( "StringLoader.php" );

class DummyStringLoader extends StringLoader
{

    private $pageName;
    private $language;
    private $dummyValues;


    public function init( $pageName, $language )
    {
	if( $language !== "en" && $language !== "fi" ){
	    throw new StringLoaderLanguageNotFoundException( $language );
	}
	$this->pageName = $pageName; 
	$this->language = $language;
	$this->dummyValues = array( 
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
    }


    public function getString( $name )
    {
	if( isset( $this->dummyValues[ $this->language ][ $name ] ) ){
	    return $this->dummyValues[ $this->language ][ $name ];
	}
	else{
	    throw new StringLoaderStringNotFoundException( $name );
	}
    }

}

?>

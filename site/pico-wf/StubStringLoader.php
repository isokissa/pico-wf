<?php

require_once( "StringLoader.php" );

class StubStringLoader extends StringLoader
{

    private $pageName;
    private $language;
    private $stubValues;


    public function init( $pageName, $language )
    {
	if( $language !== "en" && $language !== "fi" ){
	    throw new StringLoaderLanguageNotFoundException( $language );
	}
	$this->pageName = $pageName; 
	$this->language = $language;
	$this->stubValues = array( 
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
	if( isset( $this->stubValues[ $this->language ][ $name ] ) ){
	    return $this->stubValues[ $this->language ][ $name ];
	}
	else{
	    throw new StringLoaderStringNotFoundException( $name );
	}
    }


    public function getAllNames()
    {
	return array( 'TITLE', 'SHORT_NAME', 'str1', 'str2' );
    }


}

?>

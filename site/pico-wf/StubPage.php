<?php

require_once( "Page.php" );


class StubPage extends Page
{
    protected $pageName; 

    private $stubValues;

    protected function init( $pageName )
    {
	if( $pageName !== "page1" && $pageName !== "page2" ){
	    throw new PageNotFoundException();
	}
	$this->pageName = $pageName;
	$this->stubValues = array(
    	    "page1" => '${str1}<a href="google.com">google</a>${str2}',
	    "page2" => 'nothing yet',
        );
    }

    public function getArticle()
    {
	return $this->stubValues[ $this->pageName ];
    }


}

?>
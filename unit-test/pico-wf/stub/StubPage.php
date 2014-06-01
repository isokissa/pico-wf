<?php

require_once( "site/pico-wf/Page.php" );


class StubPage extends Page
{
    protected $id; 

    private $stubValues;

    protected function init( $pageId )
    {
	if( $pageId !== "page1" && $pageId !== "page2" ){
	    throw new PageNotFoundException();
	}
	$this->id = $pageId;
	$this->stubValues = array(
    	    "page1" => '${str1} <a href="google.com">google</a> ${str2}',
	    "page2" => '${mystr} mystr',
        );
    }

    public function getId()
    {
	return $this->id;
    }

    public function getArticle()
    {
	return $this->stubValues[ $this->id ];
    }


}

?>

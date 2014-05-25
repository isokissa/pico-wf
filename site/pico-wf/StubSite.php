<?php

require_once( "Site.php" );


class StubSite extends Site
{

	private $pages;


	public function __construct()
	{
		$this->pages = [ "page1" => new StubPage( "page1" ), 
						 "page2" => new StubPage( "page2" ) ];
	}

	public function getAllPages()
	{
		return $this->pages;
	}

}

?>

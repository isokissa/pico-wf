<?php

require_once( "site/pico-wf/Site.php" );


class StubSite extends Site
{

	private $pages;
	private $languages;


	public function __construct()
	{
		$this->pages = [ "page1" => new StubPage( "page1" ), 
						 "page2" => new StubPage( "page2" ) ];
		$this->languages = [ "en" => new Language( "en", "English" ),
							 "fi" => new Language( "fi", "Suomi" ) ];
	}

	public function getAllPages()
	{
		return $this->pages;
	}
	
	public function getAllLanguages()
	{
		return $this->languages;
	}

}

?>

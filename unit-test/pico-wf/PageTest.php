<?php

require_once( "site/pico-wf/Page.php" );


class PageTest extends PHPUnit_Framework_TestCase
{

    protected $page;

    protected function setUp()
    {
	$this->page = $GLOBALS["wfFactory"]->makePage( "page1" );
    }

    
    public function testConstruct()
    {
	$this->assertInstanceOf( "Page", $this->page );
    }


    public function testGetArticle()
    {
	$this->assertEquals( '${str1} <a href="google.com">google</a> ${str2}', $this->page->getArticle() );
    }

}

?>

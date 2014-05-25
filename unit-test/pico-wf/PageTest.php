<?php

require_once( "site/pico-wf/Page.php" );


class PageTest extends PHPUnit_Framework_TestCase
{

    protected $page1;
    protected $page2;

    protected function setUp()
    {
	$this->page1 = $GLOBALS["wfFactory"]->makePage( "page1" );
	$this->page2 = $GLOBALS["wfFactory"]->makePage( "page2" );
    }

    
    public function testConstruct()
    {
	$this->assertInstanceOf( "Page", $this->page1 );
	$this->assertInstanceOf( "Page", $this->page2 );
    }


    public function testGetArticle()
    {
	$this->assertEquals( '${str1} <a href="google.com">google</a> ${str2}', $this->page1->getArticle() );
	$this->assertEquals( '${mystr} mystr', $this->page2->getArticle() ); 
    }

}

?>

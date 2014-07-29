<?php

require_once( "site/pico-wf/Page.php" );


class PageTest extends PHPUnit_Framework_TestCase
{

    protected $page1;
    protected $page2;

    protected function setUp()
    {
	$site = $GLOBALS["wfFactory"]->makeSite();
	$this->page1 = $site->getPage( "page1" );
	$this->page2 = $site->getPage( "page2" );
    }

    
    public function testConstruct()
    {
	$this->assertInstanceOf( "Page", $this->page1 );
	$this->assertInstanceOf( "Page", $this->page2 );
	$this->assertEquals( "page1", $this->page1->getId() );
    }
    
    public function testGetStringUndefined()
    {
	$this->setExpectedException( "StringNotFoundException", "abc" );
	$this->page1->getString( "abc" );
    }

    public function testGetString()
    {
	$this->assertEquals( '<a href="sdfd.html">', $this->page1->getString( "str1" ) );
	$this->assertEquals( '</a>', $this->page1->getString( "str2" ) );
    }
    
    public function testGetAllStringNames()
    {
	$this->assertEquals( array( "PAGE-ID", "str1" ), $this->page2->getAllStringNames() );
    }

    public function testGetUndefinedStringInLanguage()
    {
	$this->setExpectedException( "StringNotFoundException", "abc" );
	$this->page1->getStringInLanguage( "abc", "en" );
    }

}

?>

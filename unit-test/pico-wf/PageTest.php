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
    
    public function testGetMacroUndefined()
    {
        $this->setExpectedException( "MacroNotFoundException", "abc" );
        $this->page1->getMacro( "abc" );
    }

    public function testGetMacro()
    {
        $this->assertEquals( '<a href="sdfd.html">', $this->page1->getMacro( "str1" ) );
        $this->assertEquals( '</a>', $this->page1->getMacro( "str2" ) );
    }
    
    public function testGetAllMacroNames()
    {
        $allStringNames = $this->page2->getAllMacroNames();
        $this->assertCount( 2, $allStringNames );
        $this->assertContains( "PAGE-ID", $allStringNames );
        $this->assertContains( "str1", $allStringNames );
    }

    public function testGetUndefinedStringInLanguage()
    {
        $this->setExpectedException( "StringInLanguageNotFoundException", "abc" );
        $this->page1->getStringInLanguage( "abc", "en" );
    }

}

?>

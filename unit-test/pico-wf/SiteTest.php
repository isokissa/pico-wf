<?php

require_once( "site/pico-wf/Site.php" );
require_once( "stub/StubStringLoader.php" );


class SiteTest extends PHPUnit_Framework_TestCase
{
    protected $stringLoader; 
    protected $site;

    protected function setUp()
    {
        $this->stringLoader = new StubStringLoader();
        $this->site = new Site( $this->stringLoader );
    }

    
    public function testConstruct()
    {
        $this->assertInstanceOf( "Site", $this->site );
    }

    public function testGetPageNonExisting()
    {
        $this->setExpectedException( "SitePageNotFoundException", "fail" );
        $this->site->getPage( 'fail' );
    }

    public function testGetPage()
    {
        $page = $this->site->getPage( "page1" );
        $this->assertInstanceOf( "Page", $page );
        $page = $this->site->getPage( "page2" );
        $this->assertInstanceOf( "Page", $page );
    }

    public function testGetPageRendererNonExistingPageGivesFirstPage()
    {
        $pageRenderer = $this->site->getPageRenderer( "pageX", "en" );
        $this->assertEquals( "Page One", $pageRenderer->getTitle() );
    }

    public function testGetPageRendererNonSupportedLanguageGivesFirstLanguage()
    {
        $pageRenderer = $this->site->getPageRenderer( "page1", "yu" );
        $this->assertEquals( "Page One", $pageRenderer->getTitle() );
    }

    public function testGetAllPages()
    {
        $pages = $this->site->getAllPages();
        $this->assertCount( 2, $pages );
        $this->assertContains( "page1", $pages );
        $this->assertContains( "page2", $pages );
    }

    public function testGetAllLanguages()
    {
        $languages = $this->site->getAllLanguages();
        $this->assertCount( 2, $languages );
        $this->assertArrayHasKey( "fi", $languages );
        $this->assertArrayHasKey( "en", $languages );
        $this->assertEquals( "Suomi", $languages[ "fi" ]->name );
        $this->assertEquals( "English", $languages[ "en" ]->name );
    }
    
    public function testGetGlobalFooter()
    {
        $this->assertEquals( '<img src="footer.jpg">', $this->site->getGlobalFooter() );
    }

    public function testGetGlobalHeader()
    {
        $this->assertEquals( '<img src="header.jpg">', $this->site->getGlobalHeader() );
    }

}

?>

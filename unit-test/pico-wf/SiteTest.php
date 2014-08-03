<?php

require_once( "site/pico-wf/Site.php" );


class SiteTest extends PHPUnit_Framework_TestCase
{

    protected $site;

    protected function setUp()
    {
        $this->site = $GLOBALS["wfFactory"]->makeSite();
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

    public function testGetPageRendererNonExistingPage()
    {
        $this->setExpectedException( "SitePageNotFoundException", "pageX" );
        $pageRenderer = $this->site->getPageRenderer( "pageX", "en" );
    }

    public function testGetPageRendererNonSupportedLanguage()
    {
        $this->setExpectedException( "SitePageLanguageNotFoundException", "de" );
        $pageRenderer = $this->site->getPageRenderer( "page1", "de" );
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


}

?>

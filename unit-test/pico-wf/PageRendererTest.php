<?php

require_once( "site/pico-wf/PageRenderer.php" );
require_once( "site/pico-wf/Site.php" );
require_once( "stub/StubStringLoader.php" );

class PageRendererTest extends PHPUnit_Framework_TestCase
{
    protected $pageRenderer;
    protected $site;

    protected function setUp()
    {
        $this->stringLoader = new StubStringLoader();
        $this->site = new Site( $this->stringLoader );
        $this->pageRenderer = $this->site->getPageRenderer( "page1", "en" );
    }

    
    public function testConstruct()
    {
        $this->assertInstanceOf( "PageRenderer", $this->pageRenderer );
    }
    
    public function testConstructWithInvalidPageIdThrows()
    {
        $this->setExpectedException( "SitePageNotFoundException", "abc" );
        $renderer = new PageRenderer( $this->site, "abc", "fi" );
    }
    
    public function testConstructWithInvalidLanguageThrows()
    {
        $this->setExpectedException( "SitePageLanguageNotFoundException", "yu" );
        $renderer = new PageRenderer( $this->site, "page1", "yu" );
    }

    public function testGetTitle()
    {
        $this->assertEquals( "Page One", $this->pageRenderer->getTitle() );
    }

    public function testGetArticle()
    {
        $expectedString = <<<EOS
Here comes very nice text in English, with some <a href="sdfd.html">links to the 
unknown</a> that you have to click, in order to try. 
EOS;
        $this->assertEquals( $expectedString, $this->pageRenderer->getArticle() );
    }


    public function testGetMenu()
    {
        $expectedString =  '<nav class="menu_item"><a href="index.php?page=page1&lang=en">First</a></nav>'.
                           '<nav class="menu_item"><a href="index.php?page=page2&lang=en">Second</a></nav>';
        $this->assertEquals( $expectedString, $this->pageRenderer->getMenu() );
    }


    public function testGetLanguageSelector()
    {
        $expectedString = '<nav class="language"><a href="index.php?page=page1&lang=en">English</a></nav>'.
                          '<nav class="language"><a href="index.php?page=page1&lang=fi">Suomi</a></nav>';
        $this->assertEquals( $expectedString, $this->pageRenderer->getLanguageSelector() );
    }
    
    public function testGetGlobalHeader()
    {
        $expectedString = '<img src="header.jpg">';
        $this->assertEquals( $expectedString, $this->pageRenderer->getGlobalHeader() );
    }
    
    public function testGetGlobalFooter()
    {
        $expectedString = '<img src="footer.jpg">';
        $this->assertEquals( $expectedString, $this->pageRenderer->getGlobalFooter() );
    }
        
}

?>

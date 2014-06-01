<?php

require_once( "site/pico-wf/PageRenderer.php" );


class PageRendererTest extends PHPUnit_Framework_TestCase
{

    protected $pageRenderer;

    protected function setUp()
    {
	$this->pageRenderer = new PageRenderer( $GLOBALS["wfFactory"], "page1", "en" );
    }

    
    public function testConstruct()
    {
	$this->assertInstanceOf( "PageRenderer", $this->pageRenderer );
    }

    public function testGetTitle()
    {
	$this->assertEquals( "Page One", $this->pageRenderer->getTitle() );
    }

    public function testGetArticle()
    {
	$expectedString = 'test string one <a href="google.com">google</a> the second string';
	$this->assertEquals( $expectedString, $this->pageRenderer->getArticle() );
    }

    public function testGetMenu()
    {
	$expectedString =  '<nav class="menuitem"><a href="index.php?page=page1&lang=en">First</a></nav>'.
			   '<nav class="menuitem"><a href="index.php?page=page2&lang=en">Second</a></nav>';
	$this->assertEquals( $expectedString, $this->pageRenderer->getMenu() );
    }

    public function testGetLanguageSelector()
    {
	$expectedString = '<nav class="language"><a href="index.php?page=page1&lang=en">English</a></nav>'.
			  '<nav class="language"><a href="index.php?page=page1&lang=fi">Suomi</a></nav>';
	$this->assertEquals( $expectedString, $this->pageRenderer->getLanguageSelector() );
    }
}

?>

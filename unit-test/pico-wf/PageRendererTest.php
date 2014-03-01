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


}

?>

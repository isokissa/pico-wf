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

    public function testGetAllPages()
    {
	$pages = $this->site->getAllPages();
	$this->assertCount( 2, $pages );
    }


}

?>

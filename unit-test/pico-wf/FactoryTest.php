<?php

require_once( "site/pico-wf/Factory.php" );


class FactoryTest extends PHPUnit_Framework_TestCase
{

    protected $factory; 

    protected function setUp()
    {
	$this->factory = $GLOBALS["wfFactory"];
    }

    public function testConstruct()
    {
	$this->assertInstanceOf( "Factory", $this->factory );
    }


    public function testMakeSite()
    {
	$this->assertInstanceOf( "Site", $this->factory->makeSite() );
    }


    public function testMakePage()
    {
	$this->assertInstanceOf( "Page", $this->factory->makePage( "page1" ) );
	$this->assertInstanceOf( "Page", $this->factory->makePage( "page2" ) );
    }


    /**
    * @expectedException PageNotFoundException
    */
    public function testMakePageNotFound()
    {
	$this->assertInstanceOf( "Page", $this->factory->makePage( "blabla" ) );
    }


    public function testMakeStringLoader()
    {
	$this->assertInstanceOf( "StringLoader", $this->factory->makeStringLoader( "page1", "en" ) );
    }


    /**
    * @expectedException StringLoaderLanguageNotFoundException
    */
    public function testMakeStringLoaderLanguageNotFound()
    {
	$this->setExpectedException( "StringLoaderLanguageNotFoundException", "de" );
	$this->assertInstanceOf( "StringLoader", $this->factory->makeStringLoader( "page1", "de" ) );
    }
    



}

?>

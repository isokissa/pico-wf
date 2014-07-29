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

}

?>

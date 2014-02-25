<?php

require_once( "site/pico-wf/StringLoader.php" );


class StringLoaderTest extends PHPUnit_Framework_TestCase
{

    protected $stringLoader; /* to be initialized by subclass to "page1", "en" */


    public function testConstruct()
    {
	$this->assertInstanceOf( "StringLoader", $this->stringLoader );
    }


    public function testGetStringNotFound()
    {
	$this->setExpectedException( "StringLoaderStringNotFoundException", "fail" );
	$this->assertEquals( 'fail', $this->stringLoader->getString( 'fail' ) );
    }


    public function testGetString()
    {
	$this->assertEquals( 'test string one', $this->stringLoader->getString( 'str1' ) );
	$this->assertEquals( 'the second string', $this->stringLoader->getString( 'str2' ) );
	$this->assertEquals( 'First', $this->stringLoader->getString( 'SHORT_NAME' ) );
    }

}

?>

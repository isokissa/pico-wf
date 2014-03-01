<?php


require_once( "site/pico-wf/Factory.php" );
require_once( "site/pico-wf/StringLoader.php" );


class StringLoaderTest extends PHPUnit_Framework_TestCase
{

    protected $stringLoader; 

    protected function setUp()
    {
	$this->stringLoader = $GLOBALS["wfFactory"]->makeStringLoader( "page1", "en" );
    }


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

    public function testGetAllNames()
    {
	$allStringNames = $this->stringLoader->getAllNames();
	$this->assertTrue( in_array( 'str1', $allStringNames ));
	$this->assertTrue( in_array( 'str2', $allStringNames ));
	$this->assertTrue( in_array( 'TITLE', $allStringNames ));
	$this->assertTrue( in_array( 'SHORT_NAME', $allStringNames ));
        $this->assertCount( 4, $allStringNames );
	
    }

}

?>

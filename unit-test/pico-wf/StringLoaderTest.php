<?php


require_once( "site/pico-wf/Factory.php" );
require_once( "site/pico-wf/StringLoader.php" );


class StringLoaderTest extends PHPUnit_Framework_TestCase
{

    protected $stringLoader1;
    protected $stringLoader2; 

    protected function setUp()
    {
	$this->stringLoader1 = $GLOBALS["wfFactory"]->makeStringLoader( "page1", "en" );
	$this->stringLoader2 = $GLOBALS["wfFactory"]->makeStringLoader( "page2", "fi" );
    }


    public function testConstruct()
    {
	$this->assertInstanceOf( "StringLoader", $this->stringLoader1 );
    }


    public function testGetStringNotFound()
    {
	$this->setExpectedException( "StringLoaderStringNotFoundException", "fail" );
	$this->assertEquals( 'fail', $this->stringLoader1->getString( 'fail' ) );
    }


    public function testGetString()
    {
	$this->assertEquals( 'test string one', $this->stringLoader1->getString( 'str1' ) );
	$this->assertEquals( 'the second string', $this->stringLoader1->getString( 'str2' ) );
	$this->assertEquals( 'First', $this->stringLoader1->getString( 'SHORT_NAME' ) );
	$this->assertEquals( 'Toinen sivu', $this->stringLoader2->getString( 'TITLE' ) );
	$this->assertEquals( 'Toinen', $this->stringLoader2->getString( 'SHORT_NAME' ) );
    }

    public function testGetAllNames()
    {
	$allStringNames = $this->stringLoader1->getAllNames();
	$this->assertTrue( in_array( 'str1', $allStringNames ));
	$this->assertTrue( in_array( 'str2', $allStringNames ));
	$this->assertTrue( in_array( 'TITLE', $allStringNames ));
	$this->assertTrue( in_array( 'SHORT_NAME', $allStringNames ));
        $this->assertCount( 4, $allStringNames );
    }

}

?>

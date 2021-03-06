<?php

require_once( "pico-wf/FileSystemBackend/FileStringLoader.php" );



class FileStringLoaderTest extends PHPUnit_Framework_TestCase
{

    private $stringLoader;

    protected function setUp()
    {
        $this->stringLoader = new FileStringLoader( "unit-test/FileSystemBackend" );
        $this->stringLoader->setContext( "test.text" );
    }


    public function testContextInvalidFileName()
    {
        $base = "unit-test/FileSystemBackend";
        $context = "abc.def"; 
        $this->setExpectedException( "StringLoaderInvalidContextException", $base."/".$context );
        $a = new FileStringLoader( $base );
        $a->setContext( $context );
    }
    
    public function testReadInvalidFile()
    {
        $this->setExpectedException( "FileStringLoaderFileReadException", "" );
        $a = new FileStringLoader( "unit-test/FileSystemBackend" );
        $a->setContext( "invalid.txt" );
    }
    
    public function testGetInvalidString()
    {
        $this->setExpectedException( "StringLoaderStringNotFoundException", "aaa" );
        $a = $this->stringLoader->getString( "aaa" );
    }
    
    public function testHasString()
    {
        $this->assertTrue( $this->stringLoader->hasString( "abc1" ) );
        $this->assertFalse( $this->stringLoader->hasString( "aaabbb" ) );
    }
    
    public function testGetAllStringNames()
    {
        $s = $this->stringLoader->getAllStringNames();
        $this->assertCount( 4, $s );
        $this->assertContains( "abc1", $s );
        $this->assertContains( "abc2", $s );
        $this->assertContains( "multi-line", $s );
        $this->assertContains( "the-other-multi-line", $s );
    }
    
    
    public function testGetString()
    {
        $this->assertEquals( "def", $this->stringLoader->getString( "abc1" ) );
        $this->assertEquals( "here is the text", $this->stringLoader->getString( "abc2" ) );
        $multiLine = <<<EOS
here you go
and second line
and third line
EOS;
        $this->assertEquals( $multiLine, $this->stringLoader->getString( "multi-line" ) );
        $multiLine = <<<EOS
abc
deafffad
EOS;
        $this->assertEquals( $multiLine, $this->stringLoader->getString( "the-other-multi-line" ) );
    }
    

}


?>

<?php


class IndexTest extends PHPUnit_Framework_TestCase
{

    public function testTitleEnglish()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "en";
        include( $GLOBALS["wfTestPage"] );
    }

    public function testTitleFinnish()
    {
        $this->expectOutputRegex( "/<title>Sivu yksi<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "fi";   
        include( $GLOBALS["wfTestPage"] );
    }
    
    public function testSecondPage()
    {
        $this->expectOutputRegex( "/<title>Page two<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $_GET["lang"] = "en";
        include( $GLOBALS["wfTestPage"] );      
    }
    
    public function testDefaultPage(){
        $this->expectOutputRegex( "/<title>Sivu yksi<\/title>/" );
        $_GET = array();
        $_GET["lang"] = "fi";   
        include( $GLOBALS["wfTestPage"] );
    }
    
    public function testDefaultLanguage()
    {
        $this->expectOutputRegex( "/<title>Page two<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page2";
        include( $GLOBALS["wfTestPage"] );      
    }

    public function testDefaultPageAndLanguage()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        include( $GLOBALS["wfTestPage"] );
    }
    
}

?>

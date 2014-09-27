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
    
    public function testTitleShownInPage()
    {
        $this->expectOutputRegex( "/<h1>Sivu yksi<\/h1>/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "fi";   
        include( $GLOBALS["wfTestPage"] );      
    }
    
    public function testGlobalHeaderShownInPage()
    {
        $this->expectOutputRegex( "/<img src=\"header.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "fi";   
        include( $GLOBALS["wfTestPage"] );      
    }
    
    public function testGlobalHeaderShownAlsoInOtherPage()
    {
        $this->expectOutputRegex( "/<img src=\"header.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $_GET["lang"] = "en";   
        include( $GLOBALS["wfTestPage"] );      
    }

    public function testGlobalFooterShownInPage()
    {
        $this->expectOutputRegex( "/<img src=\"footer.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $_GET["lang"] = "fi";   
        include( $GLOBALS["wfTestPage"] );      
    }
    
    public function testGlobalFooterShownAlsoInOtherPage()
    {
        $this->expectOutputRegex( "/<img src=\"footer.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "en";   
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
    
    public function testNoPageGivenShowsFirstPage(){
        $this->expectOutputRegex( "/<title>Sivu yksi<\/title>/" );
        $_GET = array();
        $_GET["lang"] = "fi";   
        include( $GLOBALS["wfTestPage"] );
    }
    
    public function testNoLanguageGivenShowsFirstLanguage()
    {
        $this->expectOutputRegex( "/<title>Page two<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page2";
        include( $GLOBALS["wfTestPage"] );      
    }

    public function testNoPageAndLanguageGivenShowFirstPageAndFirstLanguage()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        include( $GLOBALS["wfTestPage"] );
    }
    
    public function testWrongPageShowsFirstPage()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        $_GET["page"] = "non-existing-page";
        $_GET["lang"] = "en";
        include( $GLOBALS["wfTestPage"] );      
    }
    
}

?>

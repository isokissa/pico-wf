<?php

require_once( "stub/StubSite.php" );


class IndexTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->indexPage = "site/index.php";
    }


    public function testTitleEnglish()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "en";
        $site = new StubSite();
        include( $this->indexPage );
    }

    public function testTitleFinnish()
    {
        $this->expectOutputRegex( "/<title>Sivu yksi<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "fi";   
        $site = new StubSite();
        include( $this->indexPage );
    }
    
    public function testTitleShownInPage()
    {
        $this->expectOutputRegex( "/<h1>Sivu yksi<\/h1>/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "fi";   
        $site = new StubSite();
        include( $this->indexPage );      
    }
    
    public function testGlobalHeaderShownInPage()
    {
        $this->expectOutputRegex( "/<img src=\"header.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "fi";   
        $site = new StubSite();
        include( $this->indexPage );      
    }
    
    public function testGlobalHeaderShownAlsoInOtherPage()
    {
        $this->expectOutputRegex( "/<img src=\"header.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $_GET["lang"] = "en";   
        $site = new StubSite();
        include( $this->indexPage );      
    }

    public function testGlobalFooterShownInPage()
    {
        $this->expectOutputRegex( "/<img src=\"footer.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $_GET["lang"] = "fi";   
        $site = new StubSite();
        include( $this->indexPage );      
    }
    
    public function testGlobalFooterShownAlsoInOtherPage()
    {
        $this->expectOutputRegex( "/<img src=\"footer.jpg\">/" );
        $_GET = array();
        $_GET["page"] = "page1";
        $_GET["lang"] = "en";   
        $site = new StubSite();
        include( $this->indexPage );      
    }

    public function testSecondPage()
    {
        $this->expectOutputRegex( "/<title>Page two<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $_GET["lang"] = "en";
        $site = new StubSite();
        include( $this->indexPage );      
    }
    
    public function testNoPageGivenShowsFirstPage(){
        $this->expectOutputRegex( "/<title>Sivu yksi<\/title>/" );
        $_GET = array();
        $_GET["lang"] = "fi";   
        $site = new StubSite();
        include( $this->indexPage );
    }
    
    public function testNoLanguageGivenShowsFirstLanguage()
    {
        $this->expectOutputRegex( "/<title>Page two<\/title>/" );
        $_GET = array();
        $_GET["page"] = "page2";
        $site = new StubSite();
        include( $this->indexPage );      
    }

    public function testNoPageAndLanguageGivenShowFirstPageAndFirstLanguage()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        $site = new StubSite();
        include( $this->indexPage );
    }
    
    public function testWrongPageShowsFirstPage()
    {
        $this->expectOutputRegex( "/<title>Page One<\/title>/" );
        $_GET = array();
        $_GET["page"] = "non-existing-page";
        $_GET["lang"] = "en";
        $site = new StubSite();
        include( $this->indexPage );      
    }
    
}

?>

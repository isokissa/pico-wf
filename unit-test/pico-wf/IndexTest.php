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

}

?>

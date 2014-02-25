<?php

require_once( "site/pico-wf/DummyStringLoader.php" );
require_once( "StringLoaderTest.php" );


class DummyStringLoaderTest extends StringLoaderTest
{

    protected function setUp()
    {
	$this->stringLoader = new DummyStringLoader( "page1", "en" );
    }

}

?>

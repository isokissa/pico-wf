<?php

require_once( "site/pico-wf/DummyPage.php" );
require_once( "PageTest.php" );


class DummyPageTest extends PageTest
{

    protected function setUp()
    {
	$this->page = new DummyPage( "page1" );
    }

}

?>

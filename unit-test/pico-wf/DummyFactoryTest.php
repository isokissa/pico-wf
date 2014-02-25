<?php

require_once( "site/pico-wf/DummyFactory.php" );
require_once( "FactoryTest.php" );

class DummyFactoryTest extends FactoryTest
{

    protected function setUp(){
    	$this->factory = new DummyFactory();
    }

}

?>

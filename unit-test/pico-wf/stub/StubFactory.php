<?php

require_once( "site/pico-wf/Factory.php" );
require_once( "StubSite.php" );


class StubFactory implements Factory
{

    public function makeSite(){
    	return new StubSite();
    }

}

?>

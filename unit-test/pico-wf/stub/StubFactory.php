<?php

require_once( "site/pico-wf/Factory.php" );
require_once( "StubSite.php" );
require_once( "StubPage.php" );
require_once( "StubStringLoader.php" );


class StubFactory implements Factory
{

    public function makeSite(){
    	return new StubSite();
    }

    public function makePage( $pageId ){
    	return new StubPage( $pageId );
    }

    public function makeStringLoader( $page, $language ){
    	return new StubStringLoader( $page, $language );
    }

}

?>

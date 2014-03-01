<?php

require_once( "Factory.php" );
require_once( "StubSite.php" );
require_once( "StubPage.php" );
require_once( "StubStringLoader.php" );


class StubFactory implements Factory
{

    public function makeSite(){
    	return new StubSite();
    }

    public function makePage( $pageName ){
    	return new StubPage( $pageName );
    }

    public function makeStringLoader( $page, $language ){
    	return new StubStringLoader( $page, $language );
    }

}

?>
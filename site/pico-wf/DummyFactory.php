<?php

require_once( "Factory.php" );
require_once( "DummySite.php" );
require_once( "DummyPage.php" );
require_once( "DummyStringLoader.php" );


class DummyFactory implements Factory
{

    public function makeSite(){
    	return new DummySite();
    }

    public function makePage( $pageName ){
    	return new DummyPage( $pageName );
    }

    public function makeStringLoader( $page, $language ){
    	return new DummyStringLoader( $page, $language );
    }

}

?>
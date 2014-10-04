<?php

require_once( "pico-wf/Factory.php" );
require_once( "FileSite.php" );


class FileFactory implements Factory
{
    private $pathToContents;
    
    public function __construct( $pathToContents )
    {
        $this->pathToContents = $pathToContents;
    }

    public function makeSite(){
        return new FileSite( $this->pathToContents );
    }
}

?>

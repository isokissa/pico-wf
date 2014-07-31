<?php

require_once( "pico-wf/Factory.php" );
require_once( "FileSite.php" );


class FileFactory implements Factory
{

    public function makeSite(){
                return new FileSite();
    }

}

?>

<?php

interface Factory
{

    public function makeSite();
    public function makePage( $pageId );
    public function makeStringLoader( $pageId, $language );

}


?>

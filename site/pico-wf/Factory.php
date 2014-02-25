<?php

interface Factory
{

    public function makeSite();
    public function makePage( $pageName );
    public function makeStringLoader( $page, $language );

}


?>
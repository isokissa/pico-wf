<?php

interface Factory
{

    /**
     * Throws SiteInvalidException if the construction fails. 
     */
    public function makeSite();

}

class SiteInvalidException extends Exception {}

?>

<?php


/**
* This is supposed to contain different "admin" methods, for example for 
* checking the consistency etc. 
*/
abstract class Site 
{

    /**
     * @return all page objects as map, for example: 
     *        [ "page1" => new Page( "page1" ), 
     *          "page2" => new Page( "page2" ) ];
     */
    abstract public function getAllPages();


}

class Language
{
    public $id;
    public $name;
    
    public function __construct( $id, $name )
    {
        $this->id = $id;
        $this->name = $name;
    }

}

?>

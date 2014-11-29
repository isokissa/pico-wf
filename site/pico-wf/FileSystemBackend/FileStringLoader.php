<?php

require_once( __DIR__."/../StringLoader.php" );

class FileStringLoader implements StringLoader
{
    private $basePath;
    private $strings; 

    /**
     * Constructor specific to FileStringLoader
     */
    public function __construct( $basePath )
    {
        $this->basePath = $basePath;
        $this->strings = array();
        if( !file_exists( $this->basePath ) ){
            throw new FileStringLoaderBasePathNotFoundException( $this->basePath );
        }
    }
    
    public function setContext( $context )
    {
        $this->initFromFile( $this->basePath."/".$context );
    }
    
    private function initFromFile( $fileName )
    {
        if( !file_exists( $fileName ) ){
            throw new StringLoaderInvalidContextException( $fileName );
        }

        $handle = fopen( $fileName, "r" );
        $multiLineName = "";
        $multiLineValue = "";
        while( ($buffer = fgets( $handle, 4096 )) !== false ){
            if( strlen( $multiLineName ) == 0 ){
                $pos = strpos( $buffer, ":" );
                if( $pos === FALSE ){
                    # skip
                }
                else{
                    $name = trim( substr( $buffer, 0, $pos ) );
                    if( strlen( $name ) == 0 ){
                        throw new FileStringLoaderFileReadException( $fileName );
                    }
                    $value = trim( substr( $buffer, $pos+1 ) );
                    if( strlen( $value ) == 0 ){
                        $multiLineName = $name;
                        $multiLineValue = "";
                    }
                    else{
                        $this->strings[ $name ] = $value; 
                    }
                }
            }
            else{
                if( trim( $buffer ) === '===EOS===' ){
                    $this->strings[ $multiLineName ] = rtrim( $multiLineValue, "\r\n" );
                    $multiLineName = "";
                    $multiLineValue = "";
                }
                else{
                    $multiLineValue .= $buffer;
                }
            }
        }
        if( !feof( $handle ) ){
            throw new FileStringLoaderFileReadException();
        }
        if( strlen( $multiLineName ) != 0 ){
            $this->strings[ $multiLineName ] = rtrim( $multiLineValue, "\r\n" );
        }
        fclose( $handle );
    }
    
    public function hasString( $stringName )
    {
        return array_key_exists( $stringName, $this->strings );
    }
    
    public function getString( $stringName )
    {
        if( !$this->hasString( $stringName ) ){
            throw new StringLoaderStringNotFoundException( $stringName );
        }
        return $this->strings[ $stringName ];
    }
    
    public function getAllStringNames()
    {
        return array_keys( $this->strings );
    }
    
}

class FileStringLoaderBasePathNotFoundException extends Exception {}

class FileStringLoaderFileReadException extends Exception {}


?>

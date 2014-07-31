<?php

class FileStringLoader 
{

    private $strings; 

    /**
     * Throws an exception FileStringLoaderNotFoundException if fileName does not exist
     */
    public function __construct( $fileName )
    {
        $this->strings = array();
        if( !file_exists( $fileName ) ){
            throw new FileStringLoaderFileNotFoundException( $fileName );
        }
        $this->initFromFile( $fileName );
    }
    
    private function initFromFile( $fileName )
    {
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
                if( trim( $buffer ) === '===' ){
                    $this->strings[ $multiLineName ] = rtrim( $multiLineValue );
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
            $this->strings[ $multiLineName ] = rtrim( $multiLineValue );
        }
        fclose( $handle );
    }
    
    public function getString( $stringName )
    {
        if( !array_key_exists( $stringName, $this->strings ) ){
            throw new FileStringLoaderStringNotFoundException( $stringName );
        }
        return $this->strings[ $stringName ];
    }
    
    public function getAllStringNames()
    {
        return array_keys( $this->strings );
    }
    
}

class FileStringLoaderFileNotFoundException extends Exception {}

class FileStringLoaderFileReadException extends Exception {}

class FileStringLoaderStringNotFoundException extends Exception {}


?>

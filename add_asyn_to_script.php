<?php

/**
 * 
 *  Add Asyn Attribute To Script Tag
 * 
 */

add_filter( 'script_loader_tag', 'add_async_to_script', 10, 3 );
function add_async_to_script( $tag, $handle, $src ) {
	//You can use this to make all async
	$tag = str_replace( ' src', ' defer src', $tag );
    
    /*
        You can use this to make it work as below for a specific script

        if ( 'dropbox.js' === $handle ) {
            $tag = '<script defer type="text/javascript" src="' . esc_url( $src ) . '"></script>';
        }
    */

    // For All script Tags
    $tag = '<script defer type="text/javascript" src="' . esc_url( $src ) . '"></script>';

	return $tag;
}

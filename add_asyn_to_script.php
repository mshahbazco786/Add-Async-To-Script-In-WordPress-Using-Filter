<?php

/**
 * 
 *  Add Asyn Attribute To Script Tag
 *
 *  Async scripts load in the background and run when ready. The DOM and other scripts don’t wait for them, and they don’t wait for anything. 
 *  A fully independent script that runs when loaded. As simple, as it can get, right? Here’s an example similar to what we’ve seen with 
 *  defer: two scripts long.js and small.js, but now with async instead of defer.
 *
 *  They don’t wait for each other. Whatever loads first (probably small.js) – runs first:
 *
 */

add_filter( 'script_loader_tag', 'add_async_to_script', 10, 3 );
function add_async_to_script( $tag, $handle, $src ) {
	//You can use this to make all async
	$tag = str_replace( ' src', ' async src', $tag );
    
    /*
        You can use this to make it work as below for a specific script

        if ( 'dropbox.js' === $handle ) {
            $tag = '<script defer type="text/javascript" src="' . esc_url( $src ) . '"></script>';
        }
    */

    // For All script Tags
    $tag = '<script async type="text/javascript" src="' . esc_url( $src ) . '"></script>';

	return $tag;
}

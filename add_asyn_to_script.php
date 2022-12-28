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


// Enqueue Styles and js Deffer and Async
function add_defer_attribute($tag, $handle) {
    // add script handles to the array below
    $scripts_to_defer = array('my-js-handle', 'another-handle');

    foreach ($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
if (!is_admin()) {

    function add_asyncdefer_attribute($tag, $handle) {
        // if the unique handle/name of the registered script has 'async' in it
        if (strpos($handle, 'async') !== false) {
            // return the tag with the async attribute
            return str_replace('<script ', '<script async ', $tag);
        }
        // if the unique handle/name of the registered script has 'defer' in it
        else if (strpos($handle, 'defer') !== false) {
            // return the tag with the defer attribute
            return str_replace('<script ', '<script defer ', $tag);
        }
        // otherwise skip
        else {
            return $tag;
        }
    }

    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}

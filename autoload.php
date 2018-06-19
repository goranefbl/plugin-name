<?php

spl_autoload_register( function ( $class ) {
	// project-specific namespace prefix
	$prefix = 'Plugin_Name';
	// base directory for the namespace prefix
	$base_dir = WP_PLUGIN_DIR;
	// does the class use the namespace prefix?
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		// no, move to the next registered autoloader
		return;
    }
    
	// replace all underscores with hyphen
	$relative_class = str_replace( '_', '-', $class );
	// prepend class name with class-
	$relative_class = strtolower( preg_replace( '/([^\\\\]+)$/i', '$2class-$1', $relative_class ) );
	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir.'/' . str_replace( '\\', '/', $relative_class ) . '.php';
    //wp_die($file);
	// if the file exists, require it
	if ( file_exists( $file ) ) {
		require $file;
	}
} );
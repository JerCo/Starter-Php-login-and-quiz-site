#!/usr/bin/php
<?php

$handle = fopen( 'php://stdout', 'w' ) ;
fwrite( $handle, "Hello World! \n" );
fclose( $handle );

//Two resource constants STDIN and STDOUT can also be used as 
//file handles. This saves you from using fopen:
fwrite( STDOUT, "Hello World! \n" );
fwrite( STDERR, "ERROR ERROR! \n" );

?>
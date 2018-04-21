<?php

return [

	'maxsize' => 500, // Max vert or horiz resolution

	'quality' => 90, // Set compression level (1 lowest quality, 100 highest quality)

 	/*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | depends on filesystem configuration
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disk' => 'local', // supported Drivers: "local", "ftp", "s3", "rackspace" 

	/*
    |--------------------------------------------------------------------------
    |
    | In Laravel's Flysystem integration, "visibility" is an abstraction of file permissions across multiple | platforms. Files may either be declared public or private. When a file is declared  public, you are 
    | indicating that the file should generally be accessible to others. For example, when using the S3 
    | driver, you may retrieve URLs for public files.
    |
    */

   'visibility' => 'public' // 'public' , 'private'
];
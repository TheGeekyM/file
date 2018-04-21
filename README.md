# file
geeky-file
===================

This package make upload files so easy localy or on colou

##Requirements

For the creation of thumbnails of svg's or pdf's you should also install Imagick.

## Installation

Install using composer:
    
      composer require geeky/file
    

Then, in `config/app.php`, add the following to the service providers array.

    array(
       ...
      Geeky\File\FileServiceProvider::class,
    )
    
Finally, in `config/app.php`, add the following to the facades array.

    array(
        ...
         'Gfile' => Geeky\file\FileFacade::class,
    )

## Usage

Example usage using Facade:
    
 Upload file .. 
 If the uploaded file is image it will upload the original image in the path you want and it will make thumbs dir in the same path to store thumb image automatically and you determine the max-width and the quality of thumb images from config file.
    
    Gfile::upload($file , 'path/you/want/');

Delete files..
You can pass a sigle file path or an array of files paths to delete
    
    Gfile::delete($file_path);

Get file visibility..
You can get the visibility of any file you want .. the visibility should be public or private

    Gfile::getVisibility($file_path);
    
Set file visibility..
You can set the visibility of any file you want .. the visibility should be public or private

    Gfile::stVisibility($file_path);


You can publish the config-file with:

    php artisan vendor:publish --provider="Geeky\File\FileServiceProvider" --tag="config"

This is the contents of the published config file:

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
        | In Laravel's Flysystem integration, "visibility" is an abstraction of file permissions across 
        | multiple platforms. Files may either be declared public or private. When a file is declared
        | public, you are indicating that the file should generally be accessible to others. For example, 
        | when using the S3 driver, you may retrieve URLs for public files.
        |
        */

        'visibility' => 'public' // 'public' , 'private'
    ];


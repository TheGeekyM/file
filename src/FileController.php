<?php

namespace Geeky\File;

/* Includes */
use App;
use Storage;
use Imagick;
use App\Http\Controllers\Controller;


class FileController extends Controller
{

	private $storage;

	public function __construct()
	{
		$this->storage = Storage::disk(config('filesuploader.disk'));
	}

	public function upload($file, $path = 'files', $identifier = null)
	{
		$identifier = (!$identifier)? pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME):$identifier;
		$identifier = $identifier . '-' .uniqid() . '.' . $file->getClientOriginalExtension();

        //if the file is image
		if (substr($file->getMimeType(), 0, 5) == 'image') 
		{
            //save original images in storage 
			$this->uploadOriginalImage($file, $path . '/' . $identifier);
			$this->uploadThumbImage($file, $path . '/thumbs/' . $identifier);

			return $identifier;
		}

        //upload the file to storage
		$file_path = $path . '/' . $identifier;
		$this->storage->put($file_path, file_get_contents($file), config('filesuploader.visibility'));
		return $identifier; //return with the file name
	}

	private function uploadOriginalImage($image, $file_path)
	{
        //upload original image
		$this->storage->put($file_path, file_get_contents($image), config('filesuploader.visibility'));
	}


	private function uploadThumbImage($image , $file_path)
	{
		// Max vert or horiz resolution
		$maxsize = config('filesuploader.maxsize');

		/* read the source image */
		$imagick = new \Imagick($image->getRealPath());

		// Set compression level (1 lowest quality, 100 highest quality)
		$imagick->setImageCompressionQuality(config('filesuploader.quality'));

		// Resizes to whichever is larger, width or height
		if($imagick->getImageHeight() <= $imagick->getImageWidth())
		{
			// Resize image using the lanczos resampling algorithm based on width
			$imagick->resizeImage($maxsize,0,Imagick::FILTER_LANCZOS,1);
		}
		else
		{
			// Resize image using the lanczos resampling algorithm based on height
			$imagick->resizeImage(0,$maxsize,Imagick::FILTER_LANCZOS,1);
		}


		$image = $imagick->getImageBlob();

	    // Destroys Imagick object, freeing allocated resources in the process
		$imagick->destroy();

		
		$this->storage->put($file_path, $image, config('filesuploader.visibility'));
	}

	public function delete($file)
	{
		return $this->storage->delete($file);
	}

	public function getVisibility($file)
	{
		return $this->storage->getVisibility($file);
	}

	function setVisibility($file, $visibility = 'public')
	{
		return $this->storage->setVisibility($file, $visibility);
	}

}

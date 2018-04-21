<?php
namespace Geeky\File;

use Illuminate\Support\Facades\Facade;

class FileFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return FileController::class; }

}
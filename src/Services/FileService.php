<?php

namespace GabiCMontes\ApiGen\Services;

use Illuminate\Filesystem\Filesystem;

class FileService
{
    protected $fileSystem;

    public function __construct()
    {
        $this->fileSystem = new Filesystem();
    }

    public function put($path, $content, $name) : bool
    {
        if (!$this->fileSystem->isDirectory($path)) {
            $this->fileSystem->makeDirectory($path, 0755, true);
        }

        $path = $path . '/' . $name;

        if ($this->fileSystem->put($path, $content)) {
            return true;
        }

        return false;
    }
}

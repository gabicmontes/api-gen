<?php

namespace GabiCMontes\ApiGen\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ApiGen extends Command
{
    protected $signature = 'app:api-gen {model} {fields*}';

    protected $description = 'Generate an API for a given model';

    protected $files;
    protected $modelName;
    protected $variableName;
    protected $variableNamePlural;
    protected $fieldsWithTypes;
    protected $fields;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
    }
}

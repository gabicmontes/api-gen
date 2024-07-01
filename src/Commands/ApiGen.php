<?php

namespace GabiCMontes\ApiGen\Commands;

use Illuminate\Console\Command;

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

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->modelName = $this->argument('model');
        $this->variableName = lcfirst($this->modelName);
        $this->variableNamePlural = $this->pluralize($this->variableName);

        $this->validFields();

        $this->fieldsWithTypes = $this->argument('fields');
        $this->fields = array_map(function ($field) {
            return explode(':', $field)[0];
        }, $this->fieldsWithTypes);
    }

    private function validFields()
    {
        foreach ($this->argument('fields') as $field) {
            $type = explode(':', $field);
            if (empty($type[1])) {
                $this->error('O campo deve ser no formato nome:tipo');
                die();
            }
        }
    }

    private function pluralize($word)
    {
        $lastLetter = strtolower($word[strlen($word) - 1]);
        $lastTwoLetters = strtolower(substr($word, -2));

        if (in_array($lastTwoLetters, ['ch', 'sh'])) {
            return $word . 'es';
        }
        if ($lastLetter == 's' || $lastLetter == 'x' || $lastLetter == 'z') {
            return $word . 'es';
        }
        if ($lastLetter == 'y' && !in_array(strtolower($word[strlen($word) - 2]), ['a', 'e', 'i', 'o', 'u'])) {
            return substr($word, 0, -1) . 'ies';
        }
        if ($lastLetter == 'f') {
            return substr($word, 0, -1) . 'ves';
        }
        if ($lastTwoLetters == 'fe') {
            return substr($word, 0, -2) . 'ves';
        }
        return $word . 's';
    }
}

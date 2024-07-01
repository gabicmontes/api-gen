<?php

namespace GabiCMontes\ApiGen\Services;


class ModelService
{
    protected $modelName;
    protected $fields;
    protected $fileService;

    public function __construct($modelName, $fields)
    {
        $this->modelName = $modelName;
        $this->fields = $fields;
        $this->fileService = new FileService();
    }

    public function generate()
    {
        $fileContent = $this->getContent();
        $path = "app/Models";
        $name = "{$this->modelName}.php";
        $this->fileService->put($path, $fileContent, $name);
    }

    private function getContent()
    {
        $fillable = $this->fields;
        $fillable = array_map(function ($field) {
            return "'$field',";
        }, $fillable);
        $fillable = implode("\n        ", $fillable);
        return <<<PHP
         <?php
         
         namespace App\Models;
         
         use Illuminate\Database\Eloquent\Model;
         use Illuminate\Database\Eloquent\SoftDeletes;
         use Illuminate\Database\Eloquent\Factories\HasFactory;
         
         class {$this->modelName} extends Model
         {
             use HasFactory, SoftDeletes;

             protected \$fillable = [
                 {$fillable}
             ];
         }
         PHP;
    }
}

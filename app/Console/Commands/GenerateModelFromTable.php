<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateModelFromTable extends Command
{
    protected $signature = 'model {table} {model?}';

    protected $description = 'Generate a new model class based on the table structure';

    public function handle()
    {
        /*        $modelName = $this->argument('model');
                $tableName = Str::plural(Str::snake($modelName));*/
        $tableName = $this->argument('table');
        $modelName = $this->argument('model') ?: Str::studly(Str::singular($tableName));
        $columns = Schema::getColumnListing($tableName);
        $excludedFields = ['id'];
        $columns = array_diff($columns, $excludedFields);
        $fillable = implode("', '", $columns);
        $useSoftDeletes = in_array('deleted_at', $columns) ? 'use SoftDeletes;' : '';
        $importSoftDeletes = $useSoftDeletes != '' ? 'use Illuminate\Database\Eloquent\SoftDeletes;' : '';
        $stub = File::get(base_path('stubs/model.stub'));

        $classContent = str_replace(
            ['{{modelName}}', '{{fillable}}', '{{useSoftDeletes}}', '{{importSoftDeletes}}'],
            [$modelName, $fillable, $useSoftDeletes, $importSoftDeletes],
            $stub
        );
        if ($modelName === Str::studly(Str::singular($tableName))) {
            $classContent = str_replace("protected \$table = '{{tableName}}';", '', $classContent);
        }
        $classContent = str_replace('{{tableName}}', $tableName, $classContent);
        $modelPath = app_path('Models/' . $modelName . '.php');
        File::put($modelPath, $classContent);

        $this->info('Model ' . $modelName . ' created successfully!');
        $this->info('Path: ' . $modelPath);
    }
}

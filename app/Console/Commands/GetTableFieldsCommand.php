<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class GetTableFieldsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:get-field {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $modelName = "App\Models\\" . $this->argument('model');
        $model = app()->make($modelName);
        $tableName = $model->getTable();
        $columns = Schema::getColumnListing($tableName);

        $excludedFields = ['id'];

        $fields = array_map(function ($column) use ($excludedFields) {
            if (!in_array($column, $excludedFields)) {
                return "'$column'";
            }
        }, $columns);
        $fieldsString = '[' . ltrim(implode(',', $fields), ',') . '];';

        $this->info('Fields of table ' . $tableName . ':');
        $this->line($fieldsString);
    }
}

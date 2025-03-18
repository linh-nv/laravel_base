<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {group} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $group = $this->argument('group');
        $module = $this->argument('module');
        //make model
        exec("php artisan make:model Models\\{$module}",$makeModelMessage);
        $this->info(implode("\n",$makeModelMessage));
        //make controller
        exec("php artisan make:controller {$group}Controllers\\{$module}Controller --resource",$makeControllerMessage);
        $this->info(implode("\n",$makeControllerMessage));
        //make request
        exec("php artisan make:request {$group}Requests\\{$module}\\StoreRequest",$makeStoreRequestMessage);
        $this->info("Store: ".implode("\n",$makeStoreRequestMessage));
        exec("php artisan make:request {$group}Requests\\{$module}\\UpdateRequest",$makeUpdateRequestMessage);
        $this->info("Update: ".implode("\n",$makeUpdateRequestMessage));
        //make resource
        exec("php artisan make:resource {$module}\\{$module}Resource",$makeResourceMessage);
        $this->info("Resource: ".implode("\n",$makeResourceMessage));
        exec("php artisan make:resource {$module}\\{$module}ResourceCollection",$makeResourceCollectionMessage);
        $this->info("Resource Collection: ".implode("\n",$makeResourceCollectionMessage));
    }
}

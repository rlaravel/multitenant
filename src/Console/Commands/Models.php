<?php

namespace RafaelMorenoJS\MultiTenant\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

/**
 * Class Models
 * @package RafaelMorenoJS\MultiTenant\Commands
 */
class Models extends Command
{
    /**
     * @var string
     */
    protected $folderModelTenant;

    /**
     * @var string
     */
    protected $folderMigrationTenant;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:model {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creamos un modelo en la base de datos del inquilino.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->folderModelTenant = config('tenant.folder_models_tenant');
        $this->folderMigrationTenant = config('tenant.folder_migrations_tenant');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('model');

        $this->directoryExist();
        $this->createModel($name);
        $this->createMigration(strtolower(Str::plural($name)));
    }

    /**
     * @param string $name
     * @return void
     */
    private function createModel(string $name)
    {
        Artisan::call('make:model', [
            'name' => "Models/{$this->folderModelTenant}/{$name}"
        ]);
    }

    /**
     * @param string $name
     * @return void
     */
    private function createMigration(string $name)
    {
        Artisan::call('make:migration', [
            'name' => "create_{$name}_table",
            '--path' => "database/{$this->folderMigrationTenant}",
            '--create'=> $name
        ]);
    }

    /**
     * @return void
     */
    private function directoryExist()
    {
        $path = database_path('migrations_tenant');

        if (!is_dir($path)) {
            mkdir($path);
        }
    }
}

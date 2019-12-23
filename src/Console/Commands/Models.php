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
    protected $signature = 'tenant:model {model : Nombre del modelo}
                                         {--O|observation : Si queremos que use la tabla observations para guardar estos registros}';

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
        $this->createMigration($name);
    }

    /**
     * @param string $name
     * @return void
     */
    private function createModel(string $name)
    {
        /*
        $this->call('make:model', [
            'name' => "Models/{$this->folderModelTenant}/{$name}",
        ]);

        $this->info(Artisan::output());
        */

        $modelTemplate = str_replace("DummyClass", $name, $this->getStub());
        $modelTemplate = str_replace("DummyNamespace", "App\Models\\{$this->folderModelTenant}", $modelTemplate);

        if (!$this->option('observation')) {
            $modelTemplate = str_replace("use RafaelMorenoJS\MultiTenant\Traits\Observationable;", "", $modelTemplate);
            $modelTemplate = str_replace("use Observationable;", "//", $modelTemplate);
        }

        file_put_contents("app/Models/{$this->folderModelTenant}/{$name}.php", $modelTemplate);

        $this->info("Se ha credo el modelo App\Models\\{$this->folderModelTenant}\\{$name}");
    }

    /**
     * @param string $name
     * @return void
     */
    private function createMigration(string $name)
    {
        $name = Str::snake(Str::pluralStudly(class_basename($name)));

        $this->call('make:migration', [
            'name' => "create_{$name}_table",
            '--path' => "database/{$this->folderMigrationTenant}",
            '--create'=> $name
        ]);

        $this->info(Artisan::output());
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

    /**
     * @param $type
     * @return false|string
     */
    protected function getStub()
    {
        return file_get_contents(__DIR__ . "/stubs/model.stub");
    }
}

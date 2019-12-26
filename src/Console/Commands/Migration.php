<?php

namespace RafaelMorenoJS\MultiTenant\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Class Migration
 * @package RafaelMorenoJS\MultiTenant\Console\Commands
 */
class Migration extends Command
{
    /**
     * @var string
     */
    protected $folderMigrationTenant;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migration {name : Nombre de la migración}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creamos una migración en la base de datos del inquilino.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->folderMigrationTenant = config('tenant.folder_migrations_tenant');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->call('make:migration', [
            'name' => $name,
            '--path' => "database/{$this->folderMigrationTenant}"
        ]);

        $this->info(Artisan::output());
    }
}
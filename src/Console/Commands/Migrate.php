<?php


namespace RLaravel\MultiTenant\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class Migrate
 * @package RLaravel\MultiTenant\Console\Commands
 */
class Migrate extends Command
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
    protected $signature = 'tenant:migrate {tenant : base de datos del inquilino}
                                            {--F|fresh : Refrescamos todo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecutamos las migraciones del inquilino.';

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
        $tenant = $this->argument('tenant');
        $fresh = $this->option('fresh');
        $commad = ($fresh) ? 'migrate:fresh' : 'migrate';

        DB::purge('tenant');

        Config::set('database.connections.tenant.host', config('database.connections.mysql.host'));
        Config::set('database.connections.tenant.database', $tenant);
        Config::set('database.connections.tenant.username', config('database.connections.mysql.username'));
        Config::set('database.connections.tenant.password', config('database.connections.mysql.password'));

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();

        Artisan::call($commad, [
            '--database' => 'tenant',
            '--path' => "database/{$this->folderMigrationTenant}"
        ]);

        $this->info(Artisan::output());
    }
}
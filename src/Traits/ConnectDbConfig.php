<?php

namespace RafaelMorenoJS\MultiTenant\Traits;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Trait ConnectDbConfig
 * @package RafaelMorenoJS\MultiTenant\Traits
 */
trait ConnectDbConfig
{
    /**
     * @var string
     */
    protected $server;

    /**
     * @var string
     */
    protected $database;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     *
     */
    public function connect()
    {
        if (!$this->connected()) {
            DB::purge('tenant');

            Config::set('database.connections.tenant.host', $this->server);
            Config::set('database.connections.tenant.database', $this->database);
            Config::set('database.connections.tenant.username', $this->username);
            Config::set('database.connections.tenant.password', $this->password);

            DB::reconnect('tenant');

            Schema::connection('tenant')->getConnection()->reconnect();

            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/' . config('tenant.folder_migrations_tenant')
            ]);
        }
    }

    /**
     * @return bool
     */
    private function connected()
    {
        $data = $this->decrypt($this->config);

        $this->server = $data['server'];
        $this->database = $data['database'];
        $this->username = $data['username'];
        $this->password = $data['password'];

        $connection = Config::get('database.connections.tenant');

        return $connection['username'] == $this->username &&
            $connection['password'] == $this->password &&
            $connection['database'] == $this->database;
    }
}

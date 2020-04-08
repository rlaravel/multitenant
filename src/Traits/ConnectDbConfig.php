<?php

namespace RLaravel\MultiTenant\Traits;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Trait ConnectDbConfig
 * @package RLaravel\MultiTenant\Traits
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
     * @param string|null $config
     */
    public function connect(string $config = null)
    {
        if (!$this->connected($config)) {
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
     * @param string|null $config
     * @return bool
     */
    private function connected(string $config = null)
    {
        $data = $this->decrypt(($config ?? $this->config));

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

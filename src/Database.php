<?php

namespace MorenoRafael\MultiTenant;

use Illuminate\Support\Facades\DB;
use MorenoRafael\MultiTenant\Models\DbConfig;
use MorenoRafael\MultiTenant\Traits\Crypt;

/**
 * Class Database
 * @package MorenoRafael\MultiTenant
 */
class Database
{
    use Crypt;

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
     * Database constructor.
     */
    public function __construct()
    {
        $time = date('U');
        $this->database = "db_{$time}";
        $this->username = config('tenant.config.username');
        $this->password = config('tenant.config.password');
    }

    /**
     * @return DbConfig
     */
    public function saveConfig()
    {
        $data = [
            'server' => '127.0.0.1',
            'database' => $this->database,
            'username' => $this->username,
            'password' => $this->password,
        ];

        $data = $this->encrypt($data);
        $db = new DbConfig;
        $db->config = $data;

        if ($db->save()) {
            $this->create();

            return $db;
        }
    }

    /**
     *
     */
    private function create()
    {
        DB::statement("CREATE SCHEMA `{$this->database}` DEFAULT CHARACTER SET utf8 ;");
        // DB::statement("CREATE USER '{$this->username}'@'%' IDENTIFIED BY '{$this->password}' ;");
        DB::statement("GRANT ALL PRIVILEGES ON {$this->database}.* TO '{$this->username}'@'%' ;");
    }
}

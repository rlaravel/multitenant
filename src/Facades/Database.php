<?php

namespace RLaravel\MultiTenant\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Database
 * @package RLaravel\MultiTenant\Facades
 * @method static \Illuminate\Database\Eloquent\Model saveConfig()
 */
class Database extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RLaravel.tenant';
    }
}

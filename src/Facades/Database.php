<?php

namespace MorenoRafael\MultiTenant\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Database
 * @package MorenoRafael\MultiTenant\Facades
 * @method static \Illuminate\Database\Eloquent\Model saveConfig()
 */
class Database extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MorenoRafael.tenant';
    }
}

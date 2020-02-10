<?php

namespace MorenoRafael\MultiTenant\Models;

use Illuminate\Database\Eloquent\Model;
use MorenoRafael\MultiTenant\Traits\ConnectDbConfig;
use MorenoRafael\MultiTenant\Traits\Crypt;
use MorenoRafael\MultiTenant\Traits\DbConfigurable;

/**
 * Class DbConfig
 * @package MorenoRafael\MultiTenant\Models
 * @property-read int $id
 * @property string $config
 * @property-read \Carbon\Carbon $created_at
 * @property-read \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */
class DbConfig extends Model
{
    use ConnectDbConfig, Crypt, DbConfigurable;

    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var array
     */
    protected $fillable = [
        'config'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'config'
    ];
}

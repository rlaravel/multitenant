<?php

namespace RLaravel\MultiTenant\Models;

use Illuminate\Database\Eloquent\Model;
use RLaravel\MultiTenant\Traits\ConnectDbConfig;
use RLaravel\MultiTenant\Traits\Crypt;
use RLaravel\MultiTenant\Traits\DbConfigurable;

/**
 * Class DbConfig
 * @package RLaravel\MultiTenant\Models
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

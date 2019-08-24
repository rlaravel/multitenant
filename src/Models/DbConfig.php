<?php

namespace RafaelMorenoJS\MultiTenant\Models;

use Illuminate\Database\Eloquent\Model;
use RafaelMorenoJS\MultiTenant\Traits\ConnectDbConfig;
use RafaelMorenoJS\MultiTenant\Traits\Crypt;

/**
 * Class DbConfig
 * @package RafaelMorenoJS\MultiTenant\Models
 * @property-read int $id
 * @property string $config
 * @property-read \Carbon\Carbon $created_at
 * @property-read \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */
class DbConfig extends Model
{
    use ConnectDbConfig, Crypt;

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

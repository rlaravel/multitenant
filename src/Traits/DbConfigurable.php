<?php

namespace RLaravel\MultiTenant\Traits;

use RLaravel\MultiTenant\Models\DbConfig;

/**
 * Trait DbConfigurable
 * @package RLaravel\MultiTenant\Models
 * @property-read \RLaravel\MultiTenant\Models\DbConfig $config
 * @mixin \Eloquent
 */
trait DbConfigurable
{
    /**
     * @return mixed
     */
    public function dbConfig()
    {
        return $this->belongsTo(DbConfig::class);
    }
}
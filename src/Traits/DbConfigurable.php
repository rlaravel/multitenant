<?php

namespace RafaelMorenoJS\MultiTenant\Traits;

use RafaelMorenoJS\MultiTenant\Models\DbConfig;

/**
 * Trait DbConfigurable
 * @package RafaelMorenoJS\MultiTenant\Models
 * @property-read \RafaelMorenoJS\MultiTenant\Models\DbConfig $config
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
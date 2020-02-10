<?php

namespace MorenoRafael\MultiTenant\Traits;

use MorenoRafael\MultiTenant\Models\DbConfig;

/**
 * Trait DbConfigurable
 * @package MorenoRafael\MultiTenant\Models
 * @property-read \MorenoRafael\MultiTenant\Models\DbConfig $config
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
<?php

namespace MorenoRafael\MultiTenant\Traits;

use MorenoRafael\MultiTenant\Models\Observation;

/**
 * Trait Observationable
 * @package MorenoRafael\MultiTenant\Traits
 * @property-read \App\Models\Tenant\Observation|\Illuminate\Support\Collection $observations
 */
trait Observationable
{
    /**
     * @return mixed
     */
    public function observations()
    {
        return $this->morphMany(Observation::class, 'observationable');
    }
}
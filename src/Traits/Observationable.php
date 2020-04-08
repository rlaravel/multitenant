<?php

namespace RLaravel\MultiTenant\Traits;

use RLaravel\MultiTenant\Models\Observation;

/**
 * Trait Observationable
 * @package RLaravel\MultiTenant\Traits
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
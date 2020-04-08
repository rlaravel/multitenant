<?php

namespace RLaravel\MultiTenant\Models;

/**
 * Class Observation
 * @package App\Models\Tenant
 * @property string $body
 */
class Observation extends Model
{
    /**
     * @var array
     */
    protected $fillable =  [
        'body'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function observationable()
    {
        return $this->morphTo();
    }
}
<?php

namespace RafaelMorenoJS\MultiTenant\Models;

use Illuminate\Database\Eloquent\Model as ModelLaravel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Model
 * @package RafaelMorenoJS\MultiTenant\Models
 * @property-read int $id
 * @property-read \Carbon\Carbon $created_at
 * @property-read \Carbon\Carbon $updated_at
 * @property-read \Carbon\Carbon $deleted_at
 * @mixin \Eloquent
 */
abstract class Model extends ModelLaravel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $connection = 'tenant';
}
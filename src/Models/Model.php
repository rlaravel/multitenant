<?php

namespace MorenoRafael\MultiTenant\Models;

use Illuminate\Database\Eloquent\Model as ModelLaravel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Model
 * @package MorenoRafael\MultiTenant\Models
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
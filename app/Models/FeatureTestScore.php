<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $iaf_test_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class FeatureTestScore extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['iaf_test_id', 'user_id', 'created_at', 'updated_at'];

}

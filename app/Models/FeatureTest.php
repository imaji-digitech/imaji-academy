<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $iaf_id
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademyFeature $imajiAcademyFeature
 */
class FeatureTest extends Model
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
    protected $fillable = ['iaf_id', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function imajiAcademyFeature()
    {
        return $this->belongsTo('App\Models\ImajiAcademyFeature', 'iaf_id');
    }
}

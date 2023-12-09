<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $iaf_id
 * @property int $attitude
 * @property int $courtesy
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademyFeature $imajiAcademyFeature
 * @property User $user
 */
class FeatureReport extends Model
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
    protected $fillable = ['student_id', 'iaf_id','note', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imajiAcademyFeature()
    {
        return $this->belongsTo('App\Models\ImajiAcademyFeature', 'iaf_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}

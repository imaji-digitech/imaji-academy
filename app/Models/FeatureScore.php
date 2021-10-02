<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $iaf_id
 * @property string $module
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademyFeature $imajiAcademyFeature
 * @property User $user
 * @property FeatureScoreStudent[] $featureScoreStudents
 */
class FeatureScore extends Model
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
    protected $fillable = ['user_id', 'iaf_id', 'module', 'created_at', 'updated_at'];
    public static function search($dataId, $query)
    {
        return empty($query) ? static::whereIafId($dataId)
            : static::whereIafId($dataId)->where(function ($q) use ($query) {
                $q->where('module', 'like', '%' . $query . '%');
            });
    }
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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function featureScoreStudents()
    {
        return $this->hasMany('App\Models\FeatureScoreStudent');
    }
}

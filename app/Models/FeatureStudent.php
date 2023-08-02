<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $iaf_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademyFeature $imajiAcademyFeature
 * @property User $user
 */
class FeatureStudent extends Model
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
    protected $fillable = ['iaf_id', 'student_id', 'created_at', 'updated_at'];

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

    public static function search($dataId, $query)
    {
        return empty($query) ? static::whereIafId($dataId)
            : static::whereIafId($dataId)->where(function ($q) use ($query) {
                $q->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                });
            });
    }
}

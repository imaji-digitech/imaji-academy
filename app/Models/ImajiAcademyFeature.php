<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $imaji_academy_id
 * @property integer $feature_id
 * @property string $created_at
 * @property string $updated_at
 * @property Feature $feature
 * @property ImajiAcademy $imajiAcademy
 * @property FeatureActivity[] $featureActivities
 * @property FeatureActivityPresence[] $featureActivityPresences
 * @property FeatureSchedule[] $featureSchedules
 * @property FeatureStudent[] $featureStudents
 * @property FeatureTeacher[] $featureTeachers
 * @property FeatureTest[] $featureTests
 */
class ImajiAcademyFeature extends Model
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
    protected $fillable = ['imaji_academy_id', 'feature_id', 'created_at', 'updated_at'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static
                ::whereHas('imajiAcademy', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                })
                ->orWhereHas('feature', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                });
    }

    /**
     * @return BelongsTo
     */
    public function feature()
    {
        return $this->belongsTo('App\Models\Feature');
    }

    /**
     * @return BelongsTo
     */
    public function imajiAcademy()
    {
        return $this->belongsTo('App\Models\ImajiAcademy');
    }

    /**
     * @return HasMany
     */
    public function featureActivities()
    {
        return $this->hasMany('App\Models\FeatureActivity', 'iaf_id');
    }

    /**
     * @return HasMany
     */
    public function featureActivityPresences()
    {
        return $this->hasMany('App\Models\FeatureActivityPresence', 'iaf_id');
    }

    /**
     * @return HasMany
     */
    public function featureSchedules()
    {
        return $this->hasMany('App\Models\FeatureSchedule', 'iaf_id');
    }

    /**
     * @return HasMany
     */
    public function featureStudents()
    {
        return $this->hasMany('App\Models\FeatureStudent', 'iaf_id');
    }

    /**
     * @return HasMany
     */
    public function featureTeachers()
    {
        return $this->hasMany('App\Models\FeatureTeacher', 'iaf_id');
    }

    /**
     * @return HasMany
     */
    public function featureTests()
    {
        return $this->hasMany('App\Models\FeatureTest', 'iaf_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $presence_status_id
 * @property integer $iaf_id
 * @property integer $user_id
 * @property integer $feature_activity_id
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property FeatureActivity $featureActivity
 * @property ImajiAcademyFeature $imajiAcademyFeature
 * @property PresenceStatus $presenceStatus
 * @property User $user
 */
class FeatureActivityPresence extends Model
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
    protected $fillable = ['presence_status_id', 'user_id', 'feature_activity_id', 'note', 'created_at', 'updated_at'];

    public static function search($query, $iaf)
    {
        return empty($query) ? static::whereFeatureActivityId($iaf)
            : static::whereFeatureActivityId($iaf)->where(function ($q) use ($query) {
                $q->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })->orWhereHas('presenceStatus', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                });
            });
    }

    /**
     * @return BelongsTo
     */
    public function featureActivity()
    {
        return $this->belongsTo('App\Models\FeatureActivity');
    }

    /**
     * @return BelongsTo
     */
    public function imajiAcademyFeature()
    {
        return $this->belongsTo('App\Models\ImajiAcademyFeature', 'iaf_id');
    }

    /**
     * @return BelongsTo
     */
    public function presenceStatus()
    {
        return $this->belongsTo('App\Models\PresenceStatus');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

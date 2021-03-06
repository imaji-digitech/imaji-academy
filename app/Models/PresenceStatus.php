<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property FeatureActivityPresence[] $featureActivityPresences
 */
class PresenceStatus extends Model
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
    protected $fillable = ['title', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function featureActivityPresences()
    {
        return $this->hasMany('App\Models\FeatureActivityPresence');
    }
}

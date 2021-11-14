<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademyFeature[] $imajiAcademyFeatures
 */
class Feature extends Model
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
    protected $fillable = ['title', 'code', 'created_at', 'updated_at'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->orWhere('code', 'like', '%' . $query . '%');
    }

    /**
     * @return HasMany
     */
    public function imajiAcademyFeatures()
    {
        return $this->hasMany('App\Models\ImajiAcademyFeature');
    }
}

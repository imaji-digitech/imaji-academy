<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property Administrator[] $administrators
 * @property ImajiAcademyFeature[] $imajiAcademyFeatures
 * @property ImajiAcademyStudent[] $imajiAcademyStudents
 */
class ImajiAcademy extends Model
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

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%');
    }

    /**
     * @return HasMany
     */
    public function administrators()
    {
        return $this->hasMany('App\Models\Administrator');
    }

    /**
     * @return HasMany
     */
    public function imajiAcademyFeatures()
    {
        return $this->hasMany('App\Models\ImajiAcademyFeature');
    }

    /**
     * @return HasMany
     */
    public function imajiAcademyStudents()
    {
        return $this->hasMany('App\Models\ImajiAcademyStudent');
    }
}

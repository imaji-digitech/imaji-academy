<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $village
 * @property string $created_at
 * @property string $updated_at
 * @property string $village_program
 * @property int $year_program
 * @property int $year_program_code
 * @property string $village_code
 * @property string $note
 * @property Administrator[] $administrators
 * @property ImajiAcademyFeature[] $imajiAcademyFeatures
 * @property ImajiAcademyStudent[] $imajiAcademyStudents
 * @property User[] $users
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
    protected $fillable
        = [
            'title', 'code', 'village', 'created_at', 'updated_at',
            'village_program', 'year_program', 'year_program_code',
            'village_code', 'note',
        ];


    public static function search($query)
    {
        return empty($query)
            ? static::query()
            : static::where('title', 'like', '%'.$query.'%')
                ->orWhere('code', 'like', '%'.$query.'%')
                ->orWhere('village', 'like', '%'.$query.'%');
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

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}

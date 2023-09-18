<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $imaji_academy_id
 * @property string $name
 * @property string $nis
 * @property string $address
 * @property string $birthday
 * @property string $school
 * @property string $class
 * @property string $future_goal
 * @property string $parent_name
 * @property string $parent_job
 * @property int $ips
 * @property int $age
 * @property string $birth_place
 * @property string $birth_date
 * @property string $semester
 * @property string $home_village
 * @property string $home_address
 * @property int $year_enter
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademy $imajiAcademy
 * @property FeatureActivityPresence[] $featureActivityPresences
 * @property FeatureReport[] $featureReports
 * @property FeatureScoreStudent[] $featureScoreStudents
 * @property FeatureStudent[] $featureStudents
 */
class Student extends Model
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
    protected $fillable = ['imaji_academy_id', 'name', 'nis', 'address', 'birthday', 'school', 'class', 'future_goal', 'parent_name', 'parent_job', 'ips', 'age', 'birth_place', 'birth_date', 'semester', 'home_village', 'home_address', 'year_enter', 'created_at', 'updated_at'];

    public static function getCode($id, $year)
    {
        $imajiAcademy = ImajiAcademy::find($id);
        $count = Student::where('imaji_academy_id', $id)->where('year_enter', $year)->get()->count();
        $number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $year = $year - 2000;
        return "$imajiAcademy->year_program_code.$imajiAcademy->village_code.$year.$number";
    }

    public static function searchStudent($query)
    {
        return empty($query)
            ? static::query()
            : static::where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('nis', 'like', '%' . $query . '%');
            });
    }

    public static function searchStudentImajiAcademy($query, $dataId)
    {
        return empty($query)
            ? static::whereImajiAcademyId($dataId)
            : static::whereImajiAcademyId($dataId)->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('nis', 'like', '%' . $query . '%');
            });
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
    public function featureActivityPresences()
    {
        return $this->hasMany('App\Models\FeatureActivityPresence');
    }

    /**
     * @return HasMany
     */
    public function featureReports()
    {
        return $this->hasMany('App\Models\FeatureReport');
    }

    /**
     * @return HasMany
     */
    public function featureScoreStudents()
    {
        return $this->hasMany('App\Models\FeatureScoreStudent');
    }

    /**
     * @return HasMany
     */
    public function featureStudents()
    {
        return $this->hasMany('App\Models\FeatureStudent');
    }
}

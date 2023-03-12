<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $nis
 * @property int $role
 * @property string $quotes
 * @property string $address
 * @property string $birthday
 * @property string $email_verified_at
 * @property string $password
 * @property string $two_factor_secret
 * @property string $two_factor_recovery_codes
 * @property string $remember_token
 * @property integer $current_team_id
 * @property string $profile_photo_path
 * @property string $school
 * @property int $class
 * @property string $hobby
 * @property string $future_goal
 * @property string $parent_name
 * @property string $parent_job
 * @property int $ips
 * @property int $age
 * @property string $created_at
 * @property string $updated_at
 * @property Administrator[] $administrators
 * @property FeatureActivity[] $featureActivities
 * @property FeatureActivityPresence[] $featureActivityPresences
 * @property FeatureScoreStudent[] $featureScoreStudents
 * @property FeatureScore[] $featureScores
 * @property FeatureStudent[] $featureStudents
 * @property FeatureTeacher[] $featureTeachers
 * @property FeatureReport[] $featureReports
 * @property ImajiAcademyStudent[] $imajiAcademyStudents
 * @property Student[] $students
 * @property Teacher[] $teachers
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
            'two_factor_recovery_codes',
            'two_factor_secret',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends
        = [
            'profile_photo_url',
        ];
    /**
     * /**
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
            'name', 'email', 'nis', 'role', 'quotes', 'address', 'birthday',
            'email_verified_at', 'password', 'two_factor_secret',
            'two_factor_recovery_codes', 'remember_token', 'current_team_id',
            'profile_photo_path', 'school', 'class', 'hobby', 'future_goal',
            'parent_name', 'parent_job', 'created_at', 'updated_at', 'ips',
            'age', 'birth_place', 'birth_place', 'year_enter', 'semester',
            'village', 'school_grade', 'home_village', 'home_address',
        ];

    public static function getCode($id,$year){
        $imajiAcademy=ImajiAcademy::find($id);
        $count = User::where('imaji_academy_id',$id)->where('year_enter',$year)->get()->count();
        $number=str_pad($count+1, 4, '0', STR_PAD_LEFT);
        $year=$year-2000;
        return "$imajiAcademy->year_program_code.$imajiAcademy->village_code.$year.$number";
    }

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query)
            ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%');
    }

    public static function searchStudent($query)
    {
        return empty($query)
            ? static::whereRole(3)
            : static::whereRole(3)->where(function ($q) use ($query) {
                $q->where('name', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orWhere('nis', 'like', '%'.$query.'%');
            });
    }

    public static function getNis() {}

    public static function searchTeacher($query)
    {
        return empty($query)
            ? static::whereRole(2)
            : static::whereRole(2)->where(function ($q) use ($query) {
                $q->where('name', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%');
            });
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
    public function featureActivities()
    {
        return $this->hasMany('App\Models\FeatureActivity');
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
    public function featureScoreStudents()
    {
        return $this->hasMany('App\Models\FeatureScoreStudent');
    }

    /**
     * @return HasMany
     */
    public function featureScores()
    {
        return $this->hasMany('App\Models\FeatureScore');
    }

    /**
     * @return HasMany
     */
    public function featureStudents()
    {
        return $this->hasMany('App\Models\FeatureStudent');
    }

    /**
     * @return HasMany
     */
    public function featureTeachers()
    {
        return $this->hasMany('App\Models\FeatureTeacher');
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
    public function imajiAcademyStudents()
    {
        return $this->hasMany('App\Models\ImajiAcademyStudent');
    }

    /**
     * @return HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    /**
     * @return HasMany
     */
    public function teachers()
    {
        return $this->hasMany('App\Models\Teacher');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $imaji_academy_id
 * @property string $name
 * @property int $nis
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
    protected $fillable = ['id','imaji_academy_id', 'name', 'nis', 'address', 'birthday', 'school', 'class', 'future_goal', 'parent_name', 'parent_job', 'ips', 'age', 'birth_place', 'birth_date', 'semester', 'home_village', 'home_address', 'year_enter', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imajiAcademy()
    {
        return $this->belongsTo('App\Models\ImajiAcademy');
    }
}
